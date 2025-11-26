@extends('layouts.app')

@section('title', 'Peminjaman Buku - E-PERPUS')

@push('styles')
<style>
@import url("{{ asset('css/admin/loan/index_loan.css') }}");
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <i class="bi bi-arrow-left-right"></i> Peminjaman Buku
            </h1>
            <p class="page-header-subtitle">Kelola dan pantau status peminjaman buku perpustakaan</p>
        </div>
    </div>

    <!-- Success/Error Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill" style="font-size: 1.25rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle-fill" style="font-size: 1.25rem;"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Stats Mini Cards -->
    <div class="stats-grid">
        <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" class="stat-mini-card" style="text-decoration: none;">
            <div class="stat-mini-icon pending">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Pending</div>
                <div class="stat-mini-value">{{ $stats['pending'] ?? 0 }}</div>
            </div>
        </a>

        <a href="{{ route('admin.loans.index', ['status' => 'approved']) }}" class="stat-mini-card" style="text-decoration: none;">
            <div class="stat-mini-icon approved">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Approved</div>
                <div class="stat-mini-value">{{ $stats['approved'] ?? 0 }}</div>
            </div>
        </a>

        <a href="{{ route('admin.loans.index', ['late' => 1]) }}" class="stat-mini-card" style="text-decoration: none;">
            <div class="stat-mini-icon late">
                <i class="bi bi-clock-fill"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Late</div>
                <div class="stat-mini-value">{{ $stats['late'] ?? 0 }}</div>
            </div>
        </a>

        <a href="{{ route('admin.loans.index', ['status' => 'returned']) }}" class="stat-mini-card" style="text-decoration: none;">
            <div class="stat-mini-icon returned">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Returned</div>
                <div class="stat-mini-value">{{ $stats['returned'] ?? 0 }}</div>
            </div>
        </a>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $loan->user->name }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.7;">{{ $loan->user->email }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $loan->book->title }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.7;">{{ $loan->book->author }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.7;">Penerbit: {{ $loan->book->publisher ?? '-' }}</div>
                        </td>
                        <td style="text-align: center;">
                            <span class="status-badge {{ $loan->status }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                            @if($loan->is_late)
                                <span class="status-badge late">
                                    <i class="bi bi-clock-fill"></i> Late
                                </span>
                            @endif
                        </td>
                        <td>{{ optional($loan->borrowed_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>
                            @if($loan->due_at)
                                <div>{{ $loan->due_at->format('d/m/Y') }}</div>
                                @if($loan->status === 'approved' && !$loan->is_late)
                                    <div style="font-size: 0.75rem; opacity: 0.7;">
                                        {{ $loan->due_at->diffForHumans() }}
                                    </div>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <a href="{{ route('admin.loans.show', $loan) }}" class="action-btn view">
                                    <i class="bi bi-eye"></i>
                                    Detail
                                </a>
                                @if($loan->status === 'pending')
                                    <button onclick="confirmApprove({{ $loan->id }}, '{{ $loan->user->name }}', '{{ $loan->book->title }}')" class="action-btn approve">
                                        <i class="bi bi-check-circle"></i>
                                        Approve
                                    </button>
                                    <button onclick="confirmReject({{ $loan->id }}, '{{ $loan->user->name }}', '{{ $loan->book->title }}')" class="action-btn reject">
                                        <i class="bi bi-x-circle"></i>
                                        Reject
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox empty-icon"></i>
                                <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Belum ada data peminjaman</p>
                                <p style="font-size: 0.9rem;">Data peminjaman buku akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($loans->hasPages())
            <div style="padding: 1.5rem; text-align: center;">
                <div class="pagination" style="display: inline-flex;">
                    {{ $loans->links('pagination.app') }}
                </div>
            </div>
        @endif
    </div>

</div>

<!-- Approve Confirmation Modal -->
<div class="modal-overlay" id="approveOverlay" onclick="closeApproveModal()"></div>
<div class="modal" id="approveModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-check-circle-fill" style="color: #10b981;"></i>
                Approve Confirmation
            </h3>
            <button class="modal-close" onclick="closeApproveModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Approve the loan of book <strong id="approveBookTitle"></strong> for member <strong id="approveMemberName"></strong>?
            </p>
            <form id="approveForm" method="POST">
                @csrf
                <div class="modal-actions">
                    <button type="button" onclick="closeApproveModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Yes, Approve
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Confirmation Modal -->
<div class="modal-overlay" id="rejectOverlay" onclick="closeRejectModal()"></div>
<div class="modal" id="rejectModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-x-circle-fill" style="color: #ef4444;"></i>
                Reject Confirmation
            </h3>
            <button class="modal-close" onclick="closeRejectModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Reject the loan of book <strong id="rejectBookTitle"></strong> for member <strong id="rejectMemberName"></strong>?
            </p>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-actions">
                    <button type="button" onclick="closeRejectModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i>
                        Yes, Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/admin/loans/index_loan.js') }}"></script>
@endpush