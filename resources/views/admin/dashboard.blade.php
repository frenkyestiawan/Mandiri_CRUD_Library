@extends('layouts.app')

@section('title', 'Dashboard Admin - E-PERPUS')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" />
@endpush

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem">
        <!-- Welcome Hero -->
        <div class="welcome-hero">
            <div class="welcome-content">
                <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="welcome-subtitle">
                    Semoga harimu menyenangkan. Berikut adalah ringkasan sistem hari ini.
                </p>

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
                            <span class="info-label">
                                {{ now()->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <svg class="moon-illustration" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="80" fill="currentColor" opacity="0.8" />
                <circle cx="130" cy="70" r="15" fill="currentColor" opacity="0.5" />
                <circle cx="90" cy="120" r="20" fill="currentColor" opacity="0.4" />
                <circle cx="120" cy="130" r="12" fill="currentColor" opacity="0.5" />
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
                        @foreach ($statuses as $status)
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
                        @forelse ($topBooks as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td class="font-bold">{{ $book->loans_count }}x</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="empty-state">
                                    <i class="bi bi-inbox"
                                        style="
                                            font-size: 2rem;
                                            opacity: 0.3;
                                            display: block;
                                            margin-bottom: 0.5rem;
                                        "></i>
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
                    @foreach ($monthlyLoans as $month => $total)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                            </td>
                            <td class="font-bold">{{ $total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endpush
