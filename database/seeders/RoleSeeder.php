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

        // $array2 = [
        //     'olah user',
        //     'olah profil',
        //     'olah kegiatan',
        //     'olah usulan',
        //     'olah rkp',
        //     'olah rapb',
        //     'olah apb',
        //     'olah warta',
        //     'olah realisasi',
        //     'lihat rkp',
        //     'lihat rapb',
        //     'lihat apb',
        //     'lihat warta',
        //     'lihat realisasi',
        //     'lihat usulan'
        // ];

        // foreach ($array2 as $row) {
        //     Permission::create(['name' => $row]);
        // }

        // Tambah Permission di Role Admin
        // $role = Role::where('name', 'admin')->first();
        // $role->givePermissionTo([
        //     'olah user',
        //     'olah profil',
        // ]);

        // // Tambah Permission di Role Kepala Desa
        // $role = Role::where('name', 'kepala desa')->first();
        // $role->givePermissionTo([
        //     'lihat rkp',
        //     'lihat rapb',
        //     'lihat apb',
        //     'lihat realisasi',
        //     'lihat usulan'
        // ]);

        // // Tambah Permission di Role Sekretaris
        // $role = Role::where('name', 'sekretaris')->first();
        // $role->givePermissionTo([
        //     'olah profil',
        //     'olah kegiatan',
        //     'olah usulan',
        //     'olah rkp',
        //     'olah rapb',
        //     'olah apb',
        //     'olah warta',
        //     'olah realisasi',
        // ]);

        // // Tambah Permission di Role Tim Penyusun
        // $role = Role::where('name', 'tim penyusun')->first();
        // $role->givePermissionTo([
        //     'olah usulan',
        //     'olah rkp',
        // ]);
    }
}
