@extends('layouts.app')

@section('title', 'Absensi Pegawai')

@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1><i class="fas fa-calendar-check"></i> Absensi Pegawai</h1>
        <div class="section-header-button">
            <form action="{{ route('attendances.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="date" name="date" id="date" class="form-control"
                           value="{{ $date }}" onchange="this.form.submit()"
                           style="border-radius: 0 8px 8px 0; border-left: none;">
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-users" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Total Pegawai</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $rekap['hadir'] + $rekap['izin'] + $rekap['belum_absen'] }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-user-check" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Hadir</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $rekap['hadir'] }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                            Pegawai
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-user-clock" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Izin</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $rekap['izin'] }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                            Pegawai
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-user-times" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Belum Absen</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $rekap['belum_absen'] }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                            Pegawai
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <!-- Tab Navigation -->
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="hadir-tab" data-toggle="tab" href="#hadir" role="tab">
                            <i class="fas fa-user-check mr-2"></i>Pegawai Hadir ({{ $rekap['hadir'] }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="izin-tab" data-toggle="tab" href="#izin" role="tab">
                            <i class="fas fa-user-clock mr-2"></i>Pegawai Izin ({{ $rekap['izin'] }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="belum-tab" data-toggle="tab" href="#belum" role="tab">
                            <i class="fas fa-user-times mr-2"></i>Belum Absen ({{ $rekap['belum_absen'] }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Tab Hadir -->
                    <div class="tab-pane fade show active" id="hadir" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Nama Pegawai</th>
                                        <th width="20%">Departemen</th>
                                        <th width="20%">Jabatan</th>
                                        <th width="12%" class="text-center">Jam Masuk</th>
                                        <th width="12%" class="text-center">Jam Keluar</th>
                                        <th width="10%" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($attendances as $index => $attendance)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0'];
                                                        $randomColor = $colors[array_rand($colors)];
                                                        $initials = collect(explode(' ', $attendance->employee->nama_lengkap))
                                                            ->map(fn($word) => strtoupper($word[0]))
                                                            ->take(2)
                                                            ->join('');
                                                    @endphp
                                                    <div class="avatar bg-primary text-white mr-2" style="background: {{ $randomColor }} !important;">
                                                        {{ $initials }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $attendance->employee->nama_lengkap }}</div>
                                                        <div class="text-small text-muted">ID: EMP{{ str_pad($attendance->employee->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $attendance->employee->departemen->nama_departemen ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $attendance->employee->jabatan->nama_jabatan ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-success" style="font-size: 13px; padding: 8px 12px;">
                                                    <i class="fas fa-sign-in-alt mr-1"></i>
                                                    {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '-' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($attendance->clock_out)
                                                    <span class="badge badge-danger" style="font-size: 13px; padding: 8px 12px;">
                                                        <i class="fas fa-sign-out-alt mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning text-white" style="font-size: 13px; padding: 8px 12px;">
                                                        <i class="fas fa-hourglass-half mr-1"></i> Belum
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-success" style="font-size: 12px; padding: 6px 12px;">
                                                    <i class="fas fa-check-circle mr-1"></i> Hadir
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                                <p class="text-muted">Tidak ada pegawai hadir pada tanggal ini</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Izin -->
                    <div class="tab-pane fade" id="izin" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Nama Pegawai</th>
                                        <th width="15%">Departemen</th>
                                        <th width="15%">Jabatan</th>
                                        <th width="12%">Jenis Izin</th>
                                        <th width="23%">Alasan</th>
                                        <th width="10%" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($leaves as $index => $leave)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0'];
                                                        $randomColor = $colors[array_rand($colors)];
                                                        $initials = collect(explode(' ', $leave->employee->nama_lengkap))
                                                            ->map(fn($word) => strtoupper($word[0]))
                                                            ->take(2)
                                                            ->join('');
                                                    @endphp
                                                    <div class="avatar bg-primary text-white mr-2" style="background: {{ $randomColor }} !important;">
                                                        {{ $initials }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $leave->employee->nama_lengkap }}</div>
                                                        <div class="text-small text-muted">ID: EMP{{ str_pad($leave->employee->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $leave->employee->departemen->nama_departemen ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $leave->employee->jabatan->nama_jabatan ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($leave->type == 'sakit')
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-hospital mr-1"></i> Sakit
                                                    </span>
                                                @elseif($leave->type == 'cuti')
                                                    <span class="badge badge-info">
                                                        <i class="fas fa-plane mr-1"></i> Cuti
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        <i class="fas fa-clipboard mr-1"></i> {{ ucfirst($leave->type) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ Str::limit($leave->reason ?? '-', 50) }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-success" style="font-size: 12px; padding: 6px 12px;">
                                                    <i class="fas fa-check-circle mr-1"></i> Disetujui
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fas fa-user-slash fa-3x text-muted mb-3 d-block"></i>
                                                <p class="text-muted">Tidak ada pegawai izin pada tanggal ini</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Belum Absen -->
                    <div class="tab-pane fade" id="belum" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="35%">Nama Pegawai</th>
                                        <th width="25%">Departemen</th>
                                        <th width="25%">Jabatan</th>
                                        <th width="10%" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notYetAttendances as $index => $employee)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0'];
                                                        $randomColor = $colors[array_rand($colors)];
                                                        $initials = collect(explode(' ', $employee->nama_lengkap))
                                                            ->map(fn($word) => strtoupper($word[0]))
                                                            ->take(2)
                                                            ->join('');
                                                    @endphp
                                                    <div class="avatar bg-primary text-white mr-2" style="background: {{ $randomColor }} !important;">
                                                        {{ $initials }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $employee->nama_lengkap }}</div>
                                                        <div class="text-small text-muted">ID: EMP{{ str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $employee->departemen->nama_departemen ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $employee->jabatan->nama_jabatan ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-warning text-white" style="font-size: 12px; padding: 6px 12px;">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> Alpha
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <i class="fas fa-check-double fa-3x text-success mb-3 d-block"></i>
                                                <p class="text-muted">Semua pegawai sudah absen atau izin</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<style>
    
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Set max date to today
    let today = new Date().toISOString().split('T')[0];
    $('#date').attr('max', today);
    
    // Smooth scroll on tab change
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('html, body').animate({
            scrollTop: $('.section-body').offset().top - 100
        }, 300);
    });
});
</script>
@endpush