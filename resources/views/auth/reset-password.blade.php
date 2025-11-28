@extends('layouts.app')

@section('title', 'Reset Password - E-PERPUS')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <div class="table-card" style="max-width: 600px; margin: 0 auto; padding: 2rem; border-radius: 16px;">
            <h1 class="page-title" style="font-size: 1.5rem; margin-bottom: 1rem;">Reset Password</h1>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                        class="form-control @error('email') is-invalid @enderror" style="width: 100%; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #e5e7eb;">
                    @error('email')
                        <div class="invalid-feedback" style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password" class="form-label">Password Baru</label>
                    <input id="password" type="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror" style="width: 100%; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #e5e7eb;">
                    @error('password')
                        <div class="invalid-feedback" style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="form-control" style="width: 100%; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #e5e7eb;">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
            </form>
        </div>
    </div>
@endsection
