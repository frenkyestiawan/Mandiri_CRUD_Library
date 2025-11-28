@extends('layouts.app')

@section('title', 'Edit Buku - E-PERPUS')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/book/edit_book.css') }}" />
@endpush

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem; max-width: 1200px">
        <!-- Page Header -->
        <div class="page-header-section">
            <div class="page-header-content">
                <div class="page-header-left">
                    <h1>
                        <i class="bi bi-pencil-square"></i>
                        Edit Buku
                    </h1>
                    <div class="breadcrumb">
                        <a href="{{ route('admin.books.index') }}">
                            <i class="bi bi-journal-bookmark"></i>
                            Daftar Buku
                        </a>
                        <i class="bi bi-chevron-right"></i>
                        <span>Edit: {{ $book->title }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-error">
                <i class="bi bi-exclamation-circle-fill" style="font-size: 1.25rem"></i>
                <div>
                    <strong>Terdapat kesalahan pada form:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="form-card">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Sidebar: Cover Upload -->
                    <div class="form-sidebar">
                        <div class="cover-upload-section">
                            <h3 class="section-title" style="margin-bottom: 1rem">
                                <span class="section-icon">
                                    <i class="bi bi-image"></i>
                                </span>
                                Cover Buku
                            </h3>

                            <div id="coverPreviewContainer" style="{{ $book->cover ? '' : 'display: none;' }}">
                                <img id="coverPreview" class="cover-preview"
                                    src="{{ $book->cover ? asset('storage/' . $book->cover) : '' }}" alt="Preview" />
                            </div>

                            <div id="coverPlaceholder" class="cover-placeholder"
                                style="{{ $book->cover ? 'display: none;' : '' }}">
                                <i class="bi bi-image"></i>
                                <span>Belum ada cover</span>
                            </div>

                            <label for="cover" class="upload-label">
                                <i class="bi bi-cloud-upload"></i>
                                {{ $book->cover ? 'Ganti Cover' : 'Pilih Cover' }}
                            </label>
                            <input type="file" id="cover" name="cover" class="upload-input"
                                accept="image/jpeg,image/png,image/jpg" onchange="previewCover(event)" />

                            @if ($book->cover)
                                <button type="button" class="remove-cover-btn" onclick="confirmRemoveCover()">
                                    <i class="bi bi-trash"></i>
                                    Hapus Cover
                                </button>
                            @endif

                            <p class="upload-info">
                                <i class="bi bi-info-circle"></i>
                                Format: JPG, PNG (Max: 2MB)
                            </p>
                        </div>
                    </div>

                    <!-- Main Form -->
                    <div class="form-main">
                        <!-- Informasi Dasar -->
                        <div>
                            <h3 class="section-title">
                                <span class="section-icon">
                                    <i class="bi bi-info-circle"></i>
                                </span>
                                Informasi Dasar
                            </h3>

                            <div class="form-group">
                                <label for="title" class="form-label">
                                    Judul Buku
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="title" name="title"
                                    class="@error('title') error @enderror form-input"
                                    value="{{ old('title', $book->title) }}" required placeholder="Masukkan judul buku" />
                                @error('title')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="publisher" class="form-label">Penerbit</label>
                                <input type="text" id="publisher" name="publisher"
                                    class="@error('publisher') error @enderror form-input"
                                    value="{{ old('publisher', $book->publisher) }}" placeholder="Nama penerbit buku" />
                                @error('publisher')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="author" class="form-label">
                                    Penulis
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="author" name="author"
                                    class="@error('author') error @enderror form-input"
                                    value="{{ old('author', $book->author) }}" required placeholder="Nama penulis buku" />
                                @error('author')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" id="isbn" name="isbn"
                                    class="@error('isbn') error @enderror form-input"
                                    value="{{ old('isbn', $book->isbn) }}" placeholder="Contoh: 978-3-16-148410-0" />
                                <span class="form-hint">
                                    <i class="bi bi-lightbulb"></i>
                                    Nomor ISBN untuk identifikasi buku
                                </span>
                                @error('isbn')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr class="section-divider" />

                        <!-- Detail Buku -->
                        <div>
                            <h3 class="section-title">
                                <span class="section-icon">
                                    <i class="bi bi-tags"></i>
                                </span>
                                Detail Buku
                            </h3>

                            <div
                                style="
                                    display: grid;
                                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                                    gap: 1rem;
                                ">
                                <div class="form-group">
                                    <label for="category" class="form-label">
                                        Kategori
                                        <span class="required">*</span>
                                    </label>
                                    <select id="category" name="category"
                                        class="@error('category') error @enderror form-select" required>
                                        <option value="">Pilih kategori</option>
                                        <option value="Fiksi"
                                            {{ old('category', $book->category) == 'Fiksi' ? 'selected' : '' }}>
                                            Fiksi
                                        </option>
                                        <option value="Non-Fiksi"
                                            {{ old('category', $book->category) == 'Non-Fiksi' ? 'selected' : '' }}>
                                            Non-Fiksi
                                        </option>
                                        <option value="Novel"
                                            {{ old('category', $book->category) == 'Novel' ? 'selected' : '' }}>
                                            Novel
                                        </option>
                                        <option value="Biografi"
                                            {{ old('category', $book->category) == 'Biografi' ? 'selected' : '' }}>
                                            Biografi
                                        </option>
                                        <option value="Sejarah"
                                            {{ old('category', $book->category) == 'Sejarah' ? 'selected' : '' }}>
                                            Sejarah
                                        </option>
                                        <option value="Sains"
                                            {{ old('category', $book->category) == 'Sains' ? 'selected' : '' }}>
                                            Sains
                                        </option>
                                        <option value="Teknologi"
                                            {{ old('category', $book->category) == 'Teknologi' ? 'selected' : '' }}>
                                            Teknologi
                                        </option>
                                        <option value="Pendidikan"
                                            {{ old('category', $book->category) == 'Pendidikan' ? 'selected' : '' }}>
                                            Pendidikan
                                        </option>
                                        <option value="Lainnya"
                                            {{ old('category', $book->category) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    @error('category')
                                        <span class="form-error">
                                            <i class="bi bi-exclamation-circle"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="published_year" class="form-label">
                                        Tahun Terbit
                                    </label>
                                    <input type="number" id="published_year" name="published_year"
                                        class="@error('published_year') error @enderror form-input"
                                        value="{{ old('published_year', $book->published_year) }}" min="1900"
                                        max="{{ date('Y') }}" placeholder="{{ date('Y') }}" />
                                    @error('published_year')
                                        <span class="form-error">
                                            <i class="bi bi-exclamation-circle"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stock" class="form-label">
                                        Stok
                                        <span class="required">*</span>
                                    </label>
                                    <input type="number" id="stock" name="stock"
                                        class="@error('stock') error @enderror form-input"
                                        value="{{ old('stock', $book->stock) }}" required min="0"
                                        placeholder="Jumlah buku" />
                                    @error('stock')
                                        <span class="form-error">
                                            <i class="bi bi-exclamation-circle"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider" />

                        <!-- Sinopsis -->
                        <div>
                            <h3 class="section-title">
                                <span class="section-icon">
                                    <i class="bi bi-journal-text"></i>
                                </span>
                                Sinopsis
                            </h3>

                            <div class="form-group">
                                <label for="description" class="form-label">
                                    Deskripsi / Sinopsis Buku
                                </label>
                                <textarea id="description" name="description" class="@error('description') error @enderror form-textarea"
                                    placeholder="Tulis sinopsis atau deskripsi singkat tentang buku ini...">
    {{ old('description', $book->description) }}</textarea>
                                <span class="form-hint">
                                    <i class="bi bi-lightbulb"></i>
                                    Berikan gambaran singkat tentang isi buku
                                </span>
                                @error('description')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="{{ route('admin.books.show', $book) }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle"></i>
                                Update Book Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hidden input for cover removal -->
                <input type="hidden" id="remove_cover" name="remove_cover" value="0" />
            </form>
        </div>
    </div>

    <!-- Remove Cover Confirmation Modal -->
    <div class="modal-overlay" id="removeCoverOverlay" onclick="closeRemoveCoverModal()"></div>
    <div class="modal" id="removeCoverModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill" style="color: #ef4444"></i>
                    Remove Cover Confirmation
                </h3>
                <button class="modal-close" onclick="closeRemoveCoverModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    Are you sure you want to remove this book cover? The cover will be removed after
                    you save the changes.
                </p>
                <div class="modal-actions">
                    <button type="button" onclick="closeRemoveCoverModal()" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </button>
                    <button type="button" onclick="removeCover()" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        Yes, Remove Cover
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/books/edit_book.js') }}"></script>
@endpush
