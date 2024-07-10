<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Classrooms;
use App\Models\User;
use App\Models\UserClassroom;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $user = Auth::user();

        $classes = Classrooms::withCount('users')
            ->where('name', 'like', '%' . $query . '%');

        if ($user->hasRole('teacher')) {
            $classes->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $classes = $classes->paginate(5);

        return view('admin.classes.classes', compact('classes'));
    }

    public function addClass(Request $request)
    {
        return view('admin.classes.add_class');
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = new Classrooms();
        $class->name = $request->name;
        $class->save();

        return redirect()->route('admin.classes');
    }

    public function editClass($id)
    {
        $class = Classrooms::findOrFail($id);
        $this->authorize('update', $class);

        return view('admin.classes.edit_class', compact('class'));
    }

    public function updateClass(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = Classrooms::findOrFail($id);
        $this->authorize('update', $class);

        $class->name = $request->name;
        $class->save();

        return redirect()->route('admin.classes');
    }

    public function deleteClass($id)
    {
        $class = Classrooms::findOrFail($id);
        $this->authorize('update', $class);

        $class->users()->detach();

        $class->assessments()->each(function ($assessment) {
            $assessment->checklists()->each(function ($checklist) {
                $checklist->userstories()->delete();
                $checklist->delete();
            });
            $assessment->delete();
        });

        $class->delete();

        return redirect()->route('admin.classes');
    }

    public function UserToClass($classroomID, Request $request)
    {

        $classroom = Classrooms::findOrFail($classroomID);

        $this->authorize('update', $classroom);

        $query = $request->input('query');

        $users = User::where('firstname', 'like', '%' . $query . '%')
            ->orWhere('lastname', 'like', '%' . $query . '%')
            ->paginate(5);

        foreach ($users as $user) {
            if ($user->hasRole('administrator')) {
                $user->rank = 'Administrator';
            } elseif ($user->hasRole('teacher')) {
                $user->rank = 'Teacher';
            } else {
                $user->rank = 'Student';
            }
        }

        return view('admin.classes.add_users_to_class', compact('users', 'classroom'));
    }

    public function addUserToClass($userID, $classroomID)
    {
        $classroom = Classrooms::findOrFail($classroomID);
        $this->authorize('update', $classroom);

        UserClassroom::create([
            'user_id' => $userID,
            'classroom_id' => $classroomID,
        ]);

        $className = Classrooms::find($classroomID)->name;
        Notification::create([
            'title' => 'Je bent aan een klas toegevoegd',
            'message' => "Je bent aan de klas " . $className . " toegevoegd.",
            'user_id' => $userID
        ]);

        return redirect()->back()->with('success', 'Added');
    }

    public function removeUserFromClass($userID, $classroomID)
    {
        $classroom = Classrooms::findOrFail($classroomID);
        $this->authorize('update', $classroom);

        $userClassroom = UserClassroom::where('user_id', $userID)
            ->where('classroom_id', $classroomID)
            ->first();

        if ($userClassroom) {
            $userClassroom->delete();

            $className = Classrooms::find($classroomID)->name;
            Notification::create([
                'title' => 'Je bent van een klas verwijderd',
                'message' => "Je bent verwijderd van de klas " . $className . ".",
                'user_id' => $userID
            ]);

            return redirect()->back()->with('success', 'De gebruiker is verwijderd van de klas');
        } else {
            return redirect()->back()->with('error', 'De gebruiker hoort niet bij deze klas');
        }
    }

    public function show(Classrooms $classroom, User $users, $id)
    {
        $classroom = Classrooms::findOrFail($id);
        return view('classroom', compact('classroom', 'users'));
    }
}
