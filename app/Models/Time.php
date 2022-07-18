<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'come_start_time',
        'come_end_time',
        'go_start_time',
        'go_end_time'
    ];
}
