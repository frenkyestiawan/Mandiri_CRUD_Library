@extends('layouts.app')

@section('title', config('app.name', 'E-PERPUS') . ' - Register')

@push('styles')
    <style>
        .footer {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/authentication/register.css') }}" />
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('auth-page');
        });
    </script>
@endpush

@section('content')
    <div id="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <div class="library-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="register-title">{{ __('Daftar Akun') }}</div>
                <div class="register-subtitle">
                    {{ __('Buat akun baru untuk mengakses perpustakaan digital') }}
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-person"></i>
                        {{ __('Nama Lengkap') }}
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="bi bi-person-fill"></i></div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            placeholder="Masukkan nama lengkap" />
                    </div>
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i>
                        {{ __('Email') }}
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="bi bi-envelope-fill"></i></div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="username"
                            placeholder="Masukkan alamat email" />
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i>
                        {{ __('Password') }}
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="bi bi-lock-fill"></i></div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="bi bi-eye-slash-fill" id="toggleIcon1"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="bi bi-shield-check"></i>
                        {{ __('Konfirmasi Password') }}
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="bi bi-shield-fill-check"></i></div>
                        <input id="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi password" />
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="bi bi-eye-slash-fill" id="toggleIcon2"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="form-terms">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required />
                        <label class="form-check-label" for="terms">
                            Saya menyetujui
                            <a href="#" class="terms-link">syarat dan ketentuan</a>
                            yang berlaku
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus"></i>
                    {{ __('Register') }}
                </button>

                <!-- Login Link -->
                <div class="login-link">
                    <small>
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Masuk di sini</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/authentication/auth.js') }}"></script>
@endpush
