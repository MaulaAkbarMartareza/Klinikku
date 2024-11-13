@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-success text-white text-center py-4">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="mb-3 animate__animated animate__pulse animate__infinite" style="max-width: 150px;">
                    <h2 class="font-weight-bold mb-2 animate__animated animate__fadeInDown">Selamat Datang di Klinik Akbar</h2>
                    <p class="text-white-50 mb-0 animate__animated animate__fadeInUp animate__delay-1s">Sila-kan masuk untuk melanjutkan</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-floating mb-4 animate__animated animate__fadeInLeft animate__delay-1s">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Nama Pengguna">
                            <label for="username">
                                <i class="fas fa-user me-2"></i>
                                <span>Nama Pengguna</span>
                            </label>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 animate__animated animate__fadeInRight animate__delay-2s">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                            <label for="password">
                                <i class="fas fa-lock me-2"></i>
                                <span>Kata Sandi</span>
                            </label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-4 animate__animated animate__fadeInUp animate__delay-3s">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                <i class="fas fa-check-square me-2"></i>
                                <span>Ingat Saya</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2 animate__animated animate__fadeInUp animate__delay-4s">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span>Masuk</span>
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none text-success" href="{{ route('password.request') }}">
                                    <i class="fas fa-question-circle me-2"></i>
                                    <span>Lupa Kata Sandi?</span>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                
                <div class="card-footer text-center py-3 bg-light">
                    <div class="small animate__animated animate__fadeInUp animate__delay-5s">
                        <i class="fas fa-user-plus me-2"></i>
                        <span>Belum memiliki akun? <a href="{{ route('register') }}" class="text-success">Daftar sekarang</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    background-attachment: fixed;
}

.card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    color: #28a745;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
}

.btn-success {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    background: linear-gradient(135deg, #20c997, #28a745);
}

.form-floating label {
    padding-left: 40px;
    display: flex;
    align-items: center;
}

.form-floating .form-control {
    padding-left: 40px;
}

.form-floating i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #6c757d;
}

@media (max-width: 768px) {
    .card {
        margin: 20px;
    }
}

.animate__animated {
    animation-duration: 1s;
}

.animate__delay-1s {
    animation-delay: 0.2s;
}

.animate__delay-2s {
    animation-delay: 0.4s;
}

.animate__delay-3s {
    animation-delay: 0.6s;
}

.animate__delay-4s {
    animation-delay: 0.8s;
}

.animate__delay-5s {
    animation-delay: 1s;
}
</style>
@endsection
