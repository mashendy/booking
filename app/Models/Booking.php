<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id', 'nama_pemesan', 'email', 'tanggal',
        'jam_mulai', 'jam_selesai', 'keterangan', 'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
