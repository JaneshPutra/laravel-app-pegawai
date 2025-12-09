@extends('layouts.app')

@section('title', 'Daftar Gaji Bulanan')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-users"></i> Data Salary</h1>
                <div>
                    <a href="{{ route('salaries.create') }}" class="btn btn-lg"
                        style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); color: white; border: none;">
                        <i class="fas fa-plus"></i> Tambah Salary
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-wallet" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Total Gaji Tahun Ini</h4>
                            </div>
                            <div class="card-body" style="font-size: 28px; font-weight: bold; color: white;">
                                Rp{{ number_format($totalGajiTahunIni) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-users" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Jumlah Pegawai</h4>
                            </div>
                            <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                                {{ $salaries->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-calculator" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Rata-rata Gaji</h4>
                            </div>
                            <div class="card-body" style="font-size: 28px; font-weight: bold; color: white;">
                                Rp{{ $salaries->count() > 0 ? number_format($totalGaji / $salaries->count()) : 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-gift" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Tunjangan Terbesar</h4>
                            </div>
                            <div class="card-body" style="font-size: 28px; font-weight: bold; color: white;">
                                Rp{{ number_format($salaries->max('tunjangan')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel dalam Card -->
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-table mr-2"></i>Daftar Gaji Bulanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Periode</th>
                                        <th>Gaji Pokok</th>
                                        <th>Tunjangan</th>
                                        <th>Potongan</th>
                                        <th>Total Gaji</th>
                                        <th width="12%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($salaries as $index => $salary)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0'];
                                                        $randomColor = $colors[array_rand($colors)];
                                                        $initials = collect(explode(' ', $salary->employee->nama_lengkap))
                                                            ->map(fn($word) => strtoupper($word[0] ?? ''))
                                                            ->take(2)
                                                            ->join('');
                                                    @endphp
                                                    <div class="avatar mr-3" style="background: {{ $randomColor }} !important;">
                                                        {{ $initials }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $salary->employee->nama_lengkap }}
                                                        </div>
                                                        <small class="text-muted">ID:
                                                            EMP{{ str_pad($salary->employee->id, 4, '0', STR_PAD_LEFT) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $salary->employee->jabatan->nama_jabatan ?? '-' }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($salary->periode)->format('F Y') }}</td>
                                            <td>Rp{{ number_format($salary->gaji_pokok) }}</td>
                                            <td>Rp{{ number_format($salary->tunjangan) }}</td>
                                            <td>Rp{{ number_format($salary->potongan) }}</td>
                                            <td><strong class="text-success">Rp{{ number_format($salary->total_gaji) }}</strong>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('salaries.show', $salary->id) }}">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('salaries.edit', $salary->id) }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('salaries.destroy', $salary->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin hapus data gaji ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                                <p class="text-muted">Belum ada data gaji untuk periode ini</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Optional: auto hide alert after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush