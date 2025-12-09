@extends('layouts.app')

@section('title', 'Detail Pegawai - ' . $employee->nama_lengkap)

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white d-flex align-items-center py-4 hero-gradient">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg mr-4 text-white" style="background: rgba(255,255,255,0.2); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold;">
                        {{ Str::substr($employee->nama_lengkap, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="mb-1">{{ $employee->nama_lengkap }}</h3>
                        <p class="mb-0 opacity-90">
                            <i class="fas fa-briefcase mr-2"></i>
                            {{ $employee->jabatan->nama_jabatan ?? '-' }} 
                            <span class="mx-2">•</span>
                            {{ $employee->departemen->nama_departemen ?? '-' }}
                        </p>
                    </div>
                </div>
                <div class="ml-auto text-right">
                    <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                </div>
            </div>
        </div>

        <!-- CARD DETAIL -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">

                <div class="row">
                    <!-- INFORMASI PRIBADI -->
                    <div class="col-lg-6 mb-4">
                        <h5 class="text-primary font-weight-bold mb-4">
                            <i class="fas fa-user-circle mr-2"></i>Informasi Pribadi
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover">
                                <tr>
                                    <th width="35%" class="text-muted">Nama Lengkap</th>
                                    <td class="font-weight-600">{{ $employee->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email</th>
                                    <td>
                                        <a href="mailto:{{ $employee->email }}" class="text-decoration-none">
                                            <i class="fas fa-envelope text-info mr-2"></i>{{ $employee->email }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">No. Telepon</th>
                                    <td>
                                        <i class="fas fa-phone text-success mr-2"></i>
                                        {{ $employee->nomor_telepon ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Tanggal Lahir</th>
                                    <td>
                                        <i class="fas fa-calendar-alt text-warning mr-2"></i>
                                        {{ $employee->tanggal_lahir ? \Carbon\Carbon::parse($employee->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Alamat</th>
                                    <td>{{ $employee->alamat ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- INFORMASI KERJA -->
                    <div class="col-lg-6 mb-4">
                        <h5 class="text-success font-weight-bold mb-4">
                            <i class="fas fa-building mr-2"></i>Informasi Pekerjaan
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover">
                                <tr>
                                    <th width="35%" class="text-muted">Departemen</th>
                                    <td class="font-weight-600">
                                        <span class="badge badge-info badge-pill px-3 py-2">
                                            {{ $employee->departemen->nama_departemen ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Jabatan</th>
                                    <td class="font-weight-600">
                                        <span class="badge badge-primary badge-pill px-3 py-2">
                                            {{ $employee->jabatan->nama_jabatan ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Tanggal Masuk</th>
                                    <td>
                                        <i class="fas fa-calendar-check text-success mr-2"></i>
                                        {{ $employee->tanggal_masuk ? \Carbon\Carbon::parse($employee->tanggal_masuk)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Status</th>
                                    <td>
                                        @if($employee->status == 'aktif')
                                            <span class="badge badge-success badge-pill px-4 py-2 text-uppercase">
                                                <i class="fas fa-check-circle mr-1"></i>Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-danger badge-pill px-4 py-2 text-uppercase">
                                                <i class="fas fa-times-circle mr-1"></i>Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-lg px-5" style="border-radius: 12px;">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>

                    <div class="d-flex gap-3">
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus pegawai {{ $employee->nama_lengkap }}? Data akan hilang permanen!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg px-5" style="border-radius: 12px;">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus Pegawai
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>
@endsection