<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: false }" x-init="
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme === 'dark') {
        dark = true;
    } else if (storedTheme === 'light') {
        dark = false;
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        dark = true;
    }
    $watch('dark', value => {
        if (value) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    });
" :class="{ 'dark': dark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-PERPUS') }} - Perpustakaan Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #2563eb;
            --primary-dark: #1e40af;
            --primary-darker: #1e3a8a;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Light mode */
        body:not(.dark) {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e22ce 100%);
            color: #1e293b;
        }

        /* Dark mode */
        body.dark {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: #e2e8f0;
        }

        /* Animated background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(90deg, rgba(255,255,255,0.03) 0px, transparent 2px, transparent 40px),
                repeating-linear-gradient(0deg, rgba(255,255,255,0.03) 0px, transparent 2px, transparent 40px);
            animation: backgroundScroll 20s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes backgroundScroll {
            0% { transform: translate(0, 0); }
            100% { transform: translate(40px, 40px); }
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Light mode nav */
        nav:not(.dark-nav) {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Dark mode nav */
        nav.dark-nav {
            background: rgba(15, 23, 42, 0.95);
            border-bottom: 1px solid rgba(51, 65, 85, 0.8);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .nav-brand:hover {
            transform: scale(1.05);
        }

        .nav-logo {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .nav-logo i {
            font-size: 20px;
            color: white;
        }

        .nav-title {
            font-weight: 700;
            font-size: 20px;
        }

        body:not(.dark) .nav-title {
            color: #2563eb;
        }

        body.dark .nav-title {
            color: #60a5fa;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-link {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        body:not(.dark) .nav-link {
            color: #1e293b;
        }

        body:not(.dark) .nav-link:hover {
            background: #dbeafe;
            color: #2563eb;
        }

        body.dark .nav-link {
            color: #e2e8f0;
        }

        body.dark .nav-link:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }

        .btn {
            padding: 8px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login {
            background: transparent;
            border: 2px solid #2563eb;
            color: #2563eb;
        }

        .btn-login:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
        }

        body.dark .btn-login {
            border-color: #60a5fa;
            color: #60a5fa;
        }

        body.dark .btn-login:hover {
            background: #60a5fa;
            color: #0f172a;
        }

        .btn-register {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }

        .dark-mode-toggle {
            padding: 8px;
            border-radius: 8px;
            border: 2px solid;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.dark) .dark-mode-toggle {
            border-color: #e2e8f0;
            color: #1e293b;
        }

        body:not(.dark) .dark-mode-toggle:hover {
            background: #dbeafe;
            border-color: #2563eb;
            color: #2563eb;
        }

        body.dark .dark-mode-toggle {
            border-color: #475569;
            color: #e2e8f0;
        }

        body.dark .dark-mode-toggle:hover {
            background: rgba(59, 130, 246, 0.2);
            border-color: #60a5fa;
            color: #60a5fa;
        }

        /* Hero Section */
        .hero-section {
            padding: 150px 20px 80px;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease;
        }

        body:not(.dark) .hero-title {
            color: white;
        }

        body.dark .hero-title {
            color: #f1f5f9;
        }

        .hero-subtitle {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.95;
            animation: fadeInUp 1.2s ease;
        }

        body:not(.dark) .hero-subtitle {
            color: rgba(255, 255, 255, 0.95);
        }

        body.dark .hero-subtitle {
            color: rgba(226, 232, 240, 0.9);
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1.4s ease;
        }

        .hero-btn {
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .hero-btn-primary {
            background: white;
            color: #2563eb;
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.3);
        }

        .hero-btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(255, 255, 255, 0.4);
            color: #1e40af;
        }

        body.dark .hero-btn-primary {
            background: #1e293b;
            color: #60a5fa;
        }

        body.dark .hero-btn-primary:hover {
            background: #334155;
            color: #93c5fd;
        }

        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        body:not(.dark) .hero-btn-secondary {
            color: white;
        }

        body.dark .hero-btn-secondary {
            color: #e2e8f0;
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(100, 116, 139, 0.5);
        }

        .hero-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
        }

        body.dark .hero-btn-secondary:hover {
            background: rgba(51, 65, 85, 0.7);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Features Section */
        .features-section {
            padding: 80px 20px;
            position: relative;
            z-index: 1;
            transition: background 0.3s ease;
        }

        body:not(.dark) .features-section {
            background: rgba(255, 255, 255, 0.95);
        }

        body.dark .features-section {
            background: rgba(15, 23, 42, 0.95);
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 60px;
        }

        body:not(.dark) .section-title {
            color: #1e40af;
        }

        body.dark .section-title {
            color: #60a5fa;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            border: 2px solid;
        }

        body:not(.dark) .feature-card {
            background: white;
            border-color: #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        body:not(.dark) .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.2);
            border-color: #2563eb;
        }

        body.dark .feature-card {
            background: #1e293b;
            border-color: #334155;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        body.dark .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
            border-color: #60a5fa;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .feature-icon i {
            font-size: 40px;
            color: white;
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        body:not(.dark) .feature-title {
            color: #1e40af;
        }

        body.dark .feature-title {
            color: #60a5fa;
        }

        .feature-description {
            line-height: 1.7;
            font-size: 15px;
        }

        body:not(.dark) .feature-description {
            color: #64748b;
        }

        body.dark .feature-description {
            color: #94a3b8;
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            position: relative;
            z-index: 1;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .stat-card {
            text-align: center;
            color: white;
            padding: 30px;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stat-label {
            font-size: 18px;
            opacity: 0.95;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 20px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 60px 40px;
        }

        body.dark .cta-content {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(100, 116, 139, 0.5);
        }

        .cta-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        body:not(.dark) .cta-title {
            color: white;
        }

        body.dark .cta-title {
            color: #f1f5f9;
        }

        .cta-subtitle {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        body:not(.dark) .cta-subtitle {
            color: rgba(255, 255, 255, 0.95);
        }

        body.dark .cta-subtitle {
            color: rgba(226, 232, 240, 0.9);
        }

        /* Footer */
        .footer {
            padding: 40px 20px 20px;
            position: relative;
            z-index: 1;
            transition: background 0.3s ease;
        }

        body:not(.dark) .footer {
            background: rgba(30, 41, 59, 0.95);
            color: white;
        }

        body.dark .footer {
            background: rgba(15, 23, 42, 0.98);
            color: #e2e8f0;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #3b82f6;
        }

        body.dark .footer-title {
            color: #60a5fa;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: #3b82f6;
            padding-left: 5px;
        }

        body.dark .footer-link:hover {
            color: #60a5fa;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            max-width: 1200px;
            margin: 0 auto;
        }

        body.dark .footer-bottom {
            border-top-color: rgba(100, 116, 139, 0.3);
            color: rgba(148, 163, 184, 0.8);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            padding: 8px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 24px;
        }

        body:not(.dark) .mobile-menu-btn {
            color: #1e293b;
        }

        body.dark .mobile-menu-btn {
            color: #e2e8f0;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-links.mobile-open {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                padding: 20px;
                gap: 10px;
            }

            body:not(.dark) .nav-links.mobile-open {
                background: rgba(255, 255, 255, 0.98);
                border-top: 1px solid #e2e8f0;
            }

            body.dark .nav-links.mobile-open {
                background: rgba(15, 23, 42, 0.98);
                border-top: 1px solid #334155;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .hero-btn {
                padding: 12px 30px;
                font-size: 16px;
            }

            .section-title {
                font-size: 32px;
            }

            .cta-title {
                font-size: 32px;
            }

            .nav-title {
                font-size: 18px;
            }
        
        }
    </style>
</head>
<body :class="{ 'dark': dark }">
    <!-- Navigation -->
    <nav :class="{ 'dark-nav': dark }" x-data="{ mobileOpen: false }">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-brand">
                <div class="nav-logo">
                    <i class="bi bi-book-fill"></i>
                </div>
                <span class="nav-title">E-PERPUS</span>
            </a>
            
            <div class="nav-links" :class="{ 'mobile-open': mobileOpen }">
                <a href="#features" class="nav-link">Fitur</a>
                <a href="#about" class="nav-link">Tentang</a>
                
                <button @click="dark = !dark" class="dark-mode-toggle">
                    <i :class="dark ? 'bi bi-sun' : 'bi bi-moon'"></i>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-register">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-register">
                                <i class="bi bi-person-plus"></i>
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <button @click="mobileOpen = !mobileOpen" class="mobile-menu-btn">
                <i :class="mobileOpen ? 'bi bi-x-lg' : 'bi bi-list'"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Selamat Datang di E-PERPUS</h1>
            <p class="hero-subtitle">
                Sistem Perpustakaan Digital Modern untuk Kemudahan Akses Buku dan Literatur
            </p>
            <div class="hero-buttons">
                @guest
                    <a href="{{ route('register') }}" class="hero-btn hero-btn-primary">
                        <i class="bi bi-person-plus-fill"></i>
                        Daftar Sekarang
                    </a>
                    <a href="#features" class="hero-btn hero-btn-secondary">
                        <i class="bi bi-arrow-down-circle"></i>
                        Pelajari Lebih Lanjut
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="hero-btn hero-btn-primary">
                        <i class="bi bi-speedometer2"></i>
                        Ke Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="section-container">
            <h2 class="section-title">Fitur Unggulan</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="feature-title">Pencarian Cepat</h3>
                    <p class="feature-description">
                        Temukan buku yang Anda cari dengan cepat menggunakan sistem pencarian canggih berdasarkan judul, penulis, atau kategori.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h3 class="feature-title">Akses Mobile</h3>
                    <p class="feature-description">
                        Akses perpustakaan kapan saja dan di mana saja melalui perangkat mobile Anda dengan tampilan responsif.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Peminjaman Online</h3>
                    <p class="feature-description">
                        Pinjam buku secara online dengan mudah dan pantau status peminjaman Anda secara real-time.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <h3 class="feature-title">Notifikasi Otomatis</h3>
                    <p class="feature-description">
                        Dapatkan pengingat otomatis untuk pengembalian buku dan informasi koleksi terbaru.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bookmark-star"></i>
                    </div>
                    <h3 class="feature-title">Wishlist & Favorit</h3>
                    <p class="feature-description">
                        Simpan buku favorit Anda dan buat daftar keinginan untuk dibaca nanti.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="feature-title">Riwayat Lengkap</h3>
                    <p class="feature-description">
                        Lihat riwayat peminjaman dan aktivitas membaca Anda secara mendetail.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">10,000+</div>
                <div class="stat-label">Koleksi Buku</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">5,000+</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Akses Online</div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="about">
        <div class="cta-content">
            <h2 class="cta-title">Mulai Perjalanan Literasi Anda</h2>
            <p class="cta-subtitle">
                Bergabunglah dengan ribuan pembaca lainnya dan nikmati akses ke koleksi buku digital terlengkap
            </p>
            @guest
                <a href="{{ route('register') }}" class="hero-btn hero-btn-primary">
                    <i class="bi bi-person-check-fill"></i>
                    Daftar Gratis Sekarang
                </a>
            @else
                <a href="{{ url('/books') }}" class="hero-btn hero-btn-primary">
                    <i class="bi bi-book"></i>
                    Jelajahi Koleksi Buku
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div>
                <h3 class="footer-title">E-PERPUS</h3>
                <p style="color: rgba(255, 255, 255, 0.8);">
                    Sistem perpustakaan digital modern yang memudahkan akses ke berbagai koleksi buku dan literatur.
                </p>
            </div>
            <div>
                <h3 class="footer-title">Tautan</h3>
                <a href="#about" class="footer-link">Tentang Kami</a>
                <a href="#features" class="footer-link">Fitur</a>
                <a href="#" class="footer-link">Kontak</a>
                <a href="#" class="footer-link">FAQ</a>
            </div>
            <div>
                <h3 class="footer-title">Layanan</h3>
                <a href="{{ route('login') }}" class="footer-link">Login</a>
                <a href="{{ route('register') }}" class="footer-link">Pendaftaran</a>
                <a href="#features" class="footer-link">Katalog Buku</a>
                <a href="#about" class="footer-link">Bantuan</a>
            </div>
            <div>
                <h3 class="footer-title">Kontak</h3>
                <p style="color: rgba(255, 255, 255, 0.8);">
                    <i class="bi bi-geo-alt-fill"></i> Jl. Pendidikan No. 123<br>
                    <i class="bi bi-telephone-fill"></i> (021) 1234-5678<br>
                    <i class="bi bi-envelope-fill"></i> info@e-perpus.id
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} E-PERPUS. Sistem Perpustakaan Digital.</p>
            <p class="mb-0">
                <small>Dikembangkan dengan <i class="bi bi-heart-fill text-danger"></i> untuk Pendidikan Indonesia</small>
            </p>
        </div>
    </footer>

    <script>
        // Smooth scroll untuk anchor di halaman
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>