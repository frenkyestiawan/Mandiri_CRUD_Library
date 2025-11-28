@extends('layouts.app')

@section('title', 'Lupa Password - E-PERPUS')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <div class="table-card" style="max-width: 600px; margin: 0 auto; padding: 2rem; border-radius: 16px;">
            <h1 class="page-title" style="font-size: 1.5rem; margin-bottom: 1rem;">Lupa Password</h1>

            @if (session('status'))
                <div class="alert alert-success" style="margin-bottom: 1rem;">
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <p style="margin-bottom: 1.5rem; color: var(--text-muted);">
                Masukkan alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror" style="width: 100%; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #e5e7eb;">
                    @error('email')
                        <div class="invalid-feedback" style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
            </form>
        </div>
    </div>
@endsection
