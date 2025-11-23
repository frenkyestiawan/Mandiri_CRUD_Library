@extends('layouts.app')

@section('title', 'Dashboard Admin - E-PERPUS')

@push('styles')
<style>
    /* Hero Welcome Section */
    .welcome-hero {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 50%, #7e22ce 100%);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(37, 99, 235, 0.3);
        margin-bottom: 2rem;
    }

    body.dark .welcome-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #6b21a8 100%);
        box-shadow: 0 20px 50px rgba(30, 58, 138, 0.5);
    }

    .welcome-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        filter: blur(60px);
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .welcome-subtitle {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
    }

    .welcome-info {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        color: white;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .info-icon {
        font-size: 1.75rem;
    }

    .info-text {
        display: flex;
        flex-direction: column;
    }

    .info-value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .info-label {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .moon-illustration {
        position: absolute;
        right: 3rem;
        top: 50%;
        transform: translateY(-50%);
        width: 180px;
        height: 180px;
        opacity: 0.3;
    }

    /* Stat Cards */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        border-radius: 20px;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid;
    }

    body:not(.dark) .stat-card {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    body.dark .stat-card {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(37, 99, 235, 0.15);
    }

    body.dark .stat-card:hover {
        box-shadow: 0 12px 30px rgba(96, 165, 250, 0.2);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .stat-icon.blue {
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
    }

    body.dark .stat-icon.blue {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .stat-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .stat-icon.green {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .stat-icon.amber {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    body.dark .stat-icon.amber {
        background: rgba(251, 191, 36, 0.15);
        color: #fbbf24;
    }

    .stat-icon.red {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    body.dark .stat-icon.red {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    .stat-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    body:not(.dark) .stat-label {
        color: #64748b;
    }

    body.dark .stat-label {
        color: #94a3b8;
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1;
    }

    body:not(.dark) .stat-value {
        color: #1e293b;
    }

    body.dark .stat-value {
        color: #f1f5f9;
    }

    .stat-subtitle {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    body:not(.dark) .stat-subtitle {
        color: #64748b;
    }

    body.dark .stat-subtitle {
        color: #94a3b8;
    }

    /* Content Cards */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .content-card {
        border-radius: 20px;
        padding: 1.75rem;
        transition: all 0.3s ease;
        border: 1px solid;
    }

    body:not(.dark) .content-card {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    body.dark .content-card {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .content-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
    }

    body.dark .content-card:hover {
        box-shadow: 0 10px 25px rgba(96, 165, 250, 0.15);
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    body:not(.dark) .card-title {
        color: #1e293b;
    }

    body.dark .card-title {
        color: #f1f5f9;
    }

    .card-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
    }

    .card-icon.blue {
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
    }

    body.dark .card-icon.blue {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .card-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .card-icon.green {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .card-icon.sky {
        background: rgba(14, 165, 233, 0.1);
        color: #0ea5e9;
    }

    body.dark .card-icon.sky {
        background: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
    }

    /* Table Styles */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table thead tr {
        border-bottom: 1px solid;
    }

    body:not(.dark) .data-table thead tr {
        border-bottom-color: #e2e8f0;
    }

    body.dark .data-table thead tr {
        border-bottom-color: rgba(100, 116, 139, 0.3);
    }

    .data-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    body:not(.dark) .data-table th {
        color: #64748b;
    }

    body.dark .data-table th {
        color: #94a3b8;
    }

    .data-table tbody tr {
        border-bottom: 1px solid;
        transition: all 0.2s ease;
    }

    body:not(.dark) .data-table tbody tr {
        border-bottom-color: #f1f5f9;
    }

    body.dark .data-table tbody tr {
        border-bottom-color: rgba(100, 116, 139, 0.2);
    }

    .data-table tbody tr:hover {
        background: rgba(37, 99, 235, 0.05);
    }

    body.dark .data-table tbody tr:hover {
        background: rgba(96, 165, 250, 0.08);
    }

    .data-table td {
        padding: 1rem;
        font-size: 0.9rem;
    }

    body:not(.dark) .data-table td {
        color: #334155;
    }

    body.dark .data-table td {
        color: #cbd5e1;
    }

    .data-table td.font-bold {
        font-weight: 700;
    }

    body:not(.dark) .data-table td.font-bold {
        color: #1e293b;
    }

    body.dark .data-table td.font-bold {
        color: #f1f5f9;
    }

    .empty-state {
        padding: 2rem;
        text-align: center;
    }

    body:not(.dark) .empty-state {
        color: #64748b;
    }

    body.dark .empty-state {
        color: #94a3b8;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome-hero {
            padding: 2rem 1.5rem;
        }

        .welcome-title {
            font-size: 1.5rem;
        }

        .welcome-info {
            gap: 1rem;
        }

        .info-card {
            flex: 1 1 100%;
        }

        .moon-illustration {
            display: none;
        }

        .stat-grid,
        .content-grid {
            grid-template-columns: 1fr;
        }

        .content-card {
            min-width: unset;
        }
    }
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
    
    <!-- Welcome Hero -->
    <div class="welcome-hero">
        <div class="welcome-content">
            <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="welcome-subtitle">Semoga harimu menyenangkan. Berikut adalah ringkasan sistem hari ini.</p>
            
            <div class="welcome-info">
                <div class="info-card">
                    <i class="bi bi-cloud-sun info-icon"></i>
                    <div class="info-text">
                        <span class="info-value">23°C</span>
                        <span class="info-label">Awan tersebar di Pekanbaru</span>
                    </div>
                </div>
                
                <div class="info-card">
                    <i class="bi bi-clock info-icon"></i>
                    <div class="info-text">
                        <span class="info-value" id="live-time">--:--:--</span>
                        <span class="info-label">{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <svg class="moon-illustration" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" fill="currentColor" opacity="0.8"/>
            <circle cx="130" cy="70" r="15" fill="currentColor" opacity="0.5"/>
            <circle cx="90" cy="120" r="20" fill="currentColor" opacity="0.4"/>
            <circle cx="120" cy="130" r="12" fill="currentColor" opacity="0.5"/>
        </svg>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Buku</div>
                    <div class="stat-value">{{ $totalBooks }}</div>
                    <div class="stat-subtitle">Item dalam inventori</div>
                </div>
                <div class="stat-icon blue">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Peminjaman Bulan Ini</div>
                    <div class="stat-value">{{ $totalLoansThisMonth }}</div>
                    <div class="stat-subtitle">Transaksi peminjaman</div>
                </div>
                <div class="stat-icon green">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Peminjaman Pending</div>
                    <div class="stat-value">{{ $totalPendingLoans }}</div>
                    <div class="stat-subtitle">Menunggu approval</div>
                </div>
                <div class="stat-icon amber">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Pengembalian Terlambat</div>
                    <div class="stat-value">{{ $totalLateReturns }}</div>
                    <div class="stat-subtitle">Perlu tindakan</div>
                </div>
                <div class="stat-icon red">
                    <i class="bi bi-exclamation-octagon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Tables -->
    <div class="content-grid">
        <div class="content-card">
            <h3 class="card-title">
                <span class="card-icon blue">
                    <i class="bi bi-bar-chart"></i>
                </span>
                Ringkasan Status Peminjaman
            </h3>
            @php
                $statuses = ['pending', 'approved', 'rejected', 'returned'];
            @endphp
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statuses as $status)
                        <tr>
                            <td>{{ ucfirst($status) }}</td>
                            <td class="font-bold">{{ $loanStatusCounts[$status] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="content-card">
            <h3 class="card-title">
                <span class="card-icon green">
                    <i class="bi bi-book-half"></i>
                </span>
                Buku Paling Sering Dipinjam
            </h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Dipinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topBooks as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td class="font-bold">{{ $book->loans_count }}x</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="empty-state">
                                <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem;"></i>
                                Belum ada data peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monthly Loans -->
    <div class="content-card">
        <h3 class="card-title">
            <span class="card-icon sky">
                <i class="bi bi-calendar3"></i>
            </span>
            Peminjaman per Bulan ({{ now()->year }})
        </h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Jumlah Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyLoans as $month => $total)
                    <tr>
                        <td>{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</td>
                        <td class="font-bold">{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Live Clock
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('live-time').textContent = `${hours}:${minutes}:${seconds}`;
    }
    
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endpush