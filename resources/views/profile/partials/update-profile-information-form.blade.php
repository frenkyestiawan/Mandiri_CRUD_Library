@section('title', 'Profile - E-PERPUS')


@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
@endpush

<div class="container">
    <div class="profile-card">
        <section class="profile-section">
            <header class="section-header">
                <div class="header-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div>
                    <h2 class="section-title">
                        {{ __('Informasi & Foto Profil') }}
                    </h2>
                    <p class="section-description">
                        {{ __("Perbarui informasi profil dan foto akun Anda.") }}
                    </p>
                </div>
            </header>

            <form method="post" action="{{ route('profile.update') }}" class="profile-form" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="profile-layout">
                    <!-- Left Side: Photo Upload -->
                    <div class="profile-photo-section">
                        <div class="photo-wrapper">
                            <div class="current-photo">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Photo" class="profile-photo">
                                @else
                                    <div class="photo-placeholder">
                                        <span class="placeholder-initial">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="photo-overlay" onclick="document.getElementById('photo-input').click()">
                                <i class="bi bi-camera"></i>
                            </div>
                        </div>
                        
                        <input 
                            type="file" 
                            id="photo-input" 
                            name="photo" 
                            accept="image/*" 
                            class="photo-input-hidden"
                            onchange="previewPhoto(this)"
                        />
                        
                        <button type="button" class="btn btn-upload" onclick="document.getElementById('photo-input').click()">
                            <i class="bi bi-upload"></i>
                            {{ __('Unggah Foto') }}
                        </button>
                        
                        <p class="photo-note">
                            {{ __('JPG, PNG atau GIF. Maksimal 2MB.') }}
                        </p>

                        @error('photo')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Right Side: Form Fields -->
                    <div class="profile-fields-section">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="bi bi-person"></i>
                                {{ __('Nama Lengkap') }}
                            </label>
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                class="form-control" 
                                value="{{ old('name', $user->name) }}" 
                                required 
                                autofocus 
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                            />
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i>
                                {{ __('Email') }}
                            </label>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                class="form-control" 
                                value="{{ old('email', $user->email) }}" 
                                required 
                                autocomplete="username"
                                placeholder="admin@example.com"
                            />
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{--
                        <div class="form-group">
                            <label for="role" class="form-label">
                                <i class="bi bi-shield-check"></i>
                                {{ __('Role') }}
                            </label>
                            <input 
                                id="role" 
                                type="text" 
                                class="form-control" 
                                value="{{ Auth::user()->roles->first()->name ?? 'No Role' }}" 
                                readonly
                                disabled
                            />
                            <p class="field-note">
                                {{ __('Role tidak dapat diubah oleh pengguna.') }}
                            </p>
                        </div>
                        --}}
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        {{ __('Simpan Perubahan') }}
                    </button>

                    <button type="reset" class="btn btn-outline">
                        <i class="bi bi-x-circle"></i>
                        {{ __('Batal') }}
                    </button>

                    @if (session('status') === 'profile-updated')
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            class="save-status"
                        >
                            <i class="bi bi-check-circle-fill"></i>
                            {{ __('Perubahan berhasil disimpan!') }}
                        </div>
                    @endif
                </div>
            </form>
        </section>
    </div>
</div>


@push('scripts')
<script src="{{ asset('js/profile/profile.js') }}"></script>
@endpush