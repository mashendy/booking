<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('landing') }}">Booking Ruangan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#about" class="nav-link">Tentang</a></li>
                    <li class="nav-item"><a href="#rooms" class="nav-link">Ruangan</a></li>
                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-light btn-sm ms-2">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 text-center bg-primary text-white">
        <div class="container">
            <h1 class="fw-bold">Selamat Datang di Sistem Booking Ruangan</h1>
            <p class="lead">Pesan ruangan dengan mudah, cepat, dan praktis.</p>
            <a href="#rooms" class="btn btn-light btn-lg">Lihat Ruangan</a>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Tentang Sistem Ini</h2>
            <p class="text-muted">Aplikasi booking ruangan membantu Anda memesan ruangan rapat, kelas, atau acara dengan mudah. 
                Anda bisa melihat ketersediaan ruangan secara real-time dan melakukan reservasi hanya dengan beberapa klik.</p>
        </div>
    </section>

    <!-- Rooms -->
    <section id="rooms" class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">Daftar Ruangan</h2>
            <div class="row g-4">
                <!-- Card Ruangan 1 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://source.unsplash.com/400x250/?meeting,room" class="card-img-top" alt="Ruangan 1">
                        <div class="card-body">
                            <h5 class="card-title">Ruang Rapat A</h5>
                            <p class="card-text">Kapasitas 20 orang, dilengkapi proyektor dan AC.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">Booking</a>
                        </div>
                    </div>
                </div>
                <!-- Card Ruangan 2 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://source.unsplash.com/400x250/?classroom" class="card-img-top" alt="Ruangan 2">
                        <div class="card-body">
                            <h5 class="card-title">Ruang Kelas B</h5>
                            <p class="card-text">Kapasitas 40 orang, cocok untuk pelatihan atau seminar.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">Booking</a>
                        </div>
                    </div>
                </div>
                <!-- Card Ruangan 3 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://source.unsplash.com/400x250/?conference,hall" class="card-img-top" alt="Ruangan 3">
                        <div class="card-body">
                            <h5 class="card-title">Aula C</h5>
                            <p class="card-text">Kapasitas 100 orang, ideal untuk acara besar dan gathering.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 bg-primary text-white text-center">
        <p class="mb-0">© {{ date('Y') }} Booking Ruangan. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
