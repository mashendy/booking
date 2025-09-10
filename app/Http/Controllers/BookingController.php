<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    /**
     * Tampilkan semua booking.
     */
    public function index()
    {
        $bookings = Booking::with('room')->latest()->get();
        $rooms = Room::all();
        return view('bookings.index', compact('bookings', 'rooms'));
    }

    /**
     * Simpan booking baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'nama_pemesan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keterangan' => 'nullable|string',
        ]);

        Booking::create([
            'room_id' => $request->room_id,
            'nama_pemesan' => $request->nama_pemesan,
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan' => $request->keterangan,
            'status' => 'pending', // default
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    /**
     * Ubah status booking (disetujui/ditolak).
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->route('bookings.index')->with('success', 'Status booking diperbarui.');
    }

    /**
     * Hapus booking.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
