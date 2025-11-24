@extends('layouts.app')

@section('title', 'Tambah Buku - E-PERPUS')

@push('styles')
<style>
  @import url('/css/admin/book/create_book.css');
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