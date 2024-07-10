<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\Classrooms;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassroomPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classrooms $classroom): bool
    {
        if ($user->hasRole('administrator')) {
            return true;
        }

        return $user->hasRole('teacher') && $classroom->users()->where('user_id', $user->id)->exists();
    }
}
