@extends('layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — FULL WIDTH, GRADIENT BIRU-UNGU -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-user-cog mr-2"></i>
                        Edit Profil Saya
                    </h4>
                    <small class="opacity-90">Perbarui informasi akun Anda</small>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- FORM CARD — LEBAR 100% SAMA DENGAN HERO -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row justify-content-center">
                        <div class="col-lg-7 col-md-9">

                            <!-- Nama Lengkap -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-user text-primary mr-2"></i>Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name) }}" 
                                       placeholder="Masukkan nama lengkap" 
                                       autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-envelope text-info mr-2"></i>Alamat Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email) }}" 
                                       placeholder="contoh@email.com" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tambahan opsional nanti bisa ditambah: no HP, foto profil, dll -->
                            <!-- Contoh kalau mau tambah nomor HP:
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-phone text-success mr-2"></i>Nomor Telepon
                                </label>
                                <input type="text" name="phone" 
                                       class="form-control form-control-lg"
                                       value="{{ old('phone', $user->phone ?? '') }}" 
                                       placeholder="08xxxxxxxxxx">
                            </div>
                            -->

                            <!-- TOMBOL -->
                            <div class="text-center mt-5">
                                <button type="submit" 
                                        class="btn btn-success btn-lg px-5"
                                        style="border-radius: 12px; box-shadow: 0 4px 15px rgba(40,167,69,0.4);">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Perubahan
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