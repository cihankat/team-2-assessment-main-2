<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'firstname' => 'Ahmad',
                'prefix'    => '',
                'lastname'  => 'Smit',
                'gender'    => 'Man',
                'email'     => 'Ahmad@gmail.com',
                'usernumber' => '566',
                'password'  => bcrypt("password")
            ],
            [
                'firstname' => 'Ayat',
                'prefix'    => '',
                'lastname'  => 'Abu Idris',
                'gender'    => 'Vrouw',
                'email'     => 'Ayat@gmail.com',
                'usernumber' => '1987',
                'password'  => bcrypt("password")
            ]
        ];

        DB::table('users')->insert($data);
    }
}
