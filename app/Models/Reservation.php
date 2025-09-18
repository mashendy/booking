<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'status',
        // tambahkan field lain jika ada
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id');
    }
}
