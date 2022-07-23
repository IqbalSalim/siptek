<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'come_photo',
        'go_photo',
        'come_presence',
        'go_presence',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
