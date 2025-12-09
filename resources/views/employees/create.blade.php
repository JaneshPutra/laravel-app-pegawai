@extends('layouts.app')

@section('title', 'Tambah Pegawai Baru')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — SAMA PERSIS DENGAN SEMUA FORM YANG KAMU SUKA -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus mr-2"></i>
                        Tambah Pegawai Baru
                    </h4>
                    <small class="opacity-90">Lengkapi semua data pegawai dengan benar</small>
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
                <form action="{{ route('employees.store') }}" method="POST" id="employeeForm">
                    @csrf

                    <!-- SECTION: DATA PRIBADI -->
                    <div class="mb-5">
                        <h5 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-user-circle mr-2"></i>Data Pribadi
                        </h5>
                        <hr class="mt-0" style="border-top: 2px solid #667eea;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" 
                                           class="form-control form-control-lg @error('nama_lengkap') is-invalid @enderror"
                                           value="{{ old('nama_lengkap') }}" 
                                           placeholder="Masukkan nama lengkap" required>
                                    @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" 
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" 
                                           placeholder="contoh@email.com" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_telepon" 
                                           class="form-control form-control-lg @error('nomor_telepon') is-invalid @enderror"
                                           value="{{ old('nomor_telepon') }}" 
                                           placeholder="08xxxxxxxxxx" required>
                                    @error('nomor_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" 
                                           class="form-control form-control-lg @error('tanggal_lahir') is-invalid @enderror"
                                           value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="4" 
                                      class="form-control form-control-lg @error('alamat') is-invalid @enderror"
                                      placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- SECTION: DATA PEKERJAAN -->
                    <div class="mb-5">
                        <h5 class="text-success font-weight-bold mb-3">
                            <i class="fas fa-briefcase mr-2"></i>Data Pekerjaan
                        </h5>
                        <hr class="mt-0" style="border-top: 2px solid #28a745;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Departemen <span class="text-danger">*</span></label>
                                    <select name="departemen_id" class="form-control form-control-lg @error('departemen_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Departemen --</option>
                                        @foreach($departemens as $departemen)
                                            <option value="{{ $departemen->id }}" {{ old('departemen_id') == $departemen->id ? 'selected' : '' }}>
                                                {{ $departemen->nama_departemen }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('departemen_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Jabatan <span class="text-danger">*</span></label>
                                    <select name="jabatan_id" class="form-control form-control-lg @error('jabatan_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jabatan --</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('jabatan_id') == $position->id ? 'selected' : '' }}>
                                                {{ $position->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jabatan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tanggal Masuk <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_masuk" 
                                           class="form-control form-control-lg @error('tanggal_masuk') is-invalid @enderror"
                                           value="{{ old('tanggal_masuk') }}" required>
                                    @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control form-control-lg @error('status') is-invalid @enderror" required>
                                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="text-center mt-5">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-lg px-5 mr-3" style="border-radius: 12px;">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5" 
                                style="border-radius: 12px; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                            <i class="fas fa-save mr-2"></i>Simpan Data Pegawai
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>


@push('scripts')
<script>
$(document).ready(function() {
    $('#employeeForm').on('submit', function(e) {
        let isValid = true;
        $(this).find('[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            iziToast.error({
                title: 'Error',
                message: 'Mohon lengkapi semua field yang wajib diisi!',
                position: 'topRight'
            });
        }
    });

    $('input, select, textarea').on('input change', function() {
        if ($(this).val() !== '') $(this).removeClass('is-invalid');
    });

    // Format nomor telepon hanya angka
    $('input[name="nomor_telepon"]').on('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    // Batas tanggal lahir (minimal 17 tahun)
    let maxBirth = new Date();
    maxBirth.setFullYear(maxBirth.getFullYear() - 17);
    $('input[name="tanggal_lahir"]').attr('max', maxBirth.toISOString().split('T')[0]);

    // Batas tanggal masuk (tidak boleh masa depan)
    let today = new Date().toISOString().split('T')[0];
    $('input[name="tanggal_masuk"]').attr('max', today);
});
</script>
@endpush
@endsection