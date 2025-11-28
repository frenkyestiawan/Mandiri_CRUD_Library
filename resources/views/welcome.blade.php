<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: false }" x-init="const storedTheme = localStorage.getItem('theme')
if (storedTheme === 'dark') {
    dark = true
} else if (storedTheme === 'light') {
    dark = false
} else if (
    window.matchMedia &&
    window.matchMedia('(prefers-color-scheme: dark)').matches
) {
    dark = true
}
$watch('dark', (value) => {
    if (value) {
        document.body.classList.add('dark')
        localStorage.setItem('theme', 'dark')
    } else {
        document.body.classList.remove('dark')
        localStorage.setItem('theme', 'light')
    }
})
if (dark) document.body.classList.add('dark')"
    :class="{ 'dark': dark }">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'E-PERPUS') }} - Perpustakaan Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Welcome Styles -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />
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
                        <a href="{{ url('/dashboard') }}" class="btn btn-register">
                            Dashboard
                        </a>

                        @if (Auth::user()->hasRole('Admin'))
                            <a href="{{ route('admin.books.index') }}" class="btn btn-login">
                                <i class="bi bi-journal-bookmark"></i>
                                Katalog Buku
                            </a>
                        @elseif (Auth::user()->hasRole('Anggota'))
                            <a href="{{ route('member.books.index') }}" class="btn btn-login">
                                <i class="bi bi-journal-bookmark"></i>
                                Katalog Buku
                            </a>
                        @endif
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
            <p class="section-subtitle">
                Nikmati berbagai fitur modern yang memudahkan Anda dalam menemukan dan mengelola
                peminjaman buku.
            </p>

            <div class="features-grid">
                <!-- Pencarian Cepat -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="feature-title">Pencarian Cepat</h3>
                    <p class="feature-description">
                        Temukan buku yang Anda cari dengan cepat melalui fitur pencarian
                        berdasarkan judul, penulis, atau kategori.
                    </p>
                </div>

                <!-- Akses Mobile -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h3 class="feature-title">Akses Mobile Responsif</h3>
                    <p class="feature-description">
                        Akses perpustakaan kapan saja dan di mana saja melalui tampilan mobile
                        yang responsif dan nyaman digunakan.
                    </p>
                </div>

                <!-- Peminjaman Online -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Peminjaman Buku Online</h3>
                    <p class="feature-description">
                        Ajukan peminjaman buku secara online dan pantau statusnya secara
                        real-time tanpa harus datang ke perpustakaan.
                    </p>
                </div>

                <!-- Rekomendasi Buku -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-stars"></i>
                    </div>
                    <h3 class="feature-title">Rekomendasi Buku</h3>
                    <p class="feature-description">
                        Dapatkan rekomendasi buku berdasarkan daftar peminjaman terbanyak dan
                        preferensi pembaca dengan minat serupa.
                    </p>
                </div>

                <!-- Profil Anggota -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h3 class="feature-title">Profil Anggota</h3>
                    <p class="feature-description">
                        Kelola informasi keanggotaan Anda serta akses data peminjaman yang
                        terhubung dengan akun Anda.
                    </p>
                </div>

                <!-- Riwayat Peminjaman -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h3 class="feature-title">Riwayat Peminjaman</h3>
                    <p class="feature-description">
                        Telusuri riwayat lengkap buku yang pernah Anda pinjam untuk memudahkan
                        pemantauan aktivitas membaca.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="about">
        <div class="cta-content">
            <h2 class="cta-title">Mulai Perjalanan Literasi Anda</h2>
            <p class="cta-subtitle">
                Bergabunglah dengan ribuan pembaca lainnya dan nikmati akses ke koleksi buku
                digital terlengkap
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
                <p style="color: rgba(255, 255, 255, 0.8)">
                    Sistem perpustakaan digital modern yang memudahkan akses ke berbagai koleksi
                    buku dan literatur.
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
                <a href="#about" class="footer-link">Bantuan</a>
            </div>
            <div>
                <h3 class="footer-title">Kontak</h3>
                <p style="color: rgba(255, 255, 255, 0.8)">
                    <i class="bi bi-geo-alt-fill"></i>
                    Jl. Pendidikan No. 123
                    <br />
                    <i class="bi bi-telephone-fill"></i>
                    (021) 1234-5678
                    <br />
                    <i class="bi bi-envelope-fill"></i>
                    info
                    @e-perpus.id
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} E-PERPUS. Sistem Perpustakaan Digital.</p>
            <p class="mb-0">
                <small>
                    Dikembangkan dengan
                    <i class="bi bi-heart-fill text-danger"></i>
                    untuk Pendidikan Indonesia
                </small>
            </p>
        </div>
    </footer>

    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>
