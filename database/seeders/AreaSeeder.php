<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'KB/KR',
            'KS/PK',
            'DALDUK',
            'SEKRET',
            'ADPIN',
            'LATBANG',
        ];
        foreach ($array as $row) {
            Area::create(['name' => $row]);
        }
    }
}
