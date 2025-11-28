<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'E-PERPUS'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Layout Styles -->
    <link rel="stylesheet" href="{{ asset('css/layout/app.css') }}">

    @stack('styles')
</head>
<body x-data="{ dark: false }" x-init="
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
            document.body.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    });
    if (dark) document.body.classList.add('dark');
" :class="{ 'dark': dark }">
    
    <div class="main-wrapper">
        <!-- Navigation Bar -->
        <nav class="navbar" x-data="{ open: false, scrolled: false }" 
             @scroll.window="scrolled = window.pageYOffset > 20"
             :class="{ 'scrolled': scrolled }">
            <div class="navbar-container">
                <!-- Left: Logo & Menu -->
                <div class="navbar-left">
                    <a href="{{ route('dashboard') }}" class="navbar-brand">
                        <div class="brand-icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <span class="brand-text">E-PERPUS</span>
                    </a>

                    <!-- Desktop Menu -->
                    <ul class="navbar-menu" :class="{ 'show': open }">
                        @auth
                            @if(Auth::user()->hasRole('Admin'))
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                        <i class="bi bi-speedometer2"></i>
                                        Dashboard Admin
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.books.index') }}" 
                                       class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                                        <i class="bi bi-journal-bookmark"></i>
                                        Buku
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.loans.index') }}" 
                                       class="nav-link {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}">
                                        <i class="bi bi-arrow-left-right"></i>
                                        Peminjaman
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.returns.index') }}" 
                                       class="nav-link {{ request()->routeIs('admin.returns.*') ? 'active' : '' }}">
                                        <i class="bi bi-arrow-repeat"></i>
                                        Pengembalian
                                    </a>
                                </li>
                            @elseif(Auth::user()->hasRole('Anggota'))
                                <li>
                                    <a href="{{ route('member.dashboard') }}" 
                                       class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                                        <i class="bi bi-house-door"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('member.books.index') }}" 
                                       class="nav-link {{ request()->routeIs('member.books.*') ? 'active' : '' }}">
                                        <i class="bi bi-journal-bookmark"></i>
                                        Buku
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('member.loans.index') }}" 
                                       class="nav-link {{ request()->routeIs('member.loans.*') ? 'active' : '' }}">
                                        <i class="bi bi-bookmark-heart"></i>
                                        Peminjaman Saya
                                    </a>
                                </li>
                            @endif
                        @endauth
                </div>

                <!-- Right: Dark Mode + Profile/Auth -->
                <div class="navbar-actions">
                    <!-- Dark Mode Toggle -->
                    <button @click="dark = !dark" class="dark-mode-toggle">
                        <i :class="dark ? 'bi bi-sun' : 'bi bi-moon'"></i>
                    </button>

                    @auth
                        <!-- Profile Dropdown -->
                        <div class="user-dropdown" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="user-trigger">
                                <div class="user-avatar-placeholder">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <i class="bi bi-chevron-down dropdown-icon"></i>
                            </button>

                            <div class="dropdown-menu" :class="{ 'show': dropdownOpen }">
                                <div class="dropdown-header">
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-email">{{ Auth::user()->email }}</div>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="bi bi-person"></i>
                                    Profil Saya
                                </a>

                                <div class="dropdown-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item danger">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Auth Buttons for Guests -->
                        <div class="auth-buttons">
                            <a href="{{ route('login') }}" class="btn btn-outline">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">
                                    <i class="bi bi-person-plus"></i>
                                    Daftar
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Mobile Hamburger -->
                <button @click="open = !open" class="mobile-menu-toggle" :class="{ 'active': open }">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </nav>

        <!-- Page Header (Optional) -->
        @hasSection('header')
            <header class="page-header">
                <div class="page-header-content">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-grid">
                    <!-- Brand Section -->
                    <div class="footer-section">
                        <div class="footer-brand">
                            <div class="footer-brand-icon">
                                <i class="bi bi-book-fill"></i>
                            </div>
                            <span class="footer-brand-text">E-PERPUS</span>
                        </div>
                        <p class="footer-description">
                            Sistem perpustakaan digital modern yang memudahkan akses ke berbagai koleksi buku dan literatur untuk mendukung kegiatan belajar mengajar.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link" title="Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-link" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-section">
                        <h3>Tautan Cepat</h3>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="bi bi-chevron-right"></i>
                                    Beranda
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    Tentang Kami
                                </a>
                            </li>
                            <li>
                                @auth
                                    @if(Auth::user()->hasRole('Admin'))
                                        <a href="{{ route('admin.books.index') }}">
                                            <i class="bi bi-chevron-right"></i>
                                            Katalog Buku
                                        </a>
                                    @elseif(Auth::user()->hasRole('Anggota'))
                                        <a href="{{ route('member.books.index') }}">
                                            <i class="bi bi-chevron-right"></i>
                                            Katalog Buku
                                        </a>
                                    @else
                                        <a href="#">
                                            <i class="bi bi-chevron-right"></i>
                                            Katalog Buku
                                        </a>
                                    @endif
                                @else
                                    <a href="#">
                                        <i class="bi bi-chevron-right"></i>
                                        Katalog Buku
                                    </a>
                                @endauth
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    Bantuan
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div class="footer-section">
                        <h3>Layanan</h3>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="bi bi-chevron-right"></i>
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    <i class="bi bi-chevron-right"></i>
                                    Pendaftaran Anggota
                                </a>
                            </li>
                            <li>
                                @auth
                                    @if(Auth::user()->hasRole('Admin'))
                                        <a href="{{ route('admin.loans.index') }}">
                                            <i class="bi bi-chevron-right"></i>
                                            Peminjaman Online
                                        </a>
                                    @elseif(Auth::user()->hasRole('Anggota'))
                                        <a href="{{ route('member.loans.index') }}">
                                            <i class="bi bi-chevron-right"></i>
                                            Peminjaman Online
                                        </a>
                                    @else
                                        <a href="#">
                                            <i class="bi bi-chevron-right"></i>
                                            Peminjaman Online
                                        </a>
                                    @endif
                                @else
                                    <a href="#">
                                        <i class="bi bi-chevron-right"></i>
                                        Peminjaman Online
                                    </a>
                                @endauth
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    FAQ
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="footer-section">
                        <h3>Kontak</h3>
                        <ul class="footer-contact">
                            <li>
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Jl. Pendidikan No. 123<br>Jakarta Pusat, 10110</span>
                            </li>
                            <li>
                                <i class="bi bi-telephone-fill"></i>
                                <span>(021) 1234-5678</span>
                            </li>
                            <li>
                                <i class="bi bi-envelope-fill"></i>
                                <span>info@e-perpus.id</span>
                            </li>
                            <li>
                                <i class="bi bi-clock-fill"></i>
                                <span>Senin - Jumat: 08:00 - 17:00</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="footer-copyright">
                        &copy; {{ date('Y') }} E-PERPUS. Sistem Perpustakaan Digital. All rights reserved.
                    </div>
                    <div class="footer-legal">
                        <a href="#">Kebijakan Privasi</a>
                        <a href="#">Syarat & Ketentuan</a>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')

    <script src="{{ asset('js/layout/app.js') }}"></script>
</body>
</html>