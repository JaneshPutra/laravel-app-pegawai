@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — FULL WIDTH -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-key mr-2"></i>
                        Ganti Password
                    </h4>
                    <small class="opacity-90">Pastikan password baru kuat dan tidak mudah ditebak</small>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- FORM CARD — SEKARANG 100% SAMA LEBAR DENGAN HERO (NO COL, NO ROW, FULL WIDTH!) -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Terdapat kesalahan pada input Anda.
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">

                            <!-- Password Sekarang -->
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-lock text-warning mr-2"></i>Password Sekarang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="current_password" 
                                       class="form-control form-control-lg @error('current_password') is-invalid @enderror"
                                       placeholder="Masukkan password lama" required autocomplete="current-password">
                                @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Password Baru -->
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-lock-open text-primary mr-2"></i>Password Baru
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="new_password" 
                                       class="form-control form-control-lg @error('new_password') is-invalid @enderror"
                                       placeholder="Minimal 8 karakter" required autocomplete="new-password">
                                @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-redo-alt text-success mr-2"></i>Konfirmasi Password Baru
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="new_password_confirmation" 
                                       class="form-control form-control-lg"
                                       placeholder="Ketik ulang password baru" required autocomplete="new-password">
                            </div>

                            <!-- TOMBOL -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-success btn-lg px-5"
                                        style="border-radius: 12px; box-shadow: 0 4px 15px rgba(40,167,69,0.4);">
                                    <i class="fas fa-sync-alt mr-2"></i>Update Password
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg px-5 ml-3"
                                   style="border-radius: 12px;">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>


@endsection