@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4"
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus mr-2"></i>
                        Tambah User Baru
                    </h4>
                    <small class="opacity-90">Buat akun baru untuk admin atau pegawai</small>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- FORM CARD — LEBAR SAMA DENGAN HERO -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" style="border-radius: 12px;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 mb-0 pl-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-md-8 mx-auto">

                            <!-- Nama Lengkap -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-user text-primary mr-2"></i>Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Masukkan nama lengkap"
                                       required autofocus>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-envelope text-info mr-2"></i>Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="contoh@perusahaan.com"
                                       required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-lock text-warning mr-2"></i>Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       placeholder="Minimal 8 karakter"
                                       required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Role -->
                            <div class="form-group mb-5">
                                <label class="font-weight-bold">
                                    <i class="fas fa-user-shield text-success mr-2"></i>Role / Hak Akses
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="role" class="form-control form-control-lg @error('role') is-invalid @enderror" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                </select>
                                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- TOMBOL -->
                            <div class="text-center">
                                <a href="{{ route('users.index') }}"
                                   class="btn btn-secondary btn-lg px-5 mr-3"
                                   style="border-radius: 12px;">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>
                                <button type="submit"
                                        class="btn btn-primary btn-lg px-5"
                                        style="border-radius: 12px; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                                    <i class="fas fa-save mr-2"></i>Simpan User
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>


@endsection