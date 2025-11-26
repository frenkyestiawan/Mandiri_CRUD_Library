@extends('layouts.app')

@section('title', 'Katalog Buku - E-PERPUS')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/anggota/book/index_book.css') }}">
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
                        $statusText = $book->stock > 0 ? 'Available' : 'Currently Borrowed';
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
                                        Not Available
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
                Borrow Confirmation
            </h3>
            <button class="modal-close" onclick="closeBorrowModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Are you sure you want to borrow the book <strong id="borrowBookTitle"></strong>?
                <br><br>
                Your loan request will be submitted and wait for admin approval.
            </p>
            <form id="borrowForm" method="POST" action="{{ route('member.loans.store') }}">
                @csrf
                <input type="hidden" id="borrowBookId" name="book_id" value="">
                <div class="modal-actions">
                    <button type="button" onclick="closeBorrowModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Yes, Borrow Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/anggota/book/index_book.js') }}"></script>
@endpush