@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    /* Menggunakan style yang sama dengan Login agar konsisten */
    body {
        background: #f4f6f9;
        min-height: 100vh;
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .auth-card {
        max-width: 500px; /* Sedikit lebih lebar dari login karena form lebih banyak */
        width: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .auth-logo {
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

    .auth-logo i {
        font-size: 36px;
        color: white;
    }

    .auth-title {
        font-weight: 700;
        font-size: 24px;
        color: #34395e;
        margin-bottom: 8px;
    }

    .auth-subtitle {
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
        padding: 12px 15px 12px 45px; /* Padding kiri disesuaikan untuk icon */
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        outline: none;
    }

    .btn-auth {
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

    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-auth:active {
        transform: translateY(0);
    }

    .btn-auth:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .auth-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 14px;
        color: #6c757d;
    }

    .auth-footer a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .auth-footer a:hover {
        color: #764ba2;
    }

    .invalid-feedback {
        font-size: 13px;
        margin-top: 5px;
    }

    @media (max-width: 576px) {
        .auth-card {
            padding: 30px 25px;
        }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="auth-title">Buat Akun Baru</h2>
            <p class="auth-subtitle">Silakan lengkapi data diri Anda</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <div class="input-group-custom">
                    <i class="fas input-icon"></i>
                    <input id="name" 
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Masukkan nama lengkap"
                           required 
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email -->
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
                           required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fas input-icon"></i>
                    <input id="password" 
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" 
                           placeholder="Minimal 8 karakter"
                           required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                <div class="input-group-custom">
                    <i class="fas fa-check-circle input-icon"></i>
                    <input id="password-confirm" 
                           type="password"
                           class="form-control" 
                           name="password_confirmation" 
                           placeholder="Ulangi password"
                           required>
                </div>
            </div>

            <button type="submit" class="btn btn-auth mt-2">
                <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
            </button>

            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto remove invalid class on input change
    $('input').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').remove();
    });

    // Form submit loading state
    $('#registerForm').on('submit', function() {
        const btn = $('.btn-auth');
        btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...').prop('disabled', true);
    });
});
</script>
@endpush
@endsection
