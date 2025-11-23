@extends('layouts.app')

@section('title', 'Peminjaman Saya - E-PERPUS')

@push('styles')
<style>
    /* Page Header */
    .page-header-section {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
        position: relative;
        overflow: hidden;
    }

    body.dark .page-header-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }

    .page-header-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        filter: blur(60px);
    }

    .page-header-content {
        position: relative;
        z-index: 1;
        color: #ffffff;
    }

    .page-header-title {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .page-header-subtitle {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Alert */
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideInDown 0.3s ease;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #059669;
    }

    body.dark .alert-success {
        background: rgba(52, 211, 153, 0.15);
        border-color: rgba(52, 211, 153, 0.3);
        color: #34d399;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #dc2626;
    }

    body.dark .alert-error {
        background: rgba(248, 113, 113, 0.15);
        border-color: rgba(248, 113, 113, 0.3);
        color: #f87171;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Table Card */
    .table-card {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid;
    }

    body:not(.dark) .table-card {
        background: #ffffff;
        border-color: #e2e8f0;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.08);
    }

    body.dark .table-card {
        background: rgba(30, 64, 175, 0.85);
        border-color: rgba(255, 255, 255, 0.06);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        border-bottom: 1px solid;
    }

    body:not(.dark) .data-table thead {
        background: #d4e3ff;
        border-bottom-color: #c4d4ff;
    }

    body.dark .data-table thead {
        background: rgba(15, 23, 42, 0.95);
        border-bottom-color: rgba(148, 163, 184, 0.30);
    }

    .data-table th {
        padding: 1rem;
        text-align: left;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    body:not(.dark) .data-table th {
        color: #475569;
    }

    body.dark .data-table th {
        color: #cbd5e1;
    }

    .data-table tbody tr {
        border-bottom: 1px solid;
        transition: all 0.2s ease;
    }

    body:not(.dark) .data-table tbody tr {
        border-bottom-color: #e2e8f0;
    }

    body.dark .data-table tbody tr {
        border-bottom-color: rgba(148, 163, 184, 0.35);
    }

    .data-table tbody tr:hover {
        background: rgba(59, 130, 246, 0.05);
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

    /* Status Badge */
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .status-badge.pending {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    body.dark .status-badge.pending {
        background: rgba(251, 191, 36, 0.15);
        color: #fbbf24;
    }

    .status-badge.approved {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    body.dark .status-badge.approved {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .status-badge.returned {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    body.dark .status-badge.returned {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .status-badge.rejected {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    body.dark .status-badge.rejected {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    .status-badge.late {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
        margin-left: 0.5rem;
    }

    body.dark .status-badge.late {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    /* Action Buttons */
    .action-btn {
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        border: none;
        cursor: pointer;
    }

    .action-btn.return {
        background: rgba(59, 130, 246, 0.1);
        color: #2563eb;
    }

    .action-btn.return:hover {
        background: rgba(59, 130, 246, 0.2);
        transform: translateY(-1px);
    }

    body.dark .action-btn.return {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .action-text {
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    body:not(.dark) .action-text.pending {
        color: #64748b;
    }

    body.dark .action-text.pending {
        color: #94a3b8;
    }

    body:not(.dark) .action-text.success {
        color: #10b981;
    }

    body.dark .action-text.success {
        color: #34d399;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9998;
        animation: fadeIn 0.2s ease;
    }

    .modal-overlay.active {
        display: block;
    }

    .modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        max-width: 500px;
        width: 90%;
        animation: slideUp 0.3s ease;
    }

    .modal.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    .modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid;
    }

    body:not(.dark) .modal-content {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    body.dark .modal-content {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .modal-header {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid;
    }

    body:not(.dark) .modal-header {
        background: #f8fafc;
        border-bottom-color: #e2e8f0;
    }

    body.dark .modal-header {
        background: #0f172a;
        border-bottom-color: rgba(100, 116, 139, 0.3);
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    body:not(.dark) .modal-title {
        color: #1e293b;
    }

    body.dark .modal-title {
        color: #f1f5f9;
    }

    .modal-close {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        font-size: 1.25rem;
    }

    body:not(.dark) .modal-close {
        background: #f1f5f9;
        color: #64748b;
    }

    body:not(.dark) .modal-close:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    body.dark .modal-close {
        background: rgba(100, 116, 139, 0.2);
        color: #94a3b8;
    }

    body.dark .modal-close:hover {
        background: rgba(100, 116, 139, 0.4);
        color: #e2e8f0;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid;
    }

    body:not(.dark) .info-item {
        background: rgba(59, 130, 246, 0.05);
        border-color: rgba(59, 130, 246, 0.1);
    }

    body.dark .info-item {
        background: rgba(96, 165, 250, 0.1);
        border-color: rgba(96, 165, 250, 0.2);
    }

    .info-label {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    body:not(.dark) .info-label {
        color: #1e293b;
    }

    body.dark .info-label {
        color: #e2e8f0;
    }

    .info-value {
        text-align: right;
    }

    body:not(.dark) .info-value {
        color: #475569;
    }

    body.dark .info-value {
        color: #94a3b8;
    }

    .modal-warning {
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    body:not(.dark) .modal-warning {
        background: rgba(245, 158, 11, 0.1);
        border-color: rgba(245, 158, 11, 0.2);
    }

    body.dark .modal-warning {
        background: rgba(251, 191, 36, 0.15);
        border-color: rgba(251, 191, 36, 0.3);
    }

    .modal-warning i {
        font-size: 1.25rem;
        margin-top: 0.125rem;
    }

    body:not(.dark) .modal-warning i {
        color: #f59e0b;
    }

    body.dark .modal-warning i {
        color: #fbbf24;
    }

    .modal-warning p {
        font-size: 0.875rem;
        margin: 0;
    }

    body:not(.dark) .modal-warning p {
        color: #92400e;
    }

    body.dark .modal-warning p {
        color: #fef3c7;
    }

    .modal-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .btn {
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-secondary {
        border: 2px solid;
    }

    body:not(.dark) .btn-secondary {
        background: white;
        border-color: #e2e8f0;
        color: #64748b;
    }

    body:not(.dark) .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    body.dark .btn-secondary {
        background: transparent;
        border-color: rgba(100, 116, 139, 0.5);
        color: #94a3b8;
    }

    body.dark .btn-secondary:hover {
        background: rgba(100, 116, 139, 0.2);
        border-color: #60a5fa;
        color: #60a5fa;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    /* Empty State */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        font-size: 4rem;
        opacity: 0.2;
        margin-bottom: 1rem;
    }

    body:not(.dark) .empty-state {
        color: #64748b;
    }

    body.dark .empty-state {
        color: #94a3b8;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-card {
            overflow-x: auto;
        }

        .data-table {
            min-width: 900px;
        }

        .page-header-title {
            font-size: 1.5rem;
        }

        .modal {
            width: 95%;
        }
    }
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
                        <td>
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
                        <td>
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
            <div class="pagination" style="padding: 1.5rem;">
                {{ $loans->links('pagination.app') }}
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