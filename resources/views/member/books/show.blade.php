@extends('layouts.app')

@section('title', 'Detail Buku - E-PERPUS')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/anggota/book/show_book.css') }}" />
@endpush

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem; max-width: 1200px">
        <!-- Page Header -->
        <div class="page-header-section">
            <div class="page-header-content">
                <div class="page-header-left">
                    <h1>
                        <i class="bi bi-book-fill"></i>
                        Detail Buku
                    </h1>
                    <div class="breadcrumb">
                        <a href="{{ route('member.books.index') }}">
                            <i class="bi bi-journal-bookmark"></i>
                            Katalog Buku
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
                    @if ($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" class="book-cover" alt="Cover {{ $book->title }}"
                            onclick="showCoverModal()" />
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
                        <i class="bi bi-person-fill"></i>
                        Oleh {{ $book->author }}
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
                                <i class="bi bi-box-seam"></i>
                                Stok Tersedia
                            </div>
                            <div class="info-value">
                                @php
                                    $stockClass = 'high';
                                    if ($book->stock < 5 && $book->stock > 0) {
                                        $stockClass = 'low';
                                    } elseif ($book->stock >= 5 && $book->stock < 10) {
                                        $stockClass = 'medium';
                                    } elseif ($book->stock == 0) {
                                        $stockClass = 'low';
                                    }
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
                <p class="description-text">
                    {{ $book->description ?? 'Belum ada sinopsis untuk buku ini.' }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                @if ($book->stock > 0)
                    <button onclick="confirmBorrow()" class="btn btn-primary">
                        <i class="bi bi-bookmark-plus"></i>
                        Borrow Book
                    </button>
                @else
                    <span class="unavailable-badge">
                        <i class="bi bi-x-circle"></i>
                        Book is not available
                    </span>
                @endif
                <a href="{{ route('member.books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    <!-- Cover Image Modal -->
    @if ($book->cover)
        <div class="modal-overlay" id="coverOverlay" onclick="closeCoverModal()"></div>
        <div class="modal-image" id="coverModal">
            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->title }}" />
            <button class="modal-close" onclick="closeCoverModal()"
                style="
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    background: rgba(0, 0, 0, 0.7);
                    color: white;
                ">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    <!-- Borrow Confirmation Modal -->
    <div class="modal-overlay" id="borrowOverlay" onclick="closeBorrowModal()"></div>
    <div class="modal" id="borrowModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="bi bi-bookmark-plus-fill" style="color: #3b82f6"></i>
                    Borrow Confirmation
                </h3>
                <button class="modal-close" onclick="closeBorrowModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    Are you sure you want to borrow the book
                    <strong>{{ $book->title }}</strong>
                    ?
                    <br />
                    <br />
                    Your loan request will be submitted and wait for admin approval.
                </p>
                <form action="{{ route('member.loans.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}" />
                    <div class="modal-actions">
                        <button type="button" onclick="closeBorrowModal()" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
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
    <script src="{{ asset('js/anggota/book/show_book.js') }}"></script>
@endpush
