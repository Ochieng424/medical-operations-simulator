<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Nurse',
                'department_id' => 1,
            ],
            [
                'name' => 'Lab Technician',
                'department_id' => 2,
            ],
            [
                'name' => 'Radiologist',
                'department_id' => 3,
            ],
            [
                'name' => 'Doctor',
                'department_id' => 4,
            ],
            [
                'name' => 'Optician',
                'department_id' => 5,
            ],
            [
                "name" => "Receptionist",
                "department_id" => 6,
            ]
        ];

        foreach ($roles as $role) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'role' => $role['name'],
                'email' => strtolower(str_replace(" ","", $role['name'])) . '@gmail.com',
                'password' => Hash::make('password'),
                'department_id' => $role['department_id'],
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ]);
        }
    }
}
