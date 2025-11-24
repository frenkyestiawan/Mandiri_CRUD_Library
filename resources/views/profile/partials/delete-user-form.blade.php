<div class="container">
    <div class="profile-card">
        <section class="profile-section">
        <header class="section-header">
            <div class="header-icon">
                <i class="bi bi-exclamation-octagon"></i>
            </div>
            <div>
                <h2 class="section-title">
                    {{ __('Hapus Akun') }}
                </h2>
                <p class="section-description">
                    {{ __('Menghapus akun akan menghapus seluruh data dan riwayat Anda secara permanen.') }}
                </p>
            </div>
        </header>

        <div class="profile-form">
            <p class="section-description" style="margin-bottom: 1.5rem;">
                {{ __('Sebelum menghapus akun, pastikan Anda telah menyimpan data penting yang dibutuhkan.') }}
            </p>

            <div class="form-actions" style="border-top: none; padding-top: 0;">
                <button
                    type="button"
                    class="btn btn-danger"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >
                    <i class="bi bi-trash3"></i>
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </div>
        </section>
    </div>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Apakah Anda yakin ingin menghapus akun?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Setelah akun dihapus, semua data dan sumber daya akan dihapus secara permanen. Masukkan password untuk konfirmasi.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}"
            />

            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Hapus Akun') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
