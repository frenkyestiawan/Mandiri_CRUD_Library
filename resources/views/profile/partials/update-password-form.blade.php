<div class="container">
    <div class="profile-card">
        <section class="profile-section">
            <header class="section-header">
                <div class="header-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h2 class="section-title">
                        {{ __('Keamanan & Password') }}
                    </h2>
                    <p class="section-description">
                        {{ __('Pastikan akun Anda menggunakan kata sandi yang kuat dan aman.') }}
                    </p>
                </div>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="profile-form">
                @csrf
                @method('put')

                <div class="profile-fields-section">
                    <div class="form-group">
                        <label for="update_password_current_password" class="form-label">
                            <i class="bi bi-key"></i>
                            {{ __('Password Saat Ini') }}
                        </label>
                        <input id="update_password_current_password" name="current_password" type="password"
                            class="form-control" autocomplete="current-password" placeholder="••••••••" />
                        @if ($errors->updatePassword->get('current_password'))
                            <span class="form-error">
                                {{ $errors->updatePassword->first('current_password') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="update_password_password" class="form-label">
                            <i class="bi bi-shield-lock"></i>
                            {{ __('Password Baru') }}
                        </label>
                        <input id="update_password_password" name="password" type="password" class="form-control"
                            autocomplete="new-password" placeholder="Minimal 8 karakter" />
                        @if ($errors->updatePassword->get('password'))
                            <span class="form-error">
                                {{ $errors->updatePassword->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="update_password_password_confirmation" class="form-label">
                            <i class="bi bi-check2-circle"></i>
                            {{ __('Konfirmasi Password') }}
                        </label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                            class="form-control" autocomplete="new-password" placeholder="Ulangi password baru" />
                        @if ($errors->updatePassword->get('password_confirmation'))
                            <span class="form-error">
                                {{ $errors->updatePassword->first('password_confirmation') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        {{ __('Simpan Password') }}
                    </button>

                    @if (session('status') === 'password-updated')
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => (show = false), 2000)"
                            class="save-status">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ __('Password berhasil diperbarui.') }}
                        </div>
                    @endif
                </div>
            </form>
        </section>
    </div>
</div>
