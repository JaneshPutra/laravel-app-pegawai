@extends('layouts.app')

@section('title', 'Edit Gaji Bulanan')

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — FULL WIDTH -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div>
                    <h4 class="mb-0">
                        <i class="fas fa-money-check-edit mr-2"></i>
                        Edit Gaji Bulanan
                    </h4>
                    <small class="opacity-90">Perbarui tunjangan, potongan, dan periode gaji</small>
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

                <form action="{{ route('salaries.update', $salary->id) }}" method="POST" id="editSalaryForm">
                    @csrf
                    @method('PUT')

                    <!-- HIDDEN INPUT WAJIB (ini yang bikin update berhasil!) -->
                    <input type="hidden" name="employee_id" value="{{ $salary->employee_id }}">
                    <input type="hidden" name="gaji_pokok" value="{{ $salary->gaji_pokok }}">

                    <!-- SECTION: INFORMASI PEGAWAI & PERIODE -->
                    <div class="mb-5">
                        <h5 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-user-tie mr-2"></i>Informasi Pegawai & Periode
                        </h5>
                        <hr class="mt-0" style="border-top: 2px solid #667eea;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Pegawai</label>
                                    <input type="text" class="form-control form-control-lg bg-light" 
                                           value="{{ $salary->employee->nama_lengkap }} - {{ $salary->employee->jabatan->nama_jabatan ?? 'Tanpa Jabatan' }}" 
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Periode Gaji <span class="text-danger">*</span></label>
                                    <input type="month" name="periode" 
                                           class="form-control form-control-lg @error('periode') is-invalid @enderror"
                                           value="{{ old('periode', \Carbon\Carbon::parse($salary->periode)->format('Y-m')) }}" 
                                           required>
                                    @error('periode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Gaji Pokok</label>
                                    <input type="text" class="form-control form-control-lg bg-light" 
                                           value="Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: KOMPONEN GAJI -->
                    <div class="mb-5">
                        <h5 class="text-success font-weight-bold mb-3">
                            <i class="fas fa-coins mr-2"></i>Komponen Gaji yang Dapat Diubah
                        </h5>
                        <hr class="mt-0" style="border-top: 2px solid #28a745;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tunjangan</label>
                                    <input type="number" name="tunjangan" 
                                           class="form-control form-control-lg @error('tunjangan') is-invalid @enderror"
                                           value="{{ old('tunjangan', $salary->tunjangan) }}" 
                                           min="0" placeholder="0">
                                    @error('tunjangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Potongan</label>
                                    <input type="number" name="potongan" 
                                           class="form-control form-control-lg @error('potongan') is-invalid @enderror"
                                           value="{{ old('potongan', $salary->potongan) }}" 
                                           min="0" placeholder="0">
                                    @error('potongan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- TOTAL GAJI REAL-TIME -->
                        <div class="mt-4">
                            <div class="alert text-center py-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                                <h5 class="mb-0">
                                    <i class="fas fa-calculator mr-2"></i>
                                    Total Gaji Bersih: 
                                    <strong id="totalGaji">
                                        Rp {{ number_format(($salary->gaji_pokok + $salary->tunjangan) - $salary->potongan, 0, ',', '.') }}
                                    </strong>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL -->
                    <div class="text-center mt-5">
                        <a href="{{ route('salaries.index') }}" 
                           class="btn btn-secondary btn-lg px-5 mr-3" 
                           style="border-radius: 12px;">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" 
                                class="btn btn-success btn-lg px-5"
                                style="border-radius: 12px; box-shadow: 0 4px 15px rgba(40,167,69,0.4);">
                            <i class="fas fa-sync-alt mr-2"></i>Update Gaji
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
        function hitungTotal() {
            const pokok = parseInt($('input[name="gaji_pokok"]').val()) || 0;
            const tunjangan = parseInt($('input[name="tunjangan"]').val()) || 0;
            const potongan = parseInt($('input[name="potongan"]').val()) || 0;
            const total = pokok + tunjangan - potongan;

            $('#totalGaji').text('Rp ' + total.toLocaleString('id-ID'));
        }

        // Update saat input berubah
        $('input[name="tunjangan"], input[name="potongan"]').on('input keyup', hitungTotal);

        // Jalankan sekali saat load
        hitungTotal();
    });
</script>
@endpush
@endsection