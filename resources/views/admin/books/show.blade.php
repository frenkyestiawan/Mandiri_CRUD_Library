@extends('layouts.app')

@section('title', 'Detail Buku - E-PERPUS')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .page-header-left h1 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .page-header-left p {
        font-size: 1rem;
        opacity: 0.9;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        opacity: 0.9;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .breadcrumb a:hover {
        opacity: 0.7;
    }

    /* Detail Card */
    .detail-card {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    body:not(.dark) .detail-card {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    body.dark .detail-card {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .detail-content {
        padding: 2rem;
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    /* Book Cover */
    .book-cover-wrapper {
        flex-shrink: 0;
    }

    .book-cover {
        width: 280px;
        height: 400px;
        border-radius: 16px;
        object-fit: cover;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .book-cover:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }

    .book-cover-placeholder {
        width: 280px;
        height: 400px;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        border: 2px dashed;
    }

    body:not(.dark) .book-cover-placeholder {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #94a3b8;
    }

    body.dark .book-cover-placeholder {
        background: #0f172a;
        border-color: rgba(100, 116, 139, 0.5);
        color: #64748b;
    }

    .book-cover-placeholder i {
        font-size: 3rem;
        opacity: 0.5;
    }

    /* Book Info */
    .book-info {
        flex: 1;
        min-width: 300px;
    }

    .book-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        line-height: 1.2;
    }

    body:not(.dark) .book-title {
        color: #1e293b;
    }

    body.dark .book-title {
        color: #f1f5f9;
    }

    .book-author {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    body:not(.dark) .book-author {
        color: #64748b;
    }

    body.dark .book-author {
        color: #94a3b8;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .info-item {
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid;
        transition: all 0.3s ease;
    }

    body:not(.dark) .info-item {
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    body.dark .info-item {
        background: #0f172a;
        border-color: rgba(100, 116, 139, 0.3);
    }

    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
    }

    body.dark .info-item:hover {
        box-shadow: 0 4px 12px rgba(96, 165, 250, 0.15);
    }

    .info-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    body:not(.dark) .info-label {
        color: #64748b;
    }

    body.dark .info-label {
        color: #94a3b8;
    }

    .info-value {
        font-size: 1.125rem;
        font-weight: 700;
    }

    body:not(.dark) .info-value {
        color: #1e293b;
    }

    body.dark .info-value {
        color: #f1f5f9;
    }

    .stock-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 1rem;
        font-weight: 700;
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

    /* Description Section */
    .description-section {
        padding: 0 2rem 2rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    body:not(.dark) .section-title {
        color: #1e293b;
    }

    body.dark .section-title {
        color: #f1f5f9;
    }

    .description-text {
        font-size: 1rem;
        line-height: 1.8;
        white-space: pre-line;
    }

    body:not(.dark) .description-text {
        color: #475569;
    }

    body.dark .description-text {
        color: #cbd5e1;
    }

    /* Action Buttons */
    .action-buttons {
        padding: 0 2rem 2rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.75rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
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

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(4px);
        z-index: 9998;
        animation: fadeIn 0.2s ease;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
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

    .modal-image {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        max-width: 90%;
        max-height: 90vh;
        animation: zoomIn 0.3s ease;
    }

    .modal-image.active {
        display: block;
    }

    .modal-image img {
        width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
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

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
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

    /* Responsive */
    @media (max-width: 768px) {
        .detail-content {
            flex-direction: column;
            padding: 1.5rem;
        }

        .book-cover,
        .book-cover-placeholder {
            width: 100%;
            max-width: 280px;
            margin: 0 auto;
        }

        .book-info {
            min-width: unset;
        }

        .book-title {
            font-size: 1.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem; max-width: 1200px;">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <div class="page-header-content">
            <div class="page-header-left">
                <h1><i class="bi bi-book-fill"></i> Detail Buku</h1>
                <div class="breadcrumb">
                    <a href="{{ route('admin.books.index') }}">
                        <i class="bi bi-house-door"></i> Daftar Buku
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="detail-card">
        <!-- Content -->
        <div class="detail-content">
            <!-- Book Cover -->
            <div class="book-cover-wrapper">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" 
                         class="book-cover" 
                         alt="Cover {{ $book->title }}"
                         onclick="showCoverModal()">
                @else
                    <div class="book-cover-placeholder">
                        <i class="bi bi-image"></i>
                        <span>Tidak ada cover</span>
                    </div>
                @endif
            </div>

            <!-- Book Info -->
            <div class="book-info">
                <h1 class="book-title">{{ $book->title }}</h1>
                <div class="book-author">
                    <i class="bi bi-person-fill"></i> Oleh {{ $book->author }}
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-tag"></i>
                            Kategori
                        </div>
                        <div class="info-value">{{ $book->category ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-building"></i>
                            Penerbit
                        </div>
                        <div class="info-value">{{ $book->publisher ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-calendar3"></i>
                            Tahun Terbit
                        </div>
                        <div class="info-value">{{ $book->published_year ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-upc-scan"></i>
                            ISBN
                        </div>
                        <div class="info-value">{{ $book->isbn ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-box-seam"></i>
                            Stok Tersedia
                        </div>
                        <div class="info-value">
                            @php
                                $stockClass = 'high';
                                if($book->stock < 5) $stockClass = 'low';
                                elseif($book->stock < 10) $stockClass = 'medium';
                            @endphp
                            <span class="stock-badge {{ $stockClass }}">
                                {{ $book->stock }} unit
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="description-section">
            <h3 class="section-title">
                <i class="bi bi-journal-text"></i>
                Sinopsis
            </h3>
            <p class="description-text">{{ $book->description ?? 'Belum ada sinopsis untuk buku ini.' }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i>
                Edit Buku
            </a>
            <button onclick="confirmDelete()" class="btn btn-danger">
                <i class="bi bi-trash"></i>
                Hapus Buku
            </button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

</div>

<!-- Cover Image Modal -->
@if($book->cover)
<div class="modal-overlay" id="coverOverlay" onclick="closeCoverModal()"></div>
<div class="modal-image" id="coverModal">
    <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->title }}">
    <button class="modal-close" onclick="closeCoverModal()" style="position: absolute; top: 20px; right: 20px; background: rgba(0,0,0,0.7); color: white;">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteOverlay" onclick="closeDeleteModal()"></div>
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-exclamation-triangle-fill" style="color: #ef4444;"></i>
                Konfirmasi Hapus Buku
            </h3>
            <button class="modal-close" onclick="closeDeleteModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Apakah Anda yakin ingin menghapus buku <strong>{{ $book->title }}</strong>? 
                Tindakan ini tidak dapat dibatalkan dan semua data peminjaman terkait akan terpengaruh.
            </p>
            <form action="{{ route('admin.books.destroy', $book) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        Ya, Hapus Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showCoverModal() {
        document.getElementById('coverOverlay').classList.add('active');
        document.getElementById('coverModal').classList.add('active');
    }

    function closeCoverModal() {
        document.getElementById('coverOverlay').classList.remove('active');
        document.getElementById('coverModal').classList.remove('active');
    }

    function confirmDelete() {
        document.getElementById('deleteOverlay').classList.add('active');
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('deleteOverlay').classList.remove('active');
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeCoverModal();
            closeDeleteModal();
        }
    });
</script>
@endpush