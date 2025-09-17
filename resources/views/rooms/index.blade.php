<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        .btn-action {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.85rem;
            margin-right: 5px;
        }
        
        .btn-edit {
            background: linear-gradient(to right, #ff9a3c, #ff6b6b);
            border: none;
        }
        
        .btn-delete {
            background: linear-gradient(to right, #f72585, #b5179e);
            border: none;
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
        
        .room-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .capacity-badge {
            background: linear-gradient(to right, #4cc9f0, #4895ef);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .description-text {
            color: #6c757d;
            line-height: 1.5;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
            
            .btn-action {
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
            <div class="col-md-6">
                <h1 class="page-title"><i class="fas fa-door-open"></i> Manajemen Ruangan</h1>
            </div>
            <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>

            <div class="col-md-6 text-md-end header-actions">
                <!-- Tombol Tambah -->
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <i class="fas fa-plus me-2"></i> Tambah Ruangan
                </button>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> Terdapat kesalahan dalam input data. Silakan periksa kembali.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Tabel Ruangan -->
    <div class="card shadow-sm">
        <div class="card-header">
            <i class="fas fa-list me-2"></i> Daftar Ruangan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Kapasitas</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $index => $room)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="room-icon">
                                            <i class="fas fa-door-closed"></i>
                                        </div>
                                        <div>{{ $room->nama }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="capacity-badge">
                                        <i class="fas fa-users me-1"></i> {{ $room->kapasitas }} orang
                                    </span>
                                </td>
                                <td class="description-text">{{ $room->deskripsi ?: 'Tidak ada deskripsi' }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-sm btn-warning btn-action btn-edit" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal"
                                            data-id="{{ $room->id }}"
                                            data-nama="{{ $room->nama }}"
                                            data-kapasitas="{{ $room->kapasitas }}"
                                            data-deskripsi="{{ $room->deskripsi }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger btn-action btn-delete" onclick="return confirm('Yakin hapus ruangan ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-door-closed"></i>
                                        <h4>Belum ada ruangan</h4>
                                        <p>Silakan tambah ruangan baru dengan menekan tombol "Tambah Ruangan"</p>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('rooms.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i> Tambah Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Ruangan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    </div>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Kapasitas</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                        <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas') }}" required>
                    </div>
                    @error('kapasitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                    </div>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit (Satu untuk semua) -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" method="POST" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Ruangan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                        <input type="text" id="edit_nama" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                    </div>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Kapasitas</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                        <input type="number" id="edit_kapasitas" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" required>
                    </div>
                    @error('kapasitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        <textarea id="edit_deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3"></textarea>
                    </div>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script untuk mengisi data ke modal edit
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('editModal');
        
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const kapasitas = button.getAttribute('data-kapasitas');
            const deskripsi = button.getAttribute('data-deskripsi');
            
            // Update form action URL
            const form = document.getElementById('editForm');
            form.action = '/rooms/' + id;
            
            // Isi nilai form
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_kapasitas').value = kapasitas;
            document.getElementById('edit_deskripsi').value = deskripsi;
        });
        
        // Reset form saat modal tambah ditutup
        const tambahModal = document.getElementById('tambahModal');
        tambahModal.addEventListener('hidden.bs.modal', function() {
            this.querySelector('form').reset();
        });
    });
</script>
</body>
</html>