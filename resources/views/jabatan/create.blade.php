@extends('layouts.app')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — SAMA PERSIS DENGAN YANG KAMU SUKA -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-user-tie mr-2"></i>
                        Tambah Jabatan Baru
                    </h4>
                    <small class="opacity-90">Isi nama jabatan dan gaji pokok</small>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- FORM CARD — LEBAR SAMA PERSIS DENGAN HERO -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">
                <form action="{{ route('positions.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-tag text-primary mr-2"></i>Nama Jabatan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_jabatan" 
                                       class="form-control form-control-lg @error('nama_jabatan') is-invalid @enderror"
                                       value="{{ old('nama_jabatan') }}" 
                                       placeholder="Contoh: Staff IT, HR Manager, Direktur" 
                                       required>
                                @error('nama_jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-money-bill-wave text-success mr-2"></i>Gaji Pokok (Rp)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="gaji_pokok" 
                                       class="form-control form-control-lg @error('gaji_pokok') is-invalid @enderror"
                                       value="{{ old('gaji_pokok') }}" 
                                       placeholder="5000000" 
                                       min="0" step="1000" required>
                                @error('gaji_pokok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="text-center mt-5">
                        <a href="{{ route('positions.index') }}" 
                           class="btn btn-secondary btn-lg px-5 mr-3" 
                           style="border-radius: 12px;">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" 
                                class="btn btn-primary btn-lg px-5" 
                                style="border-radius: 12px; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                            <i class="fas fa-save mr-2"></i>Simpan Jabatan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>


@endsection