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
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --accent-blue: #60a5fa;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Light Mode */
        body:not(.dark) {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 50%, #dbeafe 100%);
            color: var(--text-dark);
        }

        /* Dark Mode */
        body.dark {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: #e2e8f0;
        }

        /* Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(90deg, rgba(37, 99, 235, 0.03) 0px, transparent 2px, transparent 60px),
                repeating-linear-gradient(0deg, rgba(37, 99, 235, 0.03) 0px, transparent 2px, transparent 60px);
            pointer-events: none;
            z-index: 0;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        /* ========== NAVBAR STYLES ========== */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
            transition: all 0.3s ease;
            border-bottom: 1px solid;
        }

        body:not(.dark) .navbar {
            background: rgba(255, 255, 255, 0.95);
            border-bottom-color: var(--border-color);
            box-shadow: var(--shadow-md);
        }

        body.dark .navbar {
            background: rgba(15, 23, 42, 0.95);
            border-bottom-color: rgba(51, 65, 85, 0.5);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .navbar.scrolled {
            box-shadow: var(--shadow-lg);
        }

        body.dark .navbar.scrolled {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 75px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover .brand-icon {
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            transform: rotate(-5deg);
        }

        body.dark .brand-icon {
            box-shadow: 0 4px 15px rgba(96, 165, 250, 0.3);
        }

        .brand-text {
            font-family: 'Poppins', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        body:not(.dark) .brand-text {
            color: #0f172a;
        }

        body.dark .brand-text {
            color: #e2e8f0;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
        }

        .nav-link {
            position: relative;
            padding: 0.65rem 1.1rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        body:not(.dark) .nav-link {
            color: var(--text-dark);
        }

        body:not(.dark) .nav-link:hover {
            color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.08);
        }

        body:not(.dark) .nav-link.active {
            color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.12);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
        }

        body.dark .nav-link {
            color: #e2e8f0;
        }

        body.dark .nav-link:hover {
            color: var(--accent-blue);
            background: rgba(96, 165, 250, 0.15);
        }

        body.dark .nav-link.active {
            color: var(--accent-blue);
            background: rgba(96, 165, 250, 0.2);
            box-shadow: 0 2px 8px rgba(96, 165, 250, 0.2);
        }

        .nav-link i {
            font-size: 0.85rem;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            border: 2px solid;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        body:not(.dark) .dark-mode-toggle {
            border-color: var(--border-color);
            color: var(--text-dark);
            background: white;
        }

        body:not(.dark) .dark-mode-toggle:hover {
            background: var(--light-blue);
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            transform: rotate(15deg);
        }

        body.dark .dark-mode-toggle {
            border-color: rgba(100, 116, 139, 0.5);
            color: #e2e8f0;
            background: rgba(30, 41, 59, 0.5);
        }

        body.dark .dark-mode-toggle:hover {
            background: rgba(96, 165, 250, 0.2);
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            transform: rotate(-15deg);
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid;
        }

        body:not(.dark) .user-trigger {
            background: white;
            border-color: var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        body:not(.dark) .user-trigger:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
        }

        body.dark .user-trigger {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(100, 116, 139, 0.5);
        }

        body.dark .user-trigger:hover {
            border-color: var(--accent-blue);
            box-shadow: 0 4px 12px rgba(96, 165, 250, 0.2);
            transform: translateY(-2px);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-blue);
        }

        .user-avatar-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        body:not(.dark) .user-name {
            color: var(--text-dark);
        }

        body.dark .user-name {
            color: #e2e8f0;
        }

        .dropdown-icon {
            font-size: 0.75rem;
            transition: transform 0.3s ease;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.75rem);
            right: 0;
            min-width: 260px;
            border-radius: 16px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid;
        }

        body:not(.dark) .dropdown-menu {
            background: white;
            border-color: var(--border-color);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        body.dark .dropdown-menu {
            background: #1e293b;
            border-color: rgba(100, 116, 139, 0.3);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 1.25rem;
            border-bottom: 1px solid;
        }

        body:not(.dark) .dropdown-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            border-bottom-color: var(--border-color);
        }

        body.dark .dropdown-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-bottom-color: rgba(100, 116, 139, 0.3);
        }

        .dropdown-header .user-name {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .dropdown-header .user-email {
            font-size: 0.85rem;
        }

        body:not(.dark) .dropdown-header .user-email {
            color: var(--text-muted);
        }

        body.dark .dropdown-header .user-email {
            color: #94a3b8;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
            font-size: 0.9rem;
        }

        body:not(.dark) .dropdown-item {
            color: var(--text-dark);
        }

        body:not(.dark) .dropdown-item:hover {
            background: rgba(37, 99, 235, 0.08);
            color: var(--primary-blue);
        }

        body.dark .dropdown-item {
            color: #e2e8f0;
        }

        body.dark .dropdown-item:hover {
            background: rgba(96, 165, 250, 0.15);
            color: var(--accent-blue);
        }

        .dropdown-item.danger:hover {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        body.dark .dropdown-item.danger:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .dropdown-divider {
            height: 1px;
            margin: 0.5rem 0;
        }

        body:not(.dark) .dropdown-divider {
            background: var(--border-color);
        }

        body.dark .dropdown-divider {
            background: rgba(100, 116, 139, 0.3);
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .btn {
            padding: 0.65rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid;
        }

        body:not(.dark) .btn-outline {
            color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        body:not(.dark) .btn-outline:hover {
            background: var(--primary-blue);
            color: white;
        }

        body.dark .btn-outline {
            color: var(--accent-blue);
            border-color: var(--accent-blue);
        }

        body.dark .btn-outline:hover {
            background: var(--accent-blue);
            color: #0f172a;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            cursor: pointer;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            border: 2px solid;
        }

        body:not(.dark) .mobile-menu-toggle {
            background: white;
            border-color: var(--border-color);
        }

        body:not(.dark) .mobile-menu-toggle:hover {
            border-color: var(--primary-blue);
        }

        body.dark .mobile-menu-toggle {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(100, 116, 139, 0.5);
        }

        body.dark .mobile-menu-toggle:hover {
            border-color: var(--accent-blue);
        }

        .hamburger-line {
            width: 22px;
            height: 2.5px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        body:not(.dark) .hamburger-line {
            background: var(--text-dark);
        }

        body.dark .hamburger-line {
            background: #e2e8f0;
        }

        .mobile-menu-toggle.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translateY(7.5px);
        }

        .mobile-menu-toggle.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translateY(-7.5px);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        .page-header {
            border-bottom: 1px solid;
            margin-bottom: 2rem;
        }

        body:not(.dark) .page-header {
            background: white;
            border-bottom-color: var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        body.dark .page-header {
            background: #1e293b;
            border-bottom-color: rgba(100, 116, 139, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .page-header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 700;
        }

        body:not(.dark) .page-title {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body.dark .page-title {
            color: #f1f5f9;
        }

        /* ========== FOOTER STYLES ========== */
        .footer {
            margin-top: auto;
            border-top: 1px solid;
        }

        body:not(.dark) .footer {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            border-top-color: rgba(100, 116, 139, 0.3);
        }

        body.dark .footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            border-top-color: rgba(71, 85, 105, 0.3);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3.5rem 2rem 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 2.5rem;
        }

        .footer-section h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--accent-blue);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-brand-icon {
            width: 42px;
            height: 42px;
            background: rgba(96, 165, 250, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-blue);
            font-size: 20px;
            border: 1px solid rgba(96, 165, 250, 0.2);
        }

        .footer-brand-text {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
        }

        .footer-description {
            color: rgba(226, 232, 240, 0.7);
            line-height: 1.7;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(96, 165, 250, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-blue);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(96, 165, 250, 0.2);
        }

        .social-link:hover {
            background: rgba(96, 165, 250, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(96, 165, 250, 0.3);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.65rem;
        }

        .footer-links a {
            color: rgba(226, 232, 240, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-links a i {
            font-size: 0.75rem;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .footer-links a:hover i {
            opacity: 1;
            transform: translateX(0);
        }

        .footer-contact {
            list-style: none;
        }

        .footer-contact li {
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
            margin-bottom: 0.875rem;
            color: rgba(226, 232, 240, 0.75);
            font-size: 0.9rem;
        }

        .footer-contact i {
            font-size: 1.1rem;
            color: var(--accent-blue);
            margin-top: 0.15rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(100, 116, 139, 0.2);
            padding-top: 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-copyright {
            color: rgba(226, 232, 240, 0.6);
            font-size: 0.875rem;
        }

        .footer-legal {
            display: flex;
            gap: 1.5rem;
        }

        .footer-legal a {
            color: rgba(226, 232, 240, 0.6);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .footer-legal a:hover {
            color: white;
        }

        /* ========== UTILITY CLASSES ========== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ========== SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        body:not(.dark) ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        body:not(.dark) ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            border-radius: 5px;
        }

        body.dark ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        body.dark ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--accent-blue), var(--primary-blue));
            border-radius: 5px;
        }

        /* ========== PAGINATION (Laravel links()) ========== */
        .pagination nav {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
        }

        /* Info text ("Showing 1 to 10 of 20 results") */
        .pagination nav > div:first-child {
            display: block;
            margin-bottom: 0.25rem;
        }

        /* Container untuk tombol-tombol halaman */
        .pagination nav > div:nth-child(2) {
            display: inline-flex;
            align-items: center;
        }

        .pagination nav span,
        .pagination nav a {
            min-width: 28px;
            height: 28px;
            padding: 0 0.5rem;
            border-radius: 8px; /* kotak dengan sudut sedikit rounded */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        body:not(.dark) .pagination nav span,
        body:not(.dark) .pagination nav a {
            color: #1f2933;
        }

        body.dark .pagination nav span,
        body.dark .pagination nav a {
            color: #e2e8f0;
        }

        /* Pastikan teks info "Showing ..." terlihat di dark mode */
        body.dark .pagination nav > div:first-child span {
            color: #cbd5e1 !important;
        }

        body.dark .pagination nav > div:first-child span span {
            color: #f9fafb !important;
        }

        /* Halaman aktif: sama ukuran, hanya beda warna (lebih ringan) */
        .pagination nav span[aria-current="page"] {
            background: var(--secondary-blue);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 0 0 rgba(0,0,0,0);
            font-weight: 600;
        }

        /* Tombol normal - light mode */
        .pagination nav a {
            background: rgba(148, 163, 184, 0.04);
            border-color: rgba(148, 163, 184, 0.35);
        }

        .pagination nav a:hover {
            border-color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.08);
        }

        /* Tombol normal - dark mode */
        body.dark .pagination nav a {
            background: rgba(30, 41, 59, 0.7);
            border-color: rgba(148, 163, 184, 0.35);
        }

        body.dark .pagination nav a:hover {
            border-color: var(--accent-blue);
            background: rgba(96, 165, 250, 0.18);
        }

        .pagination nav svg {
            width: 14px;
            height: 14px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .navbar-container {
                padding: 0 1.5rem;
            }

            .navbar-menu {
                position: fixed;
                top: 75px;
                left: 0;
                right: 0;
                flex-direction: column;
                padding: 1.5rem;
                gap: 0.5rem;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                border-bottom: 1px solid;
            }

            body:not(.dark) .navbar-menu {
                background: white;
                border-bottom-color: var(--border-color);
                box-shadow: var(--shadow-xl);
            }

            body.dark .navbar-menu {
                background: #1e293b;
                border-bottom-color: rgba(100, 116, 139, 0.3);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
            }

            .navbar-menu.show {
                max-height: 500px;
            }

            .nav-link {
                width: 100%;
                padding: 0.875rem 1rem;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .navbar-actions {
                display: none;
            }

            .navbar-actions.mobile {
                display: flex;
                width: 100%;
                padding-top: 1rem;
                border-top: 1px solid;
                margin-top: 1rem;
            }

            body:not(.dark) .navbar-actions.mobile {
                border-top-color: var(--border-color);
            }

            body.dark .navbar-actions.mobile {
                border-top-color: rgba(100, 116, 139, 0.3);
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                height: 70px;
                padding: 0 1rem;
            }

            .brand-text {
                font-size: 1.2rem;
            }

            .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .footer-content {
                padding: 3rem 1rem 1.5rem;
            }
        }
    </style>

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
                                Masuk
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
                                <a href="{{ url('/') }}">
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
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    Katalog Buku
                                </a>
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
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    Peminjaman Online
                                </a>
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

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.pageYOffset > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>