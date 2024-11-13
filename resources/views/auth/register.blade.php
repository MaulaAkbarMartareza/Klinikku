@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg overflow-hidden animate__animated animate__fadeInUp">
                <div class="card-header bg-gradient-primary text-white text-center py-5">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="mb-4 animate__animated animate__pulse animate__infinite" style="max-width: 180px;">
                    <h2 class="font-weight-bold mb-2 animate__animated animate__fadeInDown">Selamat Datang di Klinik Akbar</h2>
                    <p class="text-white-50 mb-0 animate__animated animate__fadeInUp animate__delay-1s">Daftarkan Diri Anda dan Nikmati Layanan Kami</p>
                </div>

                <div class="card-body p-5 bg-light">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-floating mb-4 animate__animated animate__fadeInLeft animate__delay-1s">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Lengkap">
                            <label for="name">
                                <i class="fas fa-user-circle me-2"></i>
                                <span>Nama Lengkap</span>
                            </label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 animate__animated animate__fadeInRight animate__delay-2s">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Alamat Email">
                            <label for="email">
                                <i class="fas fa-envelope-open-text me-2"></i>
                                <span>Alamat Email</span>
                            </label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 animate__animated animate__fadeInLeft animate__delay-3s">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Kata Sandi">
                            <label for="password">
                                <i class="fas fa-key me-2"></i>
                                <span>Kata Sandi</span>
                            </label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 animate__animated animate__fadeInRight animate__delay-4s">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Kata Sandi">
                            <label for="password-confirm">
                                <i class="fas fa-lock me-2"></i>
                                <span>Konfirmasi Kata Sandi</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2 animate__animated animate__fadeInUp animate__delay-5s">
                            <button type="submit" class="btn btn-primary btn-lg btn-block position-relative overflow-hidden">
                                <span class="btn-transition">
                                    <i class="fas fa-user-plus me-2"></i>
                                    <span>Daftar Sekarang</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white text-center py-4 animate__animated animate__fadeInUp animate__delay-5s">
                    <p class="mb-0">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary fw-bold">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #6610f2);
    }
    .btn-transition span {
        transition: all 0.3s ease-in-out;
    }
    .btn-transition:hover span {
        transform: translateY(-100%);
    }
    .btn-transition::after {
        content: 'Bergabung Sekarang';
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #0056b3;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
    }
    .btn-transition:hover::after {
        top: 0;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .card {
        border-radius: 1rem;
    }
    .card-header {
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .form-floating label {
        display: flex;
        align-items: center;
    }
    .form-floating label i {
        margin-right: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush

@endsection
