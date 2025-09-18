@extends('layouts.app')

@section('title', 'Daftar Booking Petugas')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">Daftar Booking Ruangan</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>Room</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->nama_pemesan }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->room->nama }}</td>
                    <td>{{ $booking->tanggal }}</td>
                    <td>{{ $booking->jam_mulai }}</td>
                    <td>{{ $booking->jam_selesai }}</td>
                    <td>
                        @if($booking->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($booking->status === 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if($booking->status === 'pending')
                        <form action="{{ route('petugas.reservations.approve', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                        </form>
                        <form action="{{ route('petugas.reservations.reject', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                        @endif

                        <!-- Tombol Detail -->
                        <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal{{ $booking->id }}">
                            Detail
                        </button>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="modal{{ $booking->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="modalLabel{{ $booking->id }}">Detail Peminjaman #{{ $booking->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Pemesan:</strong> {{ $booking->nama_pemesan }}</p>
                                        <p><strong>Email:</strong> {{ $booking->email }}</p>
                                        <p><strong>Room:</strong> {{ $booking->room->nama }}</p>
                                        <p><strong>Tanggal:</strong> {{ $booking->tanggal }}</p>
                                        <p><strong>Jam Mulai:</strong> {{ $booking->jam_mulai }}</p>
                                        <p><strong>Jam Selesai:</strong> {{ $booking->jam_selesai }}</p>
                                        <p><strong>Keterangan:</strong> {{ $booking->keterangan ?? '-' }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
