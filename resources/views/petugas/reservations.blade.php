<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking Ruangan - Petugas</title>
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
        
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }
        
        .nav-tabs .nav-link {
            border: none;
            border-radius: 8px 8px 0 0;
            padding: 12px 20px;
            font-weight: 500;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            border-color: transparent;
            color: var(--primary);
        }
        
        .nav-tabs .nav-link.active {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            font-weight: 600;
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
        
        .badge-status {
            border-radius: 20px;
            padding: 6px 12px;
            font-weight: 500;
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
        
        .btn-action {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
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
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--accent));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
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
            
            .btn-group {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn-action {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <!-- Header Section -->
    <div class="header-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title"><i class="fas fa-calendar-check"></i> Manajemen Booking Ruangan</h1>
                <p class="mb-0 mt-2">Panel kontrol petugas untuk menyetujui atau menolak booking ruangan</p>
                
            </div>
             <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>

        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="card shadow-sm">
        <div class="card-header">
            <i class="fas fa-tasks me-2"></i> Panel Persetujuan Booking
        </div>
        <div class="card-body">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="reservationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                        <i class="fas fa-clock me-1"></i> Menunggu Persetujuan
                        @if($pendingCount > 0)
                        <span class="badge bg-warning ms-1">{{ $pendingCount }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                        <i class="fas fa-history me-1"></i> Riwayat
                        @if($historyCount > 0)
                        <span class="badge bg-secondary ms-1">{{ $historyCount }}</span>
                        @endif
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="reservationTabsContent">
                <!-- Tab 1: Pending Approvals -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                    @if($pendingReservations->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-calendar-check"></i>
                            <h4>Tidak ada booking yang menunggu persetujuan</h4>
                            <p>Semua booking telah diproses</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Pemesan</th>
                                        <th>Email</th>
                                        <th>Ruangan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingReservations as $index => $reservation)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($reservation->nama_pemesan, 0, 1)) }}
                                                </div>
                                                <div>{{ $reservation->nama_pemesan }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $reservation->email }}</td>
                                        <td>
                                            <span class="badge bg-secondary badge-status">
                                                <i class="fas fa-door-open me-1"></i> {{ $reservation->room->nama_ruangan ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ $reservation->tanggal->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-clock me-1"></i> {{ $reservation->jam_mulai }} - {{ $reservation->jam_selesai }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge status-pending badge-status">
                                                <i class="fas fa-clock me-1"></i> Pending
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-info btn-action" data-bs-toggle="modal" data-bs-target="#detailModal{{ $reservation->id }}">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                                <form action="{{ route('petugas.reservations.approve', $reservation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-action" onclick="return confirm('Setujui booking ini?')">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('petugas.reservations.reject', $reservation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Tolak booking ini?')">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Tab 2: History -->
                <div class="tab-pane fade" id="history" role="tabpanel">
                    @if($historyReservations->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <h4>Belum ada riwayat persetujuan</h4>
                            <p>Riwayat persetujuan akan muncul di sini</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Pemesan</th>
                                        <th>Email</th>
                                        <th>Ruangan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Update Terakhir</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historyReservations as $index => $reservation)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($reservation->nama_pemesan, 0, 1)) }}
                                                </div>
                                                <div>{{ $reservation->nama_pemesan }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $reservation->email }}</td>
                                        <td>
                                            <span class="badge bg-secondary badge-status">
                                                <i class="fas fa-door-open me-1"></i> {{ $reservation->room->nama_ruangan ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ $reservation->tanggal->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-clock me-1"></i> {{ $reservation->jam_mulai }} - {{ $reservation->jam_selesai }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-status 
                                                {{ $reservation->status === 'disetujui' ? 'status-disetujui' : 'status-ditolak' }}">
                                                <i class="fas {{ $reservation->status === 'disetujui' ? 'fa-check' : 'fa-times' }} me-1"></i> 
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $reservation->updated_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-action" data-bs-toggle="modal" data-bs-target="#historyModal{{ $reservation->id }}">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals for Detail -->
@foreach($pendingReservations as $reservation)
<!-- Modal Detail Pending -->
<div class="modal fade" id="detailModal{{ $reservation->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-alt me-2"></i>Detail Booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-user me-2"></i>Informasi Pemesan
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Nama:</th>
                                        <td>{{ $reservation->nama_pemesan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $reservation->email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-calendar me-2"></i>Informasi Booking
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Tanggal:</th>
                                        <td>{{ $reservation->tanggal->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu:</th>
                                        <td>{{ $reservation->jam_mulai }} - {{ $reservation->jam_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ruangan:</th>
                                        <td>{{ $reservation->room->nama_ruangan ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="badge status-pending badge-status">
                                                Pending
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($reservation->keterangan)
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-sticky-note me-2"></i>Keterangan
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $reservation->keterangan }}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <form action="{{ route('petugas.reservations.approve', $reservation->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success" onclick="return confirm('Setujui booking ini?')">
                        <i class="fas fa-check me-1"></i>Setujui
                    </button>
                </form>
                <form action="{{ route('petugas.reservations.reject', $reservation->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak booking ini?')">
                        <i class="fas fa-times me-1"></i>Tolak
                    </button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($historyReservations as $reservation)
<!-- Modal Detail History -->
<div class="modal fade" id="historyModal{{ $reservation->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-history me-2"></i>Detail Riwayat Booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <i class="fas fa-user me-2"></i>Informasi Pemesan
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Nama:</th>
                                        <td>{{ $reservation->nama_pemesan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $reservation->email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <i class="fas fa-calendar me-2"></i>Informasi Booking
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Tanggal:</th>
                                        <td>{{ $reservation->tanggal->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu:</th>
                                        <td>{{ $reservation->jam_mulai }} - {{ $reservation->jam_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ruangan:</th>
                                        <td>{{ $reservation->room->nama_ruangan ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="badge badge-status 
                                                {{ $reservation->status === 'disetujui' ? 'status-disetujui' : 'status-ditolak' }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($reservation->keterangan)
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-sticky-note me-2"></i>Keterangan
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $reservation->keterangan }}</p>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <i class="fas fa-clock me-2"></i>Timestamps
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">Dibuat:</th>
                                <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diupdate:</th>
                                <td>{{ $reservation->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle tab navigation with URL hash
        const hash = window.location.hash;
        if (hash) {
            const tab = new bootstrap.Tab(document.querySelector(`[data-bs-target="${hash}"]`));
            tab.show();
        }

        const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabEls.forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', function (event) {
                window.location.hash = event.target.getAttribute('data-bs-target');
            });
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
</body>
</html>