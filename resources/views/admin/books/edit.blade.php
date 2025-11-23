@extends('layouts.app')

@section('title', 'Edit Buku - E-PERPUS')

@push('styles')
<style>
    /* Page Header */
    .page-header-section {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(245, 158, 11, 0.2);
        position: relative;
        overflow: hidden;
    }

    body.dark .page-header-section {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
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

    /* Form Card */
    .form-card {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid;
        padding: 2rem;
    }

    body:not(.dark) .form-card {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    body.dark .form-card {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    /* Form Layout */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 2rem;
    }

    .form-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-main {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    /* Cover Upload */
    .cover-upload-section {
        border-radius: 16px;
        padding: 1.5rem;
        border: 2px dashed;
        transition: all 0.3s ease;
    }

    body:not(.dark) .cover-upload-section {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    body.dark .cover-upload-section {
        background: #0f172a;
        border-color: rgba(100, 116, 139, 0.5);
    }

    .cover-upload-section:hover {
        border-color: #f59e0b;
        transform: translateY(-2px);
    }

    body.dark .cover-upload-section:hover {
        border-color: #fbbf24;
    }

    .cover-preview {
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 12px;
        object-fit: cover;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .cover-placeholder {
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1rem;
        border: 2px dashed;
    }

    body:not(.dark) .cover-placeholder {
        background: white;
        border-color: #e2e8f0;
        color: #94a3b8;
    }

    body.dark .cover-placeholder {
        background: #1e293b;
        border-color: rgba(100, 116, 139, 0.5);
        color: #64748b;
    }

    .cover-placeholder i {
        font-size: 3rem;
        opacity: 0.5;
    }

    .upload-label {
        display: block;
        text-align: center;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .upload-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
    }

    .upload-input {
        display: none;
    }

    .upload-info {
        text-align: center;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    body:not(.dark) .upload-info {
        color: #64748b;
    }

    body.dark .upload-info {
        color: #94a3b8;
    }

    .remove-cover-btn {
        display: block;
        text-align: center;
        padding: 0.65rem 1.25rem;
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 2px solid rgba(239, 68, 68, 0.3);
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 0.75rem;
    }

    .remove-cover-btn:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-1px);
    }

    body.dark .remove-cover-btn {
        background: rgba(248, 113, 113, 0.15);
        color: #f87171;
        border-color: rgba(248, 113, 113, 0.3);
    }

    /* Form Groups */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    body:not(.dark) .form-label {
        color: #334155;
    }

    body.dark .form-label {
        color: #cbd5e1;
    }

    .form-label .required {
        color: #ef4444;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: 2px solid;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        font-family: inherit;
    }

    body:not(.dark) .form-input,
    body:not(.dark) .form-select,
    body:not(.dark) .form-textarea {
        background: white;
        border-color: #e2e8f0;
        color: #1e293b;
    }

    body:not(.dark) .form-input:focus,
    body:not(.dark) .form-select:focus,
    body:not(.dark) .form-textarea:focus {
        border-color: #f59e0b;
        outline: none;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    body.dark .form-input,
    body.dark .form-select,
    body.dark .form-textarea {
        background: #0f172a;
        border-color: rgba(100, 116, 139, 0.3);
        color: #e2e8f0;
    }

    body.dark .form-input:focus,
    body.dark .form-select:focus,
    body.dark .form-textarea:focus {
        border-color: #fbbf24;
        outline: none;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: #ef4444;
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .form-hint {
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    body:not(.dark) .form-hint {
        color: #64748b;
    }

    body.dark .form-hint {
        color: #94a3b8;
    }

    .form-error {
        font-size: 0.85rem;
        color: #ef4444;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    body.dark .form-error {
        color: #fca5a5;
    }

    /* Section Divider */
    .section-divider {
        margin: 2rem 0;
        border: none;
        height: 1px;
    }

    body:not(.dark) .section-divider {
        background: #e2e8f0;
    }

    body.dark .section-divider {
        background: rgba(100, 116, 139, 0.3);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    body:not(.dark) .section-title {
        color: #1e293b;
    }

    body.dark .section-title {
        color: #f1f5f9;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    body.dark .section-icon {
        background: rgba(251, 191, 36, 0.15);
        color: #fbbf24;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 2rem;
        border-top: 1px solid;
    }

    body:not(.dark) .form-actions {
        border-top-color: #e2e8f0;
    }

    body.dark .form-actions {
        border-top-color: rgba(100, 116, 139, 0.3);
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

    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
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
        border-color: #fbbf24;
        color: #fbbf24;
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

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #dc2626;
    }

    body.dark .alert-error {
        background: rgba(248, 113, 113, 0.15);
        border-color: rgba(248, 113, 113, 0.3);
        color: #fca5a5;
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

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    /* Responsive */
    @media (max-width: 968px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-sidebar {
            order: 2;
        }

        .form-main {
            order: 1;
        }

        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
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
                <h1><i class="bi bi-pencil-square"></i> Edit Buku</h1>
                <div class="breadcrumb">
                    <a href="{{ route('admin.books.index') }}">
                        <i class="bi bi-journal-bookmark"></i> Daftar Buku
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Edit: {{ $book->title }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle-fill" style="font-size: 1.25rem;"></i>
            <div>
                <strong>Terdapat kesalahan pada form:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
                    @foreach($errors->all() as $error)
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
                        <h3 class="section-title" style="margin-bottom: 1rem;">
                            <span class="section-icon">
                                <i class="bi bi-image"></i>
                            </span>
                            Cover Buku
                        </h3>

                        <div id="coverPreviewContainer" style="{{ $book->cover ? '' : 'display: none;' }}">
                            <img id="coverPreview" 
                                 class="cover-preview" 
                                 src="{{ $book->cover ? asset('storage/' . $book->cover) : '' }}" 
                                 alt="Preview">
                        </div>

                        <div id="coverPlaceholder" class="cover-placeholder" style="{{ $book->cover ? 'display: none;' : '' }}">
                            <i class="bi bi-image"></i>
                            <span>Belum ada cover</span>
                        </div>

                        <label for="cover" class="upload-label">
                            <i class="bi bi-cloud-upload"></i>
                            {{ $book->cover ? 'Ganti Cover' : 'Pilih Cover' }}
                        </label>
                        <input type="file" 
                               id="cover" 
                               name="cover" 
                               class="upload-input" 
                               accept="image/jpeg,image/png,image/jpg"
                               onchange="previewCover(event)">

                        @if($book->cover)
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
                                Judul Buku <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   class="form-input @error('title') error @enderror" 
                                   value="{{ old('title', $book->title) }}" 
                                   required
                                   placeholder="Masukkan judul buku">
                            @error('title')
                                <span class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="publisher" class="form-label">
                                Penerbit
                            </label>
                            <input type="text" 
                                   id="publisher" 
                                   name="publisher" 
                                   class="form-input @error('publisher') error @enderror" 
                                   value="{{ old('publisher', $book->publisher) }}"
                                   placeholder="Nama penerbit buku">
                            @error('publisher')
                                <span class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="author" class="form-label">
                                Penulis <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="author" 
                                   name="author" 
                                   class="form-input @error('author') error @enderror" 
                                   value="{{ old('author', $book->author) }}" 
                                   required
                                   placeholder="Nama penulis buku">
                            @error('author')
                                <span class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isbn" class="form-label">
                                ISBN
                            </label>
                            <input type="text" 
                                   id="isbn" 
                                   name="isbn" 
                                   class="form-input @error('isbn') error @enderror" 
                                   value="{{ old('isbn', $book->isbn) }}"
                                   placeholder="Contoh: 978-3-16-148410-0">
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

                    <hr class="section-divider">

                    <!-- Detail Buku -->
                    <div>
                        <h3 class="section-title">
                            <span class="section-icon">
                                <i class="bi bi-tags"></i>
                            </span>
                            Detail Buku
                        </h3>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div class="form-group">
                                <label for="category" class="form-label">
                                    Kategori <span class="required">*</span>
                                </label>
                                <select id="category" 
                                        name="category" 
                                        class="form-select @error('category') error @enderror" 
                                        required>
                                    <option value="">Pilih kategori</option>
                                    <option value="Fiksi" {{ old('category', $book->category) == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                                    <option value="Non-Fiksi" {{ old('category', $book->category) == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                    <option value="Novel" {{ old('category', $book->category) == 'Novel' ? 'selected' : '' }}>Novel</option>
                                    <option value="Biografi" {{ old('category', $book->category) == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                                    <option value="Sejarah" {{ old('category', $book->category) == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                                    <option value="Sains" {{ old('category', $book->category) == 'Sains' ? 'selected' : '' }}>Sains</option>
                                    <option value="Teknologi" {{ old('category', $book->category) == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                    <option value="Pendidikan" {{ old('category', $book->category) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Lainnya" {{ old('category', $book->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                <input type="number" 
                                       id="published_year" 
                                       name="published_year" 
                                       class="form-input @error('published_year') error @enderror" 
                                       value="{{ old('published_year', $book->published_year) }}"
                                       min="1900"
                                       max="{{ date('Y') }}"
                                       placeholder="{{ date('Y') }}">
                                @error('published_year')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">
                                    Stok <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       id="stock" 
                                       name="stock" 
                                       class="form-input @error('stock') error @enderror" 
                                       value="{{ old('stock', $book->stock) }}" 
                                       required
                                       min="0"
                                       placeholder="Jumlah buku">
                                @error('stock')
                                    <span class="form-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

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
                            <textarea id="description" 
                                      name="description" 
                                      class="form-textarea @error('description') error @enderror"
                                      placeholder="Tulis sinopsis atau deskripsi singkat tentang buku ini...">{{ old('description', $book->description) }}</textarea>
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
                            Batal
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i>
                            Update Buku
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hidden input for cover removal -->
            <input type="hidden" id="remove_cover" name="remove_cover" value="0">
        </form>
    </div>

</div>

<!-- Remove Cover Confirmation Modal -->
<div class="modal-overlay" id="removeCoverOverlay" onclick="closeRemoveCoverModal()"></div>
<div class="modal" id="removeCoverModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="bi bi-exclamation-triangle-fill" style="color: #ef4444;"></i>
                Konfirmasi Hapus Cover
            </h3>
            <button class="modal-close" onclick="closeRemoveCoverModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-text">
                Apakah Anda yakin ingin menghapus cover buku ini? Cover akan dihapus setelah Anda menyimpan perubahan.
            </p>
            <div class="modal-actions">
                <button type="button" onclick="closeRemoveCoverModal()" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i>
                    Batal
                </button>
                <button type="button" onclick="removeCover()" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    Ya, Hapus Cover
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewCover(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('coverPreview').src = e.target.result;
                document.getElementById('coverPreviewContainer').style.display = 'block';
                document.getElementById('coverPlaceholder').style.display = 'none';
                // Reset remove cover flag if new image is selected
                document.getElementById('remove_cover').value = '0';
            }
            reader.readAsDataURL(file);
        }
    }

    function confirmRemoveCover() {
        document.getElementById('removeCoverOverlay').classList.add('active');
        document.getElementById('removeCoverModal').classList.add('active');
    }

    function closeRemoveCoverModal() {
        document.getElementById('removeCoverOverlay').classList.remove('active');
        document.getElementById('removeCoverModal').classList.remove('active');
    }

    function removeCover() {
        // Hide preview and show placeholder
        document.getElementById('coverPreviewContainer').style.display = 'none';
        document.getElementById('coverPlaceholder').style.display = 'flex';
        
        // Set flag to remove cover on server
        document.getElementById('remove_cover').value = '1';
        
        // Clear file input
        document.getElementById('cover').value = '';
        
        // Close modal
        closeRemoveCoverModal();
        
        // Show notification
        alert('Cover akan dihapus setelah Anda menyimpan perubahan.');
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeRemoveCoverModal();
        }
    });
</script>
@endpush