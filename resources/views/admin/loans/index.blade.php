@extends('layouts.app')

@section('title', 'Peminjaman Buku - E-PERPUS')

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

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-mini-card {
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid;
        transition: all 0.3s ease;
    }

    body:not(.dark) .stat-mini-card {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    body.dark .stat-mini-card {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .stat-mini-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);
    }

    .stat-mini-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-mini-icon.pending {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    body.dark .stat-mini-icon.pending {
        background: rgba(251, 191, 36, 0.15);
        color: #fbbf24;
    }

    .stat-mini-icon.approved {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    body.dark .stat-mini-icon.approved {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .stat-mini-icon.late {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    body.dark .stat-mini-icon.late {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    .stat-mini-icon.returned {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .stat-mini-icon.returned {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .stat-mini-text {
        flex: 1;
    }

    .stat-mini-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    body:not(.dark) .stat-mini-label {
        color: #64748b;
    }

    body.dark .stat-mini-label {
        color: #94a3b8;
    }

    .stat-mini-value {
        font-size: 1.5rem;
        font-weight: 800;
    }

    body:not(.dark) .stat-mini-value {
        color: #1e293b;
    }

    body.dark .stat-mini-value {
        color: #f1f5f9;
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
        background: #eff6ff; /* Blue 50 */
        border-color: #e2e8f0;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.10);
    }

    body.dark .table-card {
        background: rgba(30, 58, 138, 0.6);
        border-color: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.20);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        border-bottom: 1px solid;
    }

    /* Header tabel - light mode: sedikit lebih gelap supaya tidak terlalu terang */
    body:not(.dark) .data-table thead {
        background: #d4e3ff;
        border-bottom-color: #c4d4ff;
    }

    /* Header tabel - dark mode: navy yang soft */
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
        color: #475569;   /* Slate 600 */
    }

    body.dark .data-table th {
        color: #cbd5e1;   /* Slate 300 */
    }

    .data-table tbody tr {
        border-bottom: 1px solid;
        transition: all 0.2s ease;
    }

    body:not(.dark) .data-table tbody tr {
        border-bottom-color: #e2e8f0;
    }

    body.dark .data-table tbody tr {
        border-bottom-color: rgba(148, 163, 184, 0.28);
    }

    .data-table tbody tr:hover {
        background: rgba(16, 185, 129, 0.05);
    }

    body.dark .data-table tbody tr:hover {
        background: rgba(52, 211, 153, 0.08);
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
        display: inline-block;
        text-transform: capitalize;
    }

    .status-badge.pending {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    body.dark .status-badge.pending {
        background: rgba(251, 191, 36, 0.15);
        color: #fbbf24;
    }

    .status-badge.approved {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    body.dark .status-badge.approved {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .status-badge.rejected {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    body.dark .status-badge.rejected {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    .status-badge.returned {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .status-badge.returned {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .status-badge.late {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        margin-left: 0.5rem;
    }

    body.dark .status-badge.late {
        background: rgba(248, 113, 113, 0.2);
        color: #fca5a5;
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

    .action-btn.view {
        background: rgba(59, 130, 246, 0.1);
        color: #2563eb;
    }

    .action-btn.view:hover {
        background: rgba(59, 130, 246, 0.2);
        transform: translateY(-1px);
    }

    body.dark .action-btn.view {
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
    }

    .action-btn.approve {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .action-btn.approve:hover {
        background: rgba(16, 185, 129, 0.2);
        transform: translateY(-1px);
    }

    body.dark .action-btn.approve {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .action-btn.reject {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .action-btn.reject:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-1px);
    }

    body.dark .action-btn.reject {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
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
        max-height: 90vh;
        overflow-y: auto;
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

    .modal-text {
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    body:not(.dark) .modal-text {
        color: #475569;
    }

    body.dark .modal-text {
        color: #cbd5e1;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
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
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .table-card {
            overflow-x: auto;
        }

        .data-table {
            min-width: 900px;
        }

        .page-header-title {
            font-size: 1.5rem;
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
        <div class="stat-mini-card">
            <div class="stat-mini-icon pending">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Pending</div>
                <div class="stat-mini-value">{{ $loans->where('status', 'pending')->count() }}</div>
            </div>
        </div>

        <div class="stat-mini-card">
            <div class="stat-mini-icon approved">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Approved</div>
                <div class="stat-mini-value">{{ $loans->where('status', 'approved')->count() }}</div>
            </div>
        </div>

        <div class="stat-mini-card">
            <div class="stat-mini-icon late">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Terlambat</div>
                <div class="stat-mini-value">{{ $loans->where('is_late', true)->count() }}</div>
            </div>
        </div>

        <div class="stat-mini-card">
            <div class="stat-mini-icon returned">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <div class="stat-mini-text">
                <div class="stat-mini-label">Returned</div>
                <div class="stat-mini-value">{{ $loans->where('status', 'returned')->count() }}</div>
            </div>
        </div>
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
                        <td>
                            <span class="status-badge {{ $loan->status }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                            @if($loan->is_late)
                                <span class="status-badge late">
                                    <i class="bi bi-clock-fill"></i> Terlambat
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
                        <td>
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
                Konfirmasi Approve
            </h3>
            <button class="modal-close" onclick="closeApproveModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Approve peminjaman buku <strong id="approveBookTitle"></strong> untuk anggota <strong id="approveMemberName"></strong>?
            </p>
            <form id="approveForm" method="POST">
                @csrf
                <div class="modal-actions">
                    <button type="button" onclick="closeApproveModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Ya, Approve
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
                Konfirmasi Reject
            </h3>
            <button class="modal-close" onclick="closeRejectModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Tolak peminjaman buku <strong id="rejectBookTitle"></strong> untuk anggota <strong id="rejectMemberName"></strong>?
            </p>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-actions">
                    <button type="button" onclick="closeRejectModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i>
                        Ya, Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmApprove(loanId, memberName, bookTitle) {
        document.getElementById('approveMemberName').textContent = memberName;
        document.getElementById('approveBookTitle').textContent = bookTitle;
        document.getElementById('approveForm').action = `/admin/loans/${loanId}/approve`;
        document.getElementById('approveOverlay').classList.add('active');
        document.getElementById('approveModal').classList.add('active');
    }

    function closeApproveModal() {
        document.getElementById('approveOverlay').classList.remove('active');
        document.getElementById('approveModal').classList.remove('active');
    }

    function confirmReject(loanId, memberName, bookTitle) {
        document.getElementById('rejectMemberName').textContent = memberName;
        document.getElementById('rejectBookTitle').textContent = bookTitle;
        document.getElementById('rejectForm').action = `/admin/loans/${loanId}/reject`;
        document.getElementById('rejectOverlay').classList.add('active');
        document.getElementById('rejectModal').classList.add('active');
    }

    function closeRejectModal() {
        document.getElementById('rejectOverlay').classList.remove('active');
        document.getElementById('rejectModal').classList.remove('active');
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeApproveModal();
            closeRejectModal();
        }
    });
</script>
@endpush