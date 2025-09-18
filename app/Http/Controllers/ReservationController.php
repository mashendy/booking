<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Hanya petugas
    private function authorizePetugas()
    {
        if (!Auth::check() || Auth::user()->role !== 'petugas') {
            abort(403, 'Akses ditolak.');
        }
    }

    // Tampilkan semua booking untuk petugas
    public function index()
    {
        $this->authorizePetugas();
        $reservations = Booking::with('room')->get(); // ambil semua booking
        return view('petugas.reservations', compact('reservations'));
    }

    // Setujui booking
    public function approve($id)
    {
        $this->authorizePetugas();

        $booking = Booking::findOrFail($id);
        $booking->status = 'disetujui';
        $booking->save();

        return redirect()->route('petugas.reservations.index')->with('success', 'Booking disetujui.');
    }

    // Tolak booking
    public function reject($id)
    {
        $this->authorizePetugas();

        $booking = Booking::findOrFail($id);
        $booking->status = 'ditolak';
        $booking->save();

        return redirect()->route('petugas.reservations.index')->with('success', 'Booking ditolak.');
    }
}
