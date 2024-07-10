<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        return view('users.settings');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            // ... your other validation rules ...
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for profile picture
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.settings.edit')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Save the file to the 'public/profile_pictures' directory
            $file->storeAs('profile_pictures', $filename, 'public');

            // Update user's profile picture path
            $user->profile_picture = $filename;
        }

        // Update other user info
        $user->fill($validator->validated());
        $user->save();

        return redirect()->route('user.settings')->with('success', 'Instellingen opgeslagen.');
    }




    public function edit()
    {
        return view('users.edit_settings', ['user' => Auth::user()]);
    }
}
