@extends('layouts.app')

@section('title', 'Detail Peminjaman - E-PERPUS')

@push('styles')
<style>
    @import url('/css/admin/loan/show_loan.css');
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem; max-width: 1000px;">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <div class="page-header-content">
            <div class="page-header-left">
                <h1><i class="bi bi-info-circle-fill"></i> Detail Peminjaman</h1>
                <div class="breadcrumb">
                    <a href="{{ route('admin.loans.index') }}">
                        <i class="bi bi-arrow-left-right"></i> Peminjaman
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail #{{ $loan->id }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="detail-card">
        <!-- Anggota Section -->
        <div class="info-section">
            <h3 class="section-title">
                <span class="section-icon">
                    <i class="bi bi-person-fill"></i>
                </span>
                Informasi Anggota
            </h3>
            <div class="info-content">
                <div style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">
                    {{ $loan->user->name }}
                </div>
                <div class="info-text">
                    <i class="bi bi-envelope"></i> {{ $loan->user->email }}
                </div>
            </div>
        </div>

        <hr class="divider">

        <!-- Buku Section -->
        <div class="info-section">
            <h3 class="section-title">
                <span class="section-icon">
                    <i class="bi bi-book-fill"></i>
                </span>
                Informasi Buku
            </h3>
            <div class="info-content">
                <div style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">
                    {{ $loan->book->title }}
                </div>
                <div class="info-text">
                    <div style="margin-bottom: 0.25rem;">
                        <i class="bi bi-person"></i> Penulis: <strong>{{ $loan->book->author }}</strong>
                    </div>
                    @if($loan->book->publisher)
                        <div>
                            <i class="bi bi-building"></i> Penerbit: {{ $loan->book->publisher }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <hr class="divider">

        <!-- Status & Tanggal Section -->
        <div class="info-section">
            <h3 class="section-title">
                <span class="section-icon">
                    <i class="bi bi-calendar-check"></i>
                </span>
                Status & Tanggal
            </h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Status Peminjaman</div>
                    <div style="margin-top: 0.5rem;">
                        <span class="status-badge {{ $loan->status }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-calendar-plus"></i> Tanggal Pinjam
                    </div>
                    <div class="info-text" style="margin-top: 0.5rem; font-weight: 600;">
                        {{ optional($loan->borrowed_at)->format('d/m/Y') ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-calendar-event"></i> Jatuh Tempo
                    </div>
                    <div class="info-text" style="margin-top: 0.5rem; font-weight: 600;">
                        {{ optional($loan->due_at)->format('d/m/Y') ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-calendar-check"></i> Tanggal Kembali
                    </div>
                    <div class="info-text" style="margin-top: 0.5rem; font-weight: 600;">
                        {{ optional($loan->returned_at)->format('d/m/Y') ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        <hr class="divider">

        <!-- Keterlambatan Section -->
        <div class="info-section">
            <h3 class="section-title">
                <span class="section-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </span>
                Status Keterlambatan
            </h3>
            
            @if($loan->is_late)
                <div class="late-badge">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        <div style="font-weight: 700;">Terlambat!</div>
                        @if($loan->penalty_note)
                            <div style="font-size: 0.9rem; margin-top: 0.25rem;">
                                {{ $loan->penalty_note }}
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="no-late-badge">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Tidak ada keterlambatan</span>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
            @if($loan->status === 'pending')
                <button onclick="confirmApprove()" class="btn btn-success">
                    <i class="bi bi-check-circle"></i>
                    Approve
                </button>
                <button onclick="confirmReject()" class="btn btn-danger">
                    <i class="bi bi-x-circle"></i>
                    Reject
                </button>
            @endif
        </div>
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
                Apakah Anda yakin ingin meng-approve peminjaman buku <strong>{{ $loan->book->title }}</strong> untuk <strong>{{ $loan->user->name }}</strong>?
            </p>
            <form action="{{ route('admin.loans.approve', $loan) }}" method="POST">
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
                Apakah Anda yakin ingin me-reject peminjaman buku <strong>{{ $loan->book->title }}</strong> untuk <strong>{{ $loan->user->name }}</strong>?
            </p>
            <form action="{{ route('admin.loans.reject', $loan) }}" method="POST">
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
    function confirmApprove() {
        document.getElementById('approveOverlay').classList.add('active');
        document.getElementById('approveModal').classList.add('active');
    }

    function closeApproveModal() {
        document.getElementById('approveOverlay').classList.remove('active');
        document.getElementById('approveModal').classList.remove('active');
    }

    function confirmReject() {
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