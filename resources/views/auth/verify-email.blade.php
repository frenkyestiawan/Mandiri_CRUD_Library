@extends('layouts.app')

@section('title', 'Verifikasi Email - E-PERPUS')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <div class="table-card" style="max-width: 600px; margin: 0 auto; padding: 2rem; border-radius: 16px;">
            <h1 class="page-title" style="font-size: 1.5rem; margin-bottom: 1rem;">Verifikasi Email</h1>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" style="margin-bottom: 1rem;">
                    <span>Link verifikasi baru telah dikirim ke alamat email Anda.</span>
                </div>
            @endif

            <p style="margin-bottom: 1.5rem; color: var(--text-muted);">
                Sebelum melanjutkan, silakan cek email Anda untuk link verifikasi.
                Jika Anda tidak menerima email tersebut, Anda dapat meminta ulang.
            </p>

            <form method="POST" action="{{ route('verification.send') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
                @csrf
                <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="display:none;"></a>
            </form>
        </div>
    </div>
@endsection
