<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Add this line
use App\Imports\UsersImport; // Add this line
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('firstname', 'LIKE', "%$query%")
            ->orWhere('lastname', 'LIKE', "%$query%")
            ->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'prefix' => 'nullable|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required|in:Man,Vrouw,Anders',
            'email' => 'required|email|max:255|unique:users',
            'usernumber' => 'nullable|max:255',
            'password' => 'required|min:8', // Make sure to validate the password as needed
            'profile_picture' => 'nullable|image', // Validate image if you are allowing image uploads
        ]);

        // Handle profile picture upload if necessary
        if ($request->hasFile('profile_picture')) {
            $filename = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $filename;
        }

        $validatedData['password'] = Hash::make($validatedData['password']); // Hash the password

        $user = User::create($validatedData);

        // redirect with success message
        return redirect()->route('admin.users')->with('success', 'Gebruiker successvol aangemaakt.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Perform validation on the request data
        $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'prefix' => 'nullable|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required|in:Man,Vrouw,Anders', // Ensure these match the ENUM values in the database exactly
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'usernumber' => 'required|numeric',
        ]);

        // Update the user with validated data
        $user->update($request->except('roles'));

        $user->syncRoles($request->roles);

        // Redirect back with a success message, or to the list, as preferred
        return redirect()->route('admin.users')->with('success', 'De gebruiker is bijgewerkt.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $header = array_shift($data);
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            User::updateOrCreate(
                ['email' => $row['email']],
                [
                    'firstname' => $row['firstname'],
                    'prefix' => $row['prefix'],
                    'lastname' => $row['lastname'],
                    'gender' => $row['gender'],
                    'usernumber' => $row['usernumber'],
                    'password' => Hash::make('defaultpassword') // Set a default password or handle as required
                ]
            );
        }

        return redirect()->route('admin.users')->with('success', 'De gebruikers zijn geimporteerd.');
    }
}

