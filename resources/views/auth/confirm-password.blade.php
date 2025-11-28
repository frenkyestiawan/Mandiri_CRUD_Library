@extends('layouts.app')

@section('title', 'Konfirmasi Password - E-PERPUS')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem">
        <div class="table-card" style="max-width: 600px; margin: 0 auto; padding: 2rem; border-radius: 16px">
            <h1 class="page-title" style="font-size: 1.5rem; margin-bottom: 1rem">
                Konfirmasi Password
            </h1>

            <p style="margin-bottom: 1.5rem; color: var(--text-muted)">
                Ini adalah area yang aman dari aplikasi. Sebelum melanjutkan, harap konfirmasi
                password Anda.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group" style="margin-bottom: 1rem">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="form-control @error('password') is-invalid @enderror"
                        style="
                            width: 100%;
                            padding: 0.5rem 0.75rem;
                            border-radius: 8px;
                            border: 1px solid #e5e7eb;
                        " />
                    @error('password')
                        <div class="invalid-feedback" style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Konfirmasi</button>
            </form>
        </div>
    </div>
@endsection
