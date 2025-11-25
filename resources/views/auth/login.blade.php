@extends('layouts.app')

@section('title', config('app.name', 'E-PERPUS') . ' - Login')

@push('styles')
<style>
    @import url('/css/authentication/login.css');
</style>
@endpush

@section('content')
    <div id="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="library-icon">
                    <i class="bi bi-book-fill"></i>
                </div>
                <div class="login-title">{{ __('E-PERPUS') }}</div>
                <div class="login-subtitle">{{ __('Sistem Perpustakaan Digital') }}</div>
            </div>

            @if (Route::has('login') && auth()->check())
                <div class="welcome-card">
                    <h4>Selamat Datang Kembali, {{ auth()->user()->name }}</h4>
                    <a href="{{ route('dashboard') }}" class="btn btn-light mt-3">Ke Dashboard</a>
                </div>
            @else

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i>
                        {{ __('Email') }}
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="bi bi-envelope-fill"></i></div>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            autocomplete="username" 
                            placeholder="Masukkan alamat email"
                        >
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
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('password','toggleIcon1')">
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

                <!-- Remember Me -->
                <div class="form-options">
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="remember" 
                            id="remember_me" 
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="remember_me">
                            {{ __('Ingat Saya') }}
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    {{ __('Login') }}
                </button>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="register-link">
                        <small>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></small>
                    </div>
                @endif
            </form>

            @endif
        </div>
    </div>
@endsection


@push('scripts')
<script>
    function togglePassword(fieldId, iconId){
        var f = document.getElementById(fieldId);
        var i = document.getElementById(iconId);
        if(!f) return;
        if(f.type === 'password'){
            f.type = 'text';
            if(i) i.className = 'bi bi-eye-fill';
        } else {
            f.type = 'password';
            if(i) i.className = 'bi bi-eye-slash-fill';
        }
    }
</script>
@endpush