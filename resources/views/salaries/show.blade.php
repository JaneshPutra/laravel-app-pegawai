@extends('layouts.app')

@section('title', 'Detail Gaji - ' . $salary->employee->nama_lengkap)

@section('content')
<div class="main-content">
    <section class="section">
        <!-- Header + Tombol Kembali -->
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('salaries.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Gaji Bulanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('salaries.index') }}">Data Gaji</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Header Card Gradient -->
                        <div class="card-header text-white d-flex align-items-center" 
                             style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px 12px 0 0;">
                            <div>
                                <h4 class="mb-1">
                                    <i class="fas fa-user-tie mr-2"></i>
                                    {{ $salary->employee->nama_lengkap }}
                                </h4>
                                <small class="opacity-90">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ \Carbon\Carbon::parse($salary->periode)->format('F Y') }}
                                </small>
                            </div>
                            <div class="ml-auto text-right">
                                <div class="badge badge-light badge-lg">
                                    ID: EMP{{ str_pad($salary->employee->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-4">
                            <div class="row">
                                <!-- Kolom Kiri: Informasi Pegawai -->
                                <div class="col-md-5">
                                    <div class="d-flex align-items-center mb-4">
                                        @php
                                            $initials = collect(explode(' ', $salary->employee->nama_lengkap))
                                                ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                                ->take(2)
                                                ->join('');
                                            $colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0'];
                                            $color = $colors[array_rand($colors)];
                                        @endphp
                                        <div class="avatar mr-3" style="background: {{ $color }}; width: 60px; height: 60px; font-size: 22px;">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <h5 class="mb-0">{{ $salary->employee->nama_lengkap }}</h5>
                                            <small class="text-muted">
                                                {{ $salary->employee->jabatan->nama_jabatan ?? '-' }}
                                            </small>
                                        </div>
                                    </div>

                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td width="40%" class="text-muted">Departemen</td>
                                            <td>: {{ $salary->employee->departemen->nama_departemen ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Periode Gaji</td>
                                            <td>: <strong>{{ \Carbon\Carbon::parse($salary->periode)->format('F Y') }}</strong></td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Kolom Kanan: Ringkasan Gaji -->
                                <div class="col-md-7">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded">
                                                <small class="text-muted d-block">Gaji Pokok</small>
                                                <h5 class="mb-0 text-success">Rp{{ number_format($salary->gaji_pokok) }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded">
                                                <small class="text-muted d-block">Tunjangan</small>
                                                <h5 class="mb-0 text-info">Rp{{ number_format($salary->tunjangan) }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded">
                                                <small class="text-muted d-block">Potongan</small>
                                                <h5 class="mb-0 text-danger">-Rp{{ number_format($salary->potongan) }}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Gaji Highlight -->
                                    <div class="mt-4 p-4 text-center text-white rounded" 
                                         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <small class="d-block opacity-90">Total Gaji Bersih</small>
                                        <h2 class="mb-0 font-weight-bold">
                                            Rp{{ number_format($salary->total_gaji) }}
                                        </h2>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Tombol Aksi -->
                            <div class="text-right">
                                <a href="{{ route('salaries.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>
                                <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-lg text-white">
                                    <i class="fas fa-edit mr-2"></i>Edit Gaji
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .avatar {
        width: 60px; height: 60px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        color: white; font-weight: bold; font-size: 22px;
    }
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: none;
    }
    .card-header {
        padding: 20px 25px;
    }
    .section-header-back .btn {
        width: 40px; height: 40px; border-radius: 50%;
        background: white; border: 1px solid #e4e6fc;
        display: flex; align-items: center; justify-content: center;
    }
    .section-header-back .btn:hover {
        background: #667eea; color: white; border-color: #667eea;
    }
    .btn {
        border-radius: 10px; font-weight: 600; padding: 10px 28px;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }
    .bg-light {
        background-color: #f8f9fc !important;
    }
</style>
@endsection