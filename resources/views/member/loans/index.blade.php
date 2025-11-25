@extends('layouts.app')

@section('title', 'Peminjaman Saya - E-PERPUS')

@push('styles')
<style>
@import url("css/anggota/loan/index.loan.css");
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <i class="bi bi-bookmark-heart"></i> Peminjaman Saya
            </h1>
            <p class="page-header-subtitle">Kelola dan pantau status peminjaman buku Anda</p>
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

    <!-- Table Card -->
    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Kembali</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    @php
                        $status = $loan->status;
                        $label = match($status) {
                            'pending' => 'Menunggu persetujuan',
                            'approved' => 'Sedang dipinjam',
                            'returned' => 'Selesai',
                            'rejected' => 'Ditolak',
                            default => ucfirst($status),
                        };
                        $icon = match($status) {
                            'pending' => 'bi-clock-history',
                            'approved' => 'bi-book',
                            'returned' => 'bi-check-circle',
                            'rejected' => 'bi-x-circle',
                            default => 'bi-circle',
                        };
                    @endphp
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $loan->book->title }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.7; margin-top: 0.25rem;">
                                {{ $loan->book->author }}
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span class="status-badge {{ $status }}">
                                <i class="bi {{ $icon }}"></i>
                                {{ $label }}
                            </span>
                            @if($loan->is_late)
                                <span class="status-badge late">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    Terlambat
                                </span>
                            @endif
                        </td>
                        <td>{{ optional($loan->borrowed_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ optional($loan->due_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ optional($loan->returned_at)->format('d/m/Y') ?? '-' }}</td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                @if($loan->status === 'approved' && ! $loan->returnRequest)
                                    <button 
                                        onclick="confirmReturn({{ $loan->id }}, '{{ $loan->book->title }}', '{{ optional($loan->borrowed_at)->format('d/m/Y') }}', '{{ optional($loan->due_at)->format('d/m/Y') }}', {{ $loan->is_late ? 'true' : 'false' }})" 
                                        class="action-btn return">
                                        <i class="bi bi-arrow-return-left"></i>
                                        Ajukan Pengembalian
                                    </button>
                                @elseif($loan->returnRequest && $loan->returnRequest->status === 'pending')
                                    <span class="action-text pending">
                                        <i class="bi bi-clock-history"></i>
                                        Menunggu persetujuan pengembalian
                                    </span>
                                @elseif($loan->status === 'returned')
                                    <span class="action-text success">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Selesai
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox empty-icon"></i>
                                <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Belum ada peminjaman</p>
                                <p style="font-size: 0.9rem;">Riwayat peminjaman Anda akan muncul di sini</p>
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

<!-- Return Confirmation Modal -->
<div class="modal-overlay" id="returnOverlay" onclick="closeReturnModal()"></div>
<div class="modal" id="returnModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-arrow-return-left" style="color: #3b82f6;"></i>
                Ajukan Pengembalian
            </h3>
            <button class="modal-close" onclick="closeReturnModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p style="margin-bottom: 1.5rem; color: var(--text-muted); font-size: 0.95rem;">
                Pastikan informasi peminjaman berikut sudah benar sebelum mengajukan pengembalian.
            </p>
            
            <div class="modal-info">
                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-book"></i> Judul Buku
                    </span>
                    <span class="info-value" id="returnBookTitle"></span>
                </div>
                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-calendar-check"></i> Tanggal Pinjam
                    </span>
                    <span class="info-value" id="returnBorrowedAt"></span>
                </div>
                <div class="info-item">
                    <span class="info-label">
                        <i class="bi bi-calendar-x"></i> Jatuh Tempo
                    </span>
                    <span class="info-value" id="returnDueAt"></span>
                </div>
                <div class="info-item" id="lateStatusItem" style="display: none;">
                    <span class="info-label" style="color: #ef4444;">
                        <i class="bi bi-exclamation-triangle"></i> Status
                    </span>
                    <span class="info-value" style="color: #ef4444; font-weight: 600;">
                        Terlambat
                    </span>
                </div>
            </div>

            <div class="modal-warning">
                <i class="bi bi-info-circle"></i>
                <p>Setelah Anda mengajukan pengembalian, admin akan memverifikasi dan menyetujui pengembalian buku Anda.</p>
            </div>

            <form id="returnForm" method="POST" action="{{ route('member.loans.return-request', ':id') }}">
                @csrf
                <div class="modal-actions">
                    <button type="button" onclick="closeReturnModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Ajukan Pengembalian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmReturn(loanId, bookTitle, borrowedAt, dueAt, isLate) {
        document.getElementById('returnBookTitle').textContent = bookTitle;
        document.getElementById('returnBorrowedAt').textContent = borrowedAt;
        document.getElementById('returnDueAt').textContent = dueAt;
        
        // Show late status if applicable
        const lateItem = document.getElementById('lateStatusItem');
        if (isLate) {
            lateItem.style.display = 'flex';
        } else {
            lateItem.style.display = 'none';
        }
        
        // Update form action URL
        const form = document.getElementById('returnForm');
        form.action = form.action.replace(':id', loanId);
        
        // Show modal
        document.getElementById('returnOverlay').classList.add('active');
        document.getElementById('returnModal').classList.add('active');
    }

    function closeReturnModal() {
        document.getElementById('returnOverlay').classList.remove('active');
        document.getElementById('returnModal').classList.remove('active');
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeReturnModal();
        }
    });
</script>
@endpush