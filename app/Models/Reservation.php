<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'room_id',
        'nama_pemesan',
        'email',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'ditolak');
    }

    public function approve()
    {
        $this->status = 'disetujui';
        return $this->save();
    }

    public function reject()
    {
        $this->status = 'ditolak';
        return $this->save();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'disetujui';
    }

    public function isRejected()
    {
        return $this->status === 'ditolak';
    }
}