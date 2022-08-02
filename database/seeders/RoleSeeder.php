<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'admin',
            'tenaga kontrak',
        ];
        foreach ($array as $row) {
            Role::create(['name' => $row]);
        }

        $array2 = [
            'olah tk',
            'olah waktu',
            'buat presensi',
        ];

        foreach ($array2 as $row) {
            Permission::create(['name' => $row]);
        }

        // Tambah Permission di Role Admin
        $role = Role::where('name', 'admin')->first();
        $role->givePermissionTo([
            'olah tk',
            'olah waktu',
        ]);

        // Tambah Permission di Role Tenaga Kontrak
        $role = Role::where('name', 'tenaga kontrak')->first();
        $role->givePermissionTo([
            'buat presensi',
        ]);
    }
}
