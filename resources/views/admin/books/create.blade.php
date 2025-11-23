@extends('layouts.app')

@section('title', 'Tambah Buku - E-PERPUS')

@push('styles')
<style>
    /* Page Header */
    .page-header-section {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
        position: relative;
        overflow: hidden;
    }

    body.dark .page-header-section {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
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
        border-color: #10b981;
        transform: translateY(-2px);
    }

    body.dark .cover-upload-section:hover {
        border-color: #34d399;
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
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .upload-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
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
        border-color: #10b981;
        outline: none;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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
        border-color: #34d399;
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.1);
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
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    body.dark .section-icon {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
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
        border-color: #34d399;
        color: #34d399;
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
                <h1><i class="bi bi-plus-circle"></i> Tambah Buku Baru</h1>
                <div class="breadcrumb">
                    <a href="{{ route('admin.books.index') }}">
                        <i class="bi bi-journal-bookmark"></i> Daftar Buku
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Tambah Buku</span>
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
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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

                        <div id="coverPreviewContainer" style="display: none;">
                            <img id="coverPreview" class="cover-preview" src="" alt="Preview">
                        </div>

                        <div id="coverPlaceholder" class="cover-placeholder">
                            <i class="bi bi-image"></i>
                            <span>Belum ada cover</span>
                        </div>

                        <label for="cover" class="upload-label">
                            <i class="bi bi-cloud-upload"></i>
                            Pilih Cover
                        </label>
                        <input type="file" 
                               id="cover" 
                               name="cover" 
                               class="upload-input" 
                               accept="image/jpeg,image/png,image/jpg"
                               onchange="previewCover(event)">

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
                                   value="{{ old('title') }}" 
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
                                   value="{{ old('publisher') }}"
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
                                   value="{{ old('author') }}" 
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
                                   value="{{ old('isbn') }}"
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
                                    <option value="Fiksi" {{ old('category') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                                    <option value="Non-Fiksi" {{ old('category') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                    <option value="Novel" {{ old('category') == 'Novel' ? 'selected' : '' }}>Novel</option>
                                    <option value="Biografi" {{ old('category') == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                                    <option value="Sejarah" {{ old('category') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                                    <option value="Sains" {{ old('category') == 'Sains' ? 'selected' : '' }}>Sains</option>
                                    <option value="Teknologi" {{ old('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                    <option value="Pendidikan" {{ old('category') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                       value="{{ old('published_year') }}"
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
                                       value="{{ old('stock', 1) }}" 
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
                                      placeholder="Tulis sinopsis atau deskripsi singkat tentang buku ini...">{{ old('description') }}</textarea>
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
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Simpan Buku
                        </button>
                    </div>
                </div>
            </div>
        </form>
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
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush