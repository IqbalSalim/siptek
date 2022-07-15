<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Iriyanto',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Zulkifli Halid',
                'email' => 'zulkifli@gmail.com',
                'password' => 'password',
                'role' => 'tenaga kontrak',
            ],
        ];

        foreach ($users as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
            ]);

            $role = Role::where('name', $row['role'])->first();
            $user = User::where('email', $row['email'])->first();
            $user->assignRole($role);
        }
    }
}
