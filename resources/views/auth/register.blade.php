@extends('layouts.auth')

@section('title', 'Daftar Akun Baru')

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
                <h5 class="fw-bold mb-1">Registrasi Akun</h5>
                <p class="text-muted small">Lengkapi formulir di bawah ini untuk membuat akun baru</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 small py-2"
                    role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                    <div class="flex-grow-1">Terdapat kesalahan pada data yang Anda isi.</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" id="registerForm">
                @csrf

                <!-- Full Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Rian Pratama" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="contoh: rianpratama@gmail.com" value="{{ old('email') }}" required
                            autocomplete="username" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold text-secondary">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter"
                            required autocomplete="new-password" />
                        <button type="button" class="btn btn-outline-secondary password-toggle-btn border-start-0"
                            data-target="password" tabindex="-1" title="Tampilkan / Sembunyikan Sandi">
                            <i class="bi bi-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password Confirmation Field -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label small fw-semibold text-secondary">Konfirmasi Kata
                        Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="Ketik ulang kata sandi Anda" required autocomplete="new-password" />
                        <button type="button" class="btn btn-outline-secondary password-toggle-btn border-start-0"
                            data-target="password_confirmation" tabindex="-1" title="Tampilkan / Sembunyikan Sandi">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms & Conditions Checkbox -->
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms"
                            id="terms" {{ old('terms') ? 'checked' : '' }} required />
                        <label class="form-check-label small text-secondary" for="terms">
                            Saya menyetujui <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#termsModal">Syarat & Ketentuan Layanan</a>
                        </label>
                        @error('terms')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="btn btn-primary w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm"
                    id="btnRegister">
                    <i class="bi bi-person-check-fill"></i>
                    <span>Daftar Sekarang</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none ms-1">
                Masuk di sini <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Modal Terms & Conditions -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="termsModalLabel">
                        <i class="bi bi-file-earmark-medical text-primary me-2"></i>Syarat & Ketentuan Axion Vet
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary small">
                    <h6>1. Ketentuan Penggunaan</h6>
                    <p>Sistem Pakar Axion Vet dirancang sebagai sarana pendukung keputusan dalam mendiagnosa kemungkinan
                        penyakit pada hewan berdasarkan basis pengetahuan dan metode inferensi Certainty Factor (CF).</p>

                    <h6>2. Akurasi Hasil Diagnosa</h6>
                    <p>Hasil diagnosa dari sistem pakar ini berfungsi sebagai rujukan awal dan tidak menggantikan sepenuhnya
                        pemeriksaan fisik langsung oleh dokter hewan berwenang.</p>

                    <h6>3. Keamanan Data Akun</h6>
                    <p>Pengguna bertanggung jawab untuk menjaga kerahasiaan kata sandi dan seluruh aktivitas yang terjadi
                        dalam akun pengguna.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>
@endsection