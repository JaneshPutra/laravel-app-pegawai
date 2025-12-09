@extends('layouts.app')

@section('title', 'Pengajuan Izin / Cuti')

@section('content')
    <div class="main-content">
        <section class="section">

            <!-- HERO CARD — FULL WIDTH -->
            <div class="card mb-4"
                style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
                <div class="card-header text-white d-flex align-items-center py-4"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Pengajuan Izin / Cuti
                        </h4>
                        <small class="opacity-90">Ajukan izin atau cuti dengan mudah</small>
                    </div>
                    <div class="ml-auto text-right">
                        <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                        <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                    </div>
                </div>
            </div>

            <!-- FORM CARD — SUDAH 100% SAMA LEBAR DENGAN HERO -->
            <div class="card mb-4" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                <div class="card-body p-5">
                    <form action="{{ route('leaves.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">
                                        <i class="fas fa-calendar-alt text-primary mr-2"></i>Tanggal Mulai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control form-control-lg @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">
                                        <i class="fas fa-calendar-check text-primary mr-2"></i>Tanggal Selesai
                                    </label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control form-control-lg @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}">
                                    <small class="text-muted">Kosongkan jika hanya 1 hari</small>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-tag text-primary mr-2"></i>Jenis Izin / Cuti
                                <span class="text-danger">*</span>
                            </label>
                            <select name="type" id="type"
                                class="form-control form-control-lg @error('type') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="izin" {{ old('type') == 'izin' ? 'selected' : '' }}>Izin Harian</option>
                                <option value="cuti" {{ old('type') == 'cuti' ? 'selected' : '' }}>Cuti Tahunan</option>
                                <option value="sakit" {{ old('type') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="lainnya" {{ old('type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-edit text-primary mr-2"></i>Alasan
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="reason" id="reason" rows="5"
                                class="form-control form-control-lg @error('reason') is-invalid @enderror"
                                placeholder="Jelaskan alasan izin/cuti Anda..." required>{{ old('reason') }}</textarea>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-paperclip text-primary mr-2"></i>Lampiran (Opsional)
                            </label>
                            <div class="custom-file">
                                <input type="file" name="attachment" id="attachment"
                                    class="custom-file-input @error('attachment') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.pdf">
                                <label class="custom-file-label" for="attachment">Pilih file (JPG, PNG, PDF - maks
                                    2MB)</label>
                            </div>
                            @error('attachment')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5"
                                style="border-radius: 12px; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Sekarang
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg px-5 ml-3"
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