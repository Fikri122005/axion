@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="auth-card">
    <!-- Header -->
    <div class="auth-header">
        <div class="auth-brand-icon">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>
        <h4 class="fw-bold mb-1">Axion<span class="text-primary">Vet</span></h4>
        <p class="text-secondary small mb-0">Sistem Pakar Diagnosa Penyakit Hewan</p>
    </div>

    <!-- Body -->
    <div class="auth-body">
        <div class="mb-4 text-center">
            <h5 class="fw-bold mb-1">Selamat Datang!</h5>
            <p class="text-muted small">Silakan masukkan akun Anda untuk melanjutkan</p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 small py-2" role="alert">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show d-flex align-items-center gap-2 small py-2" role="alert">
                <i class="bi bi-info-circle-fill text-info fs-5"></i>
                <div class="flex-grow-1">{{ session('info') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any() && !session('success') && !session('info'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 small py-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                <div class="flex-grow-1">Periksa kembali data yang Anda masukkan.</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold text-secondary">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="contoh: dokter@axionvet.test"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label small fw-semibold text-secondary mb-1">Kata Sandi</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan kata sandi"
                        required
                        autocomplete="current-password"
                    />
                    <button
                        type="button"
                        class="btn btn-outline-secondary password-toggle-btn border-start-0"
                        data-target="password"
                        tabindex="-1"
                        title="Tampilkan / Sembunyikan Sandi"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small text-secondary" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm" id="btnSubmit">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Masuk ke Akun</span>
            </button>
        </form>

        <!-- Quick Demo Credentials Box -->
        <div class="mt-4 pt-3 border-top">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="small text-muted fw-semibold"><i class="bi bi-key me-1"></i>Akun Demo Cepat:</span>
                <span class="badge text-bg-light text-secondary border">Klik untuk isi</span>
            </div>
            <div class="d-flex gap-2">
                <button
                    type="button"
                    class="btn btn-sm btn-outline-primary flex-fill demo-acc-badge d-flex align-items-center justify-content-center gap-1"
                    onclick="fillCredentials('admin@axionvet.test', 'password')"
                >
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Admin</span>
                </button>
                <button
                    type="button"
                    class="btn btn-sm btn-outline-success flex-fill demo-acc-badge d-flex align-items-center justify-content-center gap-1"
                    onclick="fillCredentials('user@axionvet.test', 'password')"
                >
                    <i class="bi bi-person-fill"></i>
                    <span>User</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="auth-footer">
        Belum memiliki akun?
        <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none ms-1">
            Daftar Sekarang <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function fillCredentials(email, password) {
        const emailInput = document.getElementById('email');
        const passInput = document.getElementById('password');
        if (emailInput && passInput) {
            emailInput.value = email;
            passInput.value = password;
            emailInput.classList.remove('is-invalid');
            passInput.classList.remove('is-invalid');
        }
    }
</script>
@endpush
