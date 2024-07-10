<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class givePermission extends Controller
{
    public function show()
    {

        $userId = Auth::id();
        $user = User::find($userId); // Get the user instance

        if ($user) {
            $role = Role::findByName('administrator'); // Find the role instance by name
            if ($role) {
                $user->assignRole($role); // Assign the role to the user
                echo "Role assigned successfully!";
            } else {
                echo "Role not found!";
            }
        } else {
            echo "User not found!";
        }
    }
}
