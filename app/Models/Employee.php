<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'birthplace',
        'birthdate',
        'last_education',
        'phone',
        'address',
        'image',
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
