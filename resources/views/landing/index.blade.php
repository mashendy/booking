<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(67, 97, 238, 0.95) !important;
            backdrop-filter: blur(10px);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .navbar-nav .nav-link:hover {
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: white;
            color: var(--primary);
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 100px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .btn-hero {
            background: white;
            color: var(--primary);
            border-radius: 50px;
            padding: 15px 35px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s;
        }
        
        .btn-hero:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }
        
        /* About Section */
        .about {
            padding: 100px 0;
            background: white;
        }
        
        .section-title {
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .about-text {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Features */
        .features {
            padding: 50px 0;
            background: #f8f9fa;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            height: 100%;
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .feature-title {
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .feature-text {
            color: #6c757d;
        }
        
        /* Rooms Section */
        .rooms {
            padding: 100px 0;
            background: white;
        }
        
        .room-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            height: 100%;
        }
        
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .room-img {
            height: 200px;
            object-fit: cover;
        }
        
        .room-card-body {
            padding: 25px;
        }
        
        .room-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .room-text {
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .btn-room {
            background: var(--primary);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-room:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 40px 0 20px;
        }
        
        .footer p {
            margin: 0;
        }
        
        /* Animations */
        [data-aos] {
            transition: all 0.8s ease;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-door-open me-2"></i>Booking Ruangan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#about" class="nav-link">Tentang</a></li>
                    <li class="nav-item"><a href="#features" class="nav-link">Fitur</a></li>
                    <li class="nav-item"><a href="#rooms" class="nav-link">Ruangan</a></li>
                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-login btn-sm ms-2">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-8 mx-auto text-center hero-content">
                    <h1 class="hero-title" data-aos="fade-up">Selamat Datang di Sistem Booking Ruangan</h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
                        Pesan ruangan dengan mudah, cepat, dan praktis. Kelola reservasi Anda dalam satu platform terintegrasi.
                    </p>
                    <a href="#rooms" class="btn btn-hero" data-aos="fade-up" data-aos-delay="400">
                        <i class="fas fa-calendar-check me-2"></i>Lihat Ruangan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container text-center">
            <h2 class="section-title" data-aos="fade-up">Tentang Sistem Ini</h2>
            <p class="about-text" data-aos="fade-up" data-aos-delay="200">
                Aplikasi booking ruangan membantu Anda memesan ruangan rapat, kelas, atau acara dengan mudah. 
                Anda bisa melihat ketersediaan ruangan secara real-time dan melakukan reservasi hanya dengan beberapa klik.
                Sistem ini dirancang untuk memudahkan manajemen pemesanan ruangan di institusi Anda.
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="feature-title">Booking Mudah</h3>
                        <p class="feature-text">Pesan ruangan kapan saja dengan antarmuka yang intuitif dan user-friendly.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="feature-title">Real-Time</h3>
                        <p class="feature-text">Lihat ketersediaan ruangan secara real-time dan hindari double booking.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="feature-title">Notifikasi</h3>
                        <p class="feature-text">Dapatkan pemberitahuan untuk jadwal booking dan pengingat acara.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="rooms">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Daftar Ruangan</h2>
            <div class="row g-4">
                <!-- Card Ruangan 1 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="room-card">
                        <img src="https://source.unsplash.com/400x250/?meeting,room" class="room-img card-img-top" alt="Ruangan 1">
                        <div class="room-card-body">
                            <h5 class="room-title">Ruang Rapat A</h5>
                            <p class="room-text">Kapasitas 20 orang, dilengkapi proyektor dan AC. Cocok untuk presentasi dan rapat tim.</p>
                            <a href="{{ route('login') }}" class="btn btn-room">
                                <i class="fas fa-bookmark me-2"></i>Booking Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Card Ruangan 2 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="room-card">
                        <img src="https://source.unsplash.com/400x250/?classroom" class="room-img card-img-top" alt="Ruangan 2">
                        <div class="room-card-body">
                            <h5 class="room-title">Ruang Kelas B</h5>
                            <p class="room-text">Kapasitas 40 orang, cocok untuk pelatihan atau seminar. Dilengkapi whiteboard dan sound system.</p>
                            <a href="{{ route('login') }}" class="btn btn-room">
                                <i class="fas fa-bookmark me-2"></i>Booking Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Card Ruangan 3 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="room-card">
                        <img src="https://source.unsplash.com/400x250/?conference,hall" class="room-img card-img-top" alt="Ruangan 3">
                        <div class="room-card-body">
                            <h5 class="room-title">Aula C</h5>
                            <p class="room-text">Kapasitas 100 orang, ideal untuk acara besar dan gathering. Dilengkapi panggung dan lighting.</p>
                            <a href="{{ route('login') }}" class="btn btn-room">
                                <i class="fas fa-bookmark me-2"></i>Booking Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>© {{ date('Y') }} Booking Ruangan. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true,
                easing: 'ease-in-out'
            });
            
            // Navbar background on scroll
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(67, 97, 238, 0.98) !important';
                    navbar.style.padding = '10px 0';
                } else {
                    navbar.style.background = 'rgba(67, 97, 238, 0.95) !important';
                    navbar.style.padding = '15px 0';
                }
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>