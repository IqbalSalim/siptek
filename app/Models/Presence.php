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
        'file',
        'status',
        'code',
        'feedback',
        'late_minutes',
        'quick_minutes',
        'percent',
        'longlat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCariNama($query, $nama)
    {
        $query->whereHas('user', function ($query) use ($nama) {
            $query->where('name', 'like', '%' . $nama . '%');
        });
    }
}
