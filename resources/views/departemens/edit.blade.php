@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — SAMA SEPERTI YANG KAMU SUKA -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-building mr-2"></i>
                        Edit Departemen
                    </h4>
                    <small class="opacity-90">Perbarui nama departemen dengan benar</small>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- FORM CARD — LEBAR SAMA PERSIS DENGAN HERO -->
        <div class="card mb-4" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">
                <form action="{{ route('departemens.update', $departemen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold">
                            <i class="fas fa-tag text-primary mr-2"></i>Nama Departemen
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama_departemen" 
                               class="form-control form-control-lg @error('nama_departemen') is-invalid @enderror" 
                               value="{{ old('nama_departemen', $departemen->nama_departemen) }}" 
                               placeholder="Contoh: IT, HRD, Marketing" 
                               required>
                        @error('nama_departemen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-success btn-lg px-5" 
                                style="border-radius: 12px; box-shadow: 0 4px 15px rgba(40,167,69,0.4);">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Update Departemen
                        </button>
                        <a href="{{ route('departemens.index') }}" class="btn btn-secondary btn-lg px-5 ml-3" 
                           style="border-radius: 12px;">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection