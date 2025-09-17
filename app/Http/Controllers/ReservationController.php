<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $pendingReservations = Reservation::with('room')
            ->pending()
            ->orderBy('created_at', 'desc')
            ->get();

        $historyReservations = Reservation::with('room')
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('petugas.reservations', [
            'pendingReservations' => $pendingReservations,
            'historyReservations' => $historyReservations,
            'pendingCount' => $pendingReservations->count(),
            'historyCount' => $historyReservations->count()
        ]);
    }

    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if (!$reservation->isPending()) {
            return redirect()->route('petugas.reservations.index')
                ->with('error', 'Hanya booking dengan status pending yang dapat disetujui.');
        }

        $reservation->approve();

        // 🔑 Redirect dengan hash #history agar tab Riwayat langsung aktif
        return redirect()->to(route('petugas.reservations.index', [], false) . '#history')
            ->with('success', 'Booking berhasil disetujui.');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if (!$reservation->isPending()) {
            return redirect()->route('petugas.reservations.index')
                ->with('error', 'Hanya booking dengan status pending yang dapat ditolak.');
        }

        $reservation->reject();

        return redirect()->to(route('petugas.reservations.index', [], false) . '#history')
            ->with('success', 'Booking berhasil ditolak.');
    }
}
