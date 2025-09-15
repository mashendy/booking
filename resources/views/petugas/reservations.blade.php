<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking Ruangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .badge {
            font-size: 0.75em;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .nav-tabs .nav-link.active {
            font-weight: 600;
        }
        .modal-dialog {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0">
                        <i class="fas fa-calendar-check me-2"></i>Manajemen Booking Ruangan
                    </h2>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
                    </a>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="reservationTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                            <i class="fas fa-clock me-1"></i>Menunggu Persetujuan
                            @if($pendingCount > 0)
                            <span class="badge bg-warning ms-1">{{ $pendingCount }}</span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                            <i class="fas fa-history me-1"></i>Riwayat
                            @if($historyCount > 0)
                            <span class="badge bg-secondary ms-1">{{ $historyCount }}</span>
                            @endif
                        </button>
                    </li>
                </ul>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="reservationTabsContent">
                    <!-- Tab 1: Pending Approvals -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                        @if($pendingReservations->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Tidak ada booking yang menunggu persetujuan.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nama Pemesan</th>
                                            <th>Email</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Ruangan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingReservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->nama_pemesan }}</td>
                                            <td>{{ $reservation->email }}</td>
                                            <td>{{ $reservation->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $reservation->jam_mulai }} - {{ $reservation->jam_selesai }}</td>
                                            <td>{{ $reservation->room->nama_ruangan ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $reservation->id }}">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </button>
                                                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success" onclick="return confirm('Setujui booking ini?')">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak booking ini?')">
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
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Tidak ada riwayat persetujuan.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nama Pemesan</th>
                                            <th>Email</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Ruangan</th>
                                            <th>Status</th>
                                            <th>Tanggal Update</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($historyReservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->nama_pemesan }}</td>
                                            <td>{{ $reservation->email }}</td>
                                            <td>{{ $reservation->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $reservation->jam_mulai }} - {{ $reservation->jam_selesai }}</td>
                                            <td>{{ $reservation->room->nama_ruangan ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $reservation->status === 'disetujui' ? 'success' : 'danger' }}">
                                                    {{ $reservation->status }}
                                                </span>
                                            </td>
                                            <td>{{ $reservation->updated_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#historyModal{{ $reservation->id }}">
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
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-calendar-alt me-2"></i>Detail Booking
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Pemesan</h6>
                            <table class="table table-sm">
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
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Booking</h6>
                            <table class="table table-sm">
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
                                        <span class="badge bg-warning">Pending</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($reservation->keterangan)
                    <div class="mt-3">
                        <h6 class="text-muted">Keterangan</h6>
                        <div class="border rounded p-3 bg-light">
                            {{ $reservation->keterangan }}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Setujui booking ini?')">
                            <i class="fas fa-check me-1"></i>Setujui
                        </button>
                    </form>
                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" class="d-inline">
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
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-history me-2"></i>Detail Riwayat Booking
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Pemesan</h6>
                            <table class="table table-sm">
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
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Booking</h6>
                            <table class="table table-sm">
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
                                        <span class="badge bg-{{ $reservation->status === 'disetujui' ? 'success' : 'danger' }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($reservation->keterangan)
                    <div class="mt-3">
                        <h6 class="text-muted">Keterangan</h6>
                        <div class="border rounded p-3 bg-light">
                            {{ $reservation->keterangan }}
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Timestamps</h6>
                            <table class="table table-sm">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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