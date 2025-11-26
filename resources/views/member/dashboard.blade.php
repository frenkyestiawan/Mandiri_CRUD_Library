@extends('layouts.app')

@section('title', 'Dashboard Anggota - E-PERPUS')

@push('styles')
<style>
@import url("{{ asset('css/anggota/dashboard.css') }}");
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
    
    <!-- Welcome Hero -->
    <div class="welcome-hero">
        <div class="welcome-content">
            <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="welcome-subtitle">Kelola peminjaman buku dan jelajahi koleksi perpustakaan digital</p>
            
            <div class="welcome-info">
                <div class="info-card">
                    <i class="bi bi-calendar-check info-icon"></i>
                    <div class="info-text">
                        <span class="info-value">{{ now()->translatedFormat('d F Y') }}</span>
                        <span class="info-label">Hari ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Peminjaman Aktif</div>
                    <div class="stat-value">{{ $activeLoansCount }}</div>
                </div>
                <div class="stat-icon blue">
                    <i class="bi bi-bookmark-check"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Pengembalian Terlambat</div>
                    <div class="stat-value">{{ $lateReturnsCount }}</div>
                </div>
                <div class="stat-icon red">
                    <i class="bi bi-clock-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations -->
    <div class="content-card">
        <h3 class="card-title">
            <span class="card-icon">
                <i class="bi bi-star"></i>
            </span>
            Rekomendasi Buku Populer
        </h3>
        <ul class="recommendation-list">
            @forelse($recommendedBooks as $book)
                <li class="recommendation-item" onclick="window.location='{{ route('member.books.show', $book) }}'">
                    <div class="recommendation-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="recommendation-text">
                        <div class="recommendation-title">{{ $book->title }}</div>
                        <div class="recommendation-author">oleh {{ $book->author }}</div>
                    </div>
                    <span class="recommendation-badge">
                        <i class="bi bi-fire"></i> {{ $book->loans_count }}x dipinjam
                    </span>
                </li>
            @empty
                <li class="empty-state">
                    <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem;"></i>
                    Belum ada rekomendasi buku
                </li>
            @endforelse
        </ul>
    </div>

    <!-- Riwayat Peminjaman -->
    <div class="content-card">
        <h3 class="card-title">
            <span class="card-icon">
                <i class="bi bi-clock-history"></i>
            </span>
            Riwayat Peminjaman Saya
        </h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Kembali</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myLoans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td style="text-align: center;">
                            @php
                                $status = $loan->status;
                                $label = match($status) {
                                    'pending' => 'Pending Approval',
                                    'approved' => 'Currently Borrowed',
                                    'returned' => 'Completed',
                                    'rejected' => 'Rejected',
                                    default => ucfirst($status),
                                };
                            @endphp
                            <span class="status-badge {{ $status }}">
                                {{ $label }}
                            </span>
                            @if($loan->is_late)
                                <span class="status-badge late">
                                    <i class="bi bi-clock-fill"></i> Late
                                </span>
                            @endif
                        </td>
                        <td>{{ optional($loan->borrowed_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ optional($loan->due_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ optional($loan->returned_at)->format('d/m/Y') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem;"></i>
                                Belum ada riwayat peminjaman
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Peminjaman Pending/Approved -->
    <div class="content-card">
        <h3 class="card-title">
            <span class="card-icon">
                <i class="bi bi-hourglass-split"></i>
            </span>
            Peminjaman Pending / Sedang Diproses
        </h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Pinjam</th>
                    <th>Jatuh Tempo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingApprovedLoans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td style="text-align: center;">
                            @php
                                $status = $loan->status;
                                $label = match($status) {
                                    'pending' => 'Pending Approval',
                                    'approved' => 'Currently Borrowed',
                                    default => ucfirst($status),
                                };
                            @endphp
                            <span class="status-badge {{ $status }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td>{{ optional($loan->borrowed_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ optional($loan->due_at)->format('d/m/Y') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem;"></i>
                                Tidak ada peminjaman pending atau sedang diproses
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection