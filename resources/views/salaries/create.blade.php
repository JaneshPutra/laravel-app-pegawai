@extends('layouts.app')

@section('title', 'Tambah Gaji Bulanan')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — FULL WIDTH, GRADIENT BIRU-UNGU -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        Tambah Gaji Bulanan
                    </h4>
                    <small class="opacity-90">Input gaji pegawai untuk periode tertentu</small>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- FORM CARD — LEBAR 100% SAMA PERSIS DENGAN HERO -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">

                <form action="{{ route('salaries.store') }}" method="POST" id="salaryForm">
                    @csrf

                    <!-- SECTION: INFORMASI PEGAWAI & PERIODE -->
                    <div class="mb-5">
                        <h5 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-users mr-2"></i>Informasi Pegawai & Periode
                        </h5>
                        <hr class="mt-0" style="border-top: 2px solid #667eea;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Pegawai <span class="text-danger">*</span></label>
                                    <select name="employee_id" id="employee_id" 
                                            class="form-control form-control-lg @error('employee_id') is-invalid @enderror" 
                                            onchange="setGajiPokok()" required>
                                        <option value="">-- Pilih Pegawai --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                    data-gaji="{{ $employee->jabatan->gaji_pokok ?? 0 }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->nama_lengkap }} - {{ $employee->jabatan->nama_jabatan ?? 'Tanpa Jabatan' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Periode Gaji <span class="text-danger">*</span></label>
                                    <input type="month" name="periode" 
                                           class="form-control form-control-lg @error('periode') is-invalid @enderror"
                                           value="{{ old('periode') }}" required>
                                    @error('periode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: KOMPONEN GAJI -->
                    <div class="mb-5">
                        <h5 class="text-success font-weight-bold mb-3">
                            <i class="fas fa-coins mr-2"></i>Komponen Gaji
                        </h5>
                        <hr class="mt-0" style="border-top: 2px solid #28a745;">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Gaji Pokok (Otomatis)</label>
                                    <input type="number" name="gaji_pokok" id="gaji_pokok"
                                           class="form-control form-control-lg bg-light" 
                                           value="{{ old('gaji_pokok') }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tunjangan</label>
                                    <input type="number" name="tunjangan" 
                                           class="form-control form-control-lg @error('tunjangan') is-invalid @enderror"
                                           value="{{ old('tunjangan', 0) }}" min="0" placeholder="0">
                                    @error('tunjangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Potongan</label>
                                    <input type="number" name="potongan" 
                                           class="form-control form-control-lg @error('potongan') is-invalid @enderror"
                                           value="{{ old('potongan', 0) }}" min="0" placeholder="0">
                                    @error('potongan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="text-center mt-5">
                        <a href="{{ route('salaries.index') }}" 
                           class="btn btn-secondary btn-lg px-5 mr-3" 
                           style="border-radius: 12px;">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" 
                                class="btn btn-primary btn-lg px-5"
                                style="border-radius: 12px; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                            <i class="fas fa-save mr-2"></i>Simpan Gaji Bulanan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>



@push('scripts')
<script>
    function setGajiPokok() {
        const select = document.getElementById('employee_id');
        const selectedOption = select.options[select.selectedIndex];
        const gaji = selectedOption ? (selectedOption.getAttribute('data-gaji') || 0) : 0;
        document.getElementById('gaji_pokok').value = gaji;
    }

    $(document).ready(function() {
        // Trigger saat halaman load (jika ada old value)
        if ($('#employee_id').val()) {
            setGajiPokok();
        }

        // Validasi sebelum submit
        $('#salaryForm').on('submit', function(e) {
            let valid = true;
            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).addClass('is-invalid');
                }
            });

            if (!valid) {
                e.preventDefault();
                iziToast.error({
                    title: 'Error',
                    message: 'Mohon lengkapi semua field yang wajib diisi!',
                    position: 'topRight'
                });
            }
        });

        // Hapus invalid saat user isi
        $('input, select').on('input change', function() {
            if ($(this).val()) $(this).removeClass('is-invalid');
        });
    });
</script>
@endpush
@endsection