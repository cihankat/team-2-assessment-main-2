<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'firstname' => $row[0],
            'prefix' => $row[1] ?? null, // Assuming 'prefix' can be nullable
            'lastname' => $row[2],
            'gender' => $row[3],
            'email' => $row[4],
            'usernumber' => $row[5],
            // You might want to set a default password or use a different column for the password.
            'password' => bcrypt('defaultPassword'),
            // Add any additional fields you need here
        ]);
    }
}
