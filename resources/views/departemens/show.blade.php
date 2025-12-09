@extends('layouts.app')

@section('title', 'Detail Departemen - ' . $departemen->nama_departemen)

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HERO CARD — SUDAH 100% AMAN & CANTIK -->
        <div class="card mb-4" style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
            <div class="card-header text-white py-5 position-relative hero-gradient">
                <div class="container-fluid px-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="mb-2 font-weight-bold">
                                <i class="fas fa-building mr-3"></i>
                                {{ $departemen->nama_departemen }}
                            </h2>
                            <p class="mb-0 h5 opacity-90">
                                <i class="fas fa-users mr-2"></i>
                                <strong>{{ $activeEmployees->count() }}</strong> Pegawai Aktif
                                @if(isset($totalEmployees) && $totalEmployees > $activeEmployees->count())
                                    <span class="mx-3">•</span>
                                    <strong>{{ $totalEmployees - $activeEmployees->count() }}</strong> Non-Aktif
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-right">
                            <div class="h5 mb-1">{{ now()->translatedFormat('l, d F Y') }}</div>
                            <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD DAFTAR PEGAWAI -->
        <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
            <div class="card-body p-5">

                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h4 class="text-primary font-weight-bold mb-0">
                        <i class="fas fa-user-check mr-3"></i>Daftar Pegawai Aktif
                    </h4>
                    <div class="badge badge-success badge-pill px-4 py-3" style="font-size: 1.1rem;">
                        Total: {{ $activeEmployees->count() }} orang
                    </div>
                </div>

                @if ($activeEmployees->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-5x text-muted mb-4 opacity-50"></i>
                        <p class="text-muted h5 mb-0">Belum ada pegawai aktif di departemen ini.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th width="6%" class="text-center">No</th>
                                    <th width="12%">Avatar</th>
                                    <th>Pegawai</th>
                                    <th>Jabatan</th>
                                    <th width="18%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeEmployees as $i => $pegawai)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="avatar avatar-md text-white d-flex align-items-center justify-content-center"
                                                 style="background: linear-gradient(135deg, #667eea, #764ba2); width: 48px; height: 48px; border-radius: 50%; font-weight: bold; font-size: 1.1rem;">
                                                {{ Str::substr($pegawai->nama_lengkap, 0, 2) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-weight-600">{{ $pegawai->nama_lengkap }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope mr-1"></i>{{ $pegawai->email }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info px-3 py-2">
                                                {{ $pegawai->jabatan->nama_jabatan ?? 'Tidak Ada Jabatan' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('employees.show', $pegawai->id) }}"
                                               class="btn btn-info btn-sm px-4"
                                               style="border-radius: 10px;">
                                                <i class="fas fa-eye mr-1"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- TOMBOL KEMBALI -->
                <div class="mt-5 pt-4 border-top text-center">
                    <a href="{{ route('departemen.index') }}"
                       class="btn btn-secondary btn-lg px-5"
                       style="border-radius: 12px;">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar Departemen
                    </a>
                </div>

            </div>
        </div>

    </section>
</div>
@endsection