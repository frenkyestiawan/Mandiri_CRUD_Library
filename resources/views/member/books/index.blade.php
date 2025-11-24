@extends('layouts.app')

@section('title', 'Katalog Buku - E-PERPUS')

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

    /* Filter Section */
    .filter-card {
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid;
        transition: all 0.3s ease;
    }

    body:not(.dark) .filter-card {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    body.dark .filter-card {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .filter-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    body:not(.dark) .filter-label {
        color: #64748b;
    }

    body.dark .filter-label {
        color: #94a3b8;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        padding: 0.65rem 1rem;
        border-radius: 10px;
        border: 2px solid;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    body:not(.dark) .filter-input,
    body:not(.dark) .filter-select {
        background: white;
        border-color: #e2e8f0;
        color: #1e293b;
    }

    body:not(.dark) .filter-input:focus,
    body:not(.dark) .filter-select:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    body.dark .filter-input,
    body.dark .filter-select {
        background: #0f172a;
        border-color: rgba(100, 116, 139, 0.3);
        color: #e2e8f0;
    }

    body.dark .filter-input:focus,
    body.dark .filter-select:focus {
        border-color: #60a5fa;
        outline: none;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
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

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
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
        text-align: center;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        vertical-align: middle;
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
        vertical-align: middle;
        text-align: left;
    }

    /* Kolom kategori & stok dirata-tengah agar tampak lebih rapi */
    .data-table td:nth-child(3),
    .data-table td:nth-child(4) {
        text-align: center;
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
    }

    .status-badge.available {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .status-badge.available {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .status-badge.unavailable {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    body.dark .status-badge.unavailable {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    /* Stock Badge */
    .stock-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .stock-badge.high {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .stock-badge.high {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .stock-badge.medium {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    body.dark .stock-badge.medium {
        background: rgba(251, 191, 36, 0.15);
        color: #fbbf24;
    }

    .stock-badge.low {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    body.dark .stock-badge.low {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
    }

    /* Badge kategori di kolom kategori agar lebih rapi dan konsisten (sama seperti admin) */
    .category-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        background: rgba(59, 130, 246, 0.12);
        color: #3b82f6;
        white-space: nowrap;
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

    .action-btn.borrow {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .action-btn.borrow:hover {
        background: rgba(16, 185, 129, 0.2);
        transform: translateY(-1px);
    }

    body.dark .action-btn.borrow {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
    }

    .action-btn.disabled {
        background: rgba(100, 116, 139, 0.1);
        color: #94a3b8;
        cursor: not-allowed;
    }

    body.dark .action-btn.disabled {
        background: rgba(100, 116, 139, 0.15);
        color: #64748b;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
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
        .filter-grid {
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
                <i class="bi bi-journal-bookmark"></i> Katalog Buku
            </h1>
            <p class="page-header-subtitle">Jelajahi koleksi buku perpustakaan digital</p>
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

    <!-- Filter Card -->
    <div class="filter-card">
        <form method="GET" action="{{ route('member.books.index') }}">
            <div class="filter-grid">
                <div>
                    <label class="filter-label">Kategori</label>
                    <select name="category" class="filter-select">
                        <option value="">Semua Kategori</option>
                        @isset($categories)
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ (isset($category) && $category === $cat) ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                <div>
                    <label class="filter-label">Urutkan</label>
                    <select name="sort" class="filter-select">
                        <option value="">Judul A → Z (default)</option>
                        <option value="az" {{ (isset($sort) && $sort === 'az') ? 'selected' : '' }}>Judul A → Z</option>
                        <option value="za" {{ (isset($sort) && $sort === 'za') ? 'selected' : '' }}>Judul Z → A</option>
                        <option value="popular" {{ (isset($sort) && $sort === 'popular') ? 'selected' : '' }}>Populer</option>
                        <option value="newest" {{ (isset($sort) && $sort === 'newest') ? 'selected' : '' }}>Terbaru</option>
                        <option value="stock" {{ (isset($sort) && $sort === 'stock') ? 'selected' : '' }}>Stok Terbanyak</option>
                    </select>
                </div>

                <div style="grid-column: span 2;">
                    <label class="filter-label">Pencarian</label>
                    <input type="text" name="search" placeholder="Cari judul atau penulis..." value="{{ $search ?? '' }}" class="filter-input">
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>
                <a href="{{ route('member.books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    @php
                        $status = $book->stock > 0 ? 'available' : 'unavailable';
                        $statusText = $book->stock > 0 ? 'Tersedia' : 'Sedang Dipinjam';
                        $stockClass = 'high';
                        if($book->stock < 5 && $book->stock > 0) $stockClass = 'low';
                        elseif($book->stock >= 5 && $book->stock < 10) $stockClass = 'medium';
                    @endphp
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $book->title }}</div>
                            @if($book->isbn)
                                <div style="font-size: 0.8rem; opacity: 0.7;">ISBN: {{ $book->isbn }}</div>
                            @endif
                        </td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <span class="category-badge">
                                {{ $book->category }}
                            </span>
                        </td>
                        <td>
                            @if($book->stock > 0)
                                <span class="stock-badge {{ $stockClass }}">
                                    {{ $book->stock }} unit
                                </span>
                            @else
                                <span class="stock-badge low">0 unit</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <span class="status-badge {{ $status }}">
                                {{ $statusText }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <a href="{{ route('member.books.show', $book) }}" class="action-btn view">
                                    <i class="bi bi-eye"></i>
                                    Detail
                                </a>
                                @if($book->stock > 0)
                                    <button onclick="confirmBorrow({{ $book->id }}, '{{ $book->title }}')" class="action-btn borrow">
                                        <i class="bi bi-bookmark-plus"></i>
                                        Pinjam
                                    </button>
                                @else
                                    <button class="action-btn disabled" disabled>
                                        <i class="bi bi-x-circle"></i>
                                        Tidak Tersedia
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
                                <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Belum ada data buku</p>
                                <p style="font-size: 0.9rem;">Koleksi buku akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($books->hasPages())
            <div style="padding: 1.5rem; text-align: center;">
                <div class="pagination" style="display: inline-flex;">
                    {{ $books->links('pagination.app') }}
                </div>
            </div>
        @endif
    </div>

</div>

<!-- Borrow Confirmation Modal -->
<div class="modal-overlay" id="borrowOverlay" onclick="closeBorrowModal()"></div>
<div class="modal" id="borrowModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-bookmark-plus-fill" style="color: #10b981;"></i>
                Konfirmasi Peminjaman
            </h3>
            <button class="modal-close" onclick="closeBorrowModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Apakah Anda yakin ingin meminjam buku <strong id="borrowBookTitle"></strong>?
                <br><br>
                Permintaan peminjaman akan diajukan dan menunggu persetujuan admin.
            </p>
            <form id="borrowForm" method="POST" action="{{ route('member.loans.store') }}">
                @csrf
                <input type="hidden" id="borrowBookId" name="book_id" value="">
                <div class="modal-actions">
                    <button type="button" onclick="closeBorrowModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Ya, Pinjam Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmBorrow(bookId, bookTitle) {
        document.getElementById('borrowBookTitle').textContent = bookTitle;
        document.getElementById('borrowBookId').value = bookId;
        document.getElementById('borrowOverlay').classList.add('active');
        document.getElementById('borrowModal').classList.add('active');
    }

    function closeBorrowModal() {
        document.getElementById('borrowOverlay').classList.remove('active');
        document.getElementById('borrowModal').classList.remove('active');
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeBorrowModal();
        }
    });
</script>
@endpush