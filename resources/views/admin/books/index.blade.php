@extends('layouts.app')

@section('title', 'Daftar Buku - E-PERPUS')

@push('styles')
<style>
    /* Page Header */
    @import url('/css/admin/book/index_book.css');
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <i class="bi bi-journal-bookmark"></i> Daftar Buku
            </h1>
            <p class="page-header-subtitle">Kelola koleksi buku perpustakaan digital</p>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill" style="font-size: 1.25rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filter Card -->
    <div class="filter-card">
        <form method="GET" action="{{ route('admin.books.index') }}">
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
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i>
                    Reset
                </a>
                <a href="{{ route('admin.books.create') }}" class="btn btn-success" style="margin-left: auto;">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Buku
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
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Tahun</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $book->title }}</div>
                            @if($book->isbn)
                                <div style="font-size: 0.8rem; opacity: 0.7;">ISBN: {{ $book->isbn }}</div>
                            @endif
                        </td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher ?? '-' }}</td>
                        <td>
                            <span class="category-badge">
                                {{ $book->category }}
                            </span>
                        </td>
                        <td>
                            @php
                                $stockClass = 'high';
                                if($book->stock < 5) $stockClass = 'low';
                                elseif($book->stock < 10) $stockClass = 'medium';
                            @endphp
                            <span class="stock-badge {{ $stockClass }}">
                                {{ $book->stock }} unit
                            </span>
                        </td>
                        <td>{{ $book->published_year }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <a href="{{ route('admin.books.show', $book) }}" class="action-btn view">
                                    <i class="bi bi-eye"></i>
                                    Detail
                                </a>
                                <a href="{{ route('admin.books.edit', $book) }}" class="action-btn edit">
                                    <i class="bi bi-pencil"></i>
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}')" class="action-btn delete">
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox empty-icon"></i>
                                <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Belum ada data buku</p>
                                <p style="font-size: 0.9rem;">Tambahkan buku pertama Anda untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($books->hasPages())
            <div class="pagination">
                {{ $books->links('pagination.app') }}
            </div>
        @endif
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal()"></div>
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-exclamation-triangle" style="color: #ef4444;"></i>
                Konfirmasi Hapus
            </h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Apakah Anda yakin ingin menghapus buku <strong id="bookTitle"></strong>? 
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" onclick="closeModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(bookId, bookTitle) {
        document.getElementById('bookTitle').textContent = bookTitle;
        document.getElementById('deleteForm').action = `/admin/books/${bookId}`;
        document.getElementById('modalOverlay').classList.add('active');
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush