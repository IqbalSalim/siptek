<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [
            [
                'day' => 'Senin',
                'come_start_time' => '06:00',
                'come_end_time' => '08:30',
                'go_start_time' => '16:00',
                'go_end_time' => '23:59',
            ],
            [
                'day' => 'Selasa',
                'come_start_time' => '06:00',
                'come_end_time' => '08:30',
                'go_start_time' => '16:00',
                'go_end_time' => '23:59',
            ],
            [
                'day' => 'Rabu',
                'come_start_time' => '06:00',
                'come_end_time' => '08:30',
                'go_start_time' => '16:00',
                'go_end_time' => '23:59',
            ],
            [
                'day' => 'Kamis',
                'come_start_time' => '06:00',
                'come_end_time' => '08:30',
                'go_start_time' => '16:00',
                'go_end_time' => '23:59',
            ],
            [
                'day' => 'Jumat',
                'come_start_time' => '06:00',
                'come_end_time' => '08:30',
                'go_start_time' => '16:00',
                'go_end_time' => '23:59',
            ],
        ];

        foreach ($times as $row) {
            Time::create([
                'day' => $row['day'],
                'come_start_time' => $row['come_start_time'],
                'come_end_time' => $row['come_end_time'],
                'go_start_time' => $row['go_start_time'],
                'go_end_time' => $row['go_end_time'],
            ]);
        }
    }
}
