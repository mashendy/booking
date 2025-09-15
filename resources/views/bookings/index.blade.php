<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Booking Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --accent: #7209b7;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            max-width: 1400px;
        }
        
        .header-section {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
        }
        
        .page-title {
            font-weight: 700;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .page-title i {
            font-size: 2.2rem;
        }
        
        .btn-add {
            background: linear-gradient(to right, #4cc9f0, #4895ef);
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(76, 201, 240, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(76, 201, 240, 0.4);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px 20px;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            font-weight: 600;
            border-top: none;
            padding: 15px 12px;
            background-color: #f8f9fa;
        }
        
        .table td {
            padding: 12px;
            vertical-align: middle;
        }
        
        .table tr {
            transition: background-color 0.2s;
        }
        
        .table tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-disetujui {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .form-select {
            border-radius: 20px;
            padding: 5px 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .btn-action {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.85rem;
        }
        
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }
        
        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 15px;
        }
        
        .btn-close {
            filter: invert(1);
        }
        
        .empty-state {
            padding: 40px 0;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 5rem;
            margin-bottom: 20px;
            color: #dee2e6;
        }
        
        .badge-status {
            border-radius: 20px;
            padding: 6px 12px;
            font-weight: 500;
        }
        
        .room-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .room-card-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 15px;
            font-weight: 600;
        }
        
        .room-card-body {
            padding: 20px;
        }
        
        .room-capacity {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .room-capacity i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .room-description {
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .booking-form {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .header-section {
                text-align: center;
                padding: 15px;
            }
            
            .header-actions {
                margin-top: 15px;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <!-- Header Section -->
    <div class="header-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Sistem Booking Ruangan</h1>
            </div>
            <div class="col-md-6 text-md-end header-actions">
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#roomsModal">
                    <i class="fas fa-door-open me-2"></i> Lihat Daftar Ruangan
                </button>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Booking -->
    <div class="card shadow-sm">
        <div class="card-header">
            <i class="fas fa-list me-2"></i> Daftar Pemesanan Ruangan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Email</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                                            {{ strtoupper(substr($booking->nama_pemesan, 0, 1)) }}
                                        </div>
                                        <div>{{ $booking->nama_pemesan }}</div>
                                    </div>
                                </td>
                                <td>{{ $booking->email }}</td>
                                <td>
                                    <span class="badge bg-secondary badge-status">
                                        <i class="fas fa-door-open me-1"></i> {{ $booking->room->nama }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-clock me-1"></i> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                                    </span>
                                </td>
                                <td>{{ $booking->keterangan ?: '-' }}</td>
                                <td>
                                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm 
                                            {{ $booking->status == 'pending' ? 'status-pending' : '' }}
                                            {{ $booking->status == 'disetujui' ? 'status-disetujui' : '' }}
                                            {{ $booking->status == 'ditolak' ? 'status-ditolak' : '' }}">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="disetujui" {{ $booking->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="ditolak" {{ $booking->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger btn-action" onclick="return confirm('Yakin hapus booking ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-times"></i>
                                        <h4>Belum ada booking</h4>
                                        <p>Silakan pilih ruangan yang tersedia untuk melakukan booking</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Daftar Ruangan -->
<div class="modal fade" id="roomsModal" tabindex="-1" aria-labelledby="roomsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomsModalLabel"><i class="fas fa-door-open me-2"></i> Daftar Ruangan Tersedia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @forelse($rooms as $room)
                    <div class="col-md-6 mb-4">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h5 class="mb-0">{{ $room->nama }}</h5>
                            </div>
                            <div class="room-card-body">
                                <div class="room-capacity">
                                    <i class="fas fa-users"></i>
                                    <span>Kapasitas: {{ $room->kapasitas }} orang</span>
                                </div>
                                <div class="room-description">
                                    {{ $room->deskripsi ?: 'Tidak ada deskripsi tambahan' }}
                                </div>
                                <button class="btn btn-primary w-100 btn-book-room" 
                                        data-room-id="{{ $room->id }}"
                                        data-room-name="{{ $room->nama }}">
                                    <i class="fas fa-calendar-plus me-2"></i> Booking Ruangan Ini
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fas fa-door-closed"></i>
                                <h4>Belum ada ruangan tersedia</h4>
                                <p>Silakan tambah ruangan terlebih dahulu</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Booking (Satu untuk Semua Ruangan) -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('bookings.store') }}" method="POST" class="modal-content" id="bookingForm">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Booking Ruangan: <span id="modal-room-name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="room_id" id="modal-room-id" value="">
                <div class="mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="nama_pemesan" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                <input type="date" name="tanggal" class="form-control" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Waktu</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="time" name="jam_mulai" class="form-control" required>
                                </div>
                                <div class="col">
                                    <input type="time" name="jam_selesai" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Booking
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi modal
        const roomsModal = new bootstrap.Modal(document.getElementById('roomsModal'));
        const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
        
        // Handle button "Lihat Daftar Ruangan"
        document.querySelector('.btn-add').addEventListener('click', function () {
            roomsModal.show();
        });
        
        // Handle button "Booking Ruangan Ini"
        document.querySelectorAll('.btn-book-room').forEach(button => {
            button.addEventListener('click', function () {
                const roomId = this.getAttribute('data-room-id');
                const roomName = this.getAttribute('data-room-name');
                
                // Set data ruangan di modal booking
                document.getElementById('modal-room-id').value = roomId;
                document.getElementById('modal-room-name').textContent = roomName;
                
                // Tutup modal ruangan dan buka modal booking
                roomsModal.hide();
                bookingModal.show();
            });
        });
        
        // Validasi form booking
        document.getElementById('bookingForm').addEventListener('submit', function (event) {
            const jamMulai = this.querySelector('input[name="jam_mulai"]').value;
            const jamSelesai = this.querySelector('input[name="jam_selesai"]').value;
            const tanggal = this.querySelector('input[name="tanggal"]').value;
            
            if (jamMulai && jamSelesai && jamMulai >= jamSelesai) {
                event.preventDefault();
                alert('Jam selesai harus lebih besar dari jam mulai.');
                return;
            }
            
            const today = new Date().toISOString().split('T')[0];
            if (tanggal < today) {
                event.preventDefault();
                alert('Tanggal booking tidak boleh di masa lalu.');
                return;
            }
        });
    });
</script>
</body>
</html>