@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: #f4f6f9;
        min-height: 100vh;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        max-width: 450px;
        width: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .login-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .login-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .login-logo i {
        font-size: 36px;
        color: white;
    }

    .login-title {
        font-weight: 700;
        font-size: 24px;
        color: #34395e;
        margin-bottom: 8px;
    }

    .login-subtitle {
        color: #6c757d;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #34395e;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .input-group-custom {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 16px;
        z-index: 10;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #e4e6fc;
        padding: 12px 15px 12px 45px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        outline: none;
    }

    .form-check {
        margin-bottom: 25px;
    }

    .form-check-input {
        margin-top: 0.15rem;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-label {
        color: #6c757d;
        font-size: 14px;
        margin-left: 5px;
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 13px 30px;
        font-size: 15px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .btn-login:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .login-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 14px;
        color: #6c757d;
    }

    .login-footer a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .login-footer a:hover {
        color: #764ba2;
    }

    .alert {
        border-radius: 8px;
        border: none;
        padding: 12px 15px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert i {
        margin-right: 8px;
    }

    .invalid-feedback {
        font-size: 13px;
        margin-top: 5px;
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 30px 25px;
        }

        .login-title {
            font-size: 20px;
        }
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-briefcase"></i>
            </div>
            <h2 class="login-title">APP PEGAWAI</h2>
            <p class="login-subtitle">Sistem Manajemen Kepegawaian</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>{{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                Email atau password salah. Silakan coba lagi.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-group-custom">
                    <i class="fas input-icon"></i>
                    <input id="email" 
                           type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="nama@perusahaan.com"
                           required 
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fas input-icon"></i>
                    <input id="password" 
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" 
                           placeholder="Masukkan password"
                           required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" 
                       type="checkbox" 
                       name="remember" 
                       id="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>

            <div class="login-footer">
                {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                    <br><br>
                @endif --}}
                <!-- Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a> -->
                Belum punya akun? silahkan hubungi Manager.
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto remove invalid class on input
    $('input').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').remove();
    });

    // Form submit loading
    $('#loginForm').on('submit', function() {
        const btn = $('.btn-login');
        btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...').prop('disabled', true);
    });
});
</script>
@endpush
@endsection