@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')
    <div class="main-content ">
        <section class="section">
            <div class="section-header">
                <h1><i class="fas fa-tachometer-alt"></i> Dashboard Manager</h1>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-users" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Total Pegawai</h4>
                            </div>
                            <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                                {{ $totalEmployees }}
                            </div>
                            <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                                <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                                    <i class="fas fa-arrow-up"></i> +{{ $employeeGrowth }} bulan ini
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius:15px;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-building" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Departemen</h4>
                            </div>
                            <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                                {{ $totalDepartments }}
                            </div>
                            <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                                <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                                    <i class="fas"></i> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-briefcase" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">Jabatan</h4>
                            </div>
                            <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                                {{ $totalPositions }}
                            </div>
                            <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                                <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                                    <i class="fas"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1"
                        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none;">
                        <div class="card-icon" style="background: transparent;">
                            <i class="fas fa-user-check" style="color: white; font-size: 40px;"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="border: none; padding-bottom: 5px;">
                                <h4 style="color: white; margin-bottom: 0;">User Aktif</h4>
                            </div>
                            <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                                {{ $totalActiveUsers }}
                            </div>
                            <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                                <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                                    <i class="fas"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval Summary -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Status Approval</div>
                        </div>
                        <div class="card-icon shadow-warning bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Menunggu Approval</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingLeaves }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Status Approval</div>
                        </div>
                        <div class="card-icon shadow-success bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Disetujui Hari Ini</h4>
                            </div>
                            <div class="card-body">
                                {{ $approvedToday }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Status Approval</div>
                        </div>
                        <div class="card-icon shadow-danger bg-danger">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Ditolak</h4>
                            </div>
                            <div class="card-body">
                                {{ $rejectedLeaves }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-clipboard-check"></i> Permohonan Izin Menunggu Approval</h4>
                            <div class="card-header-action">
                                {{-- Sesuaikan dengan route leaves yang sudah ada --}}
                                <a href="{{ route('leaves.index') }}" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>Jenis Izin</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pendingLeavesList as $leave)
                                            <tr id="leave-row-{{ $leave->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-primary text-white mr-2">
                                                            {{ strtoupper(substr($leave->employee->nama_lengkap, 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            {{ $leave->employee->nama_lengkap }}
                                                            <div class="text-small text-muted">
                                                                {{ $leave->employee->departemen->nama_departemen ?? '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($leave->leave_type == 'cuti')
                                                        <span class="badge badge-info">Cuti Tahunan</span>
                                                    @elseif($leave->leave_type == 'sakit')
                                                        <span class="badge badge-warning">Izin Sakit</span>
                                                    @elseif($leave->leave_type == 'izin')
                                                        <span class="badge badge-secondary">Izin Pribadi</span>
                                                    @else
                                                        <span class="badge badge-primary">{{ ucfirst($leave->leave_type) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}
                                                    @if($leave->end_date)
                                                        - {{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <td>
                                                    {{-- Gunakan route approve/reject yang sudah ada di LeaveController --}}
                                                    <form action="{{ route('leaves.approve', $leave->id) }}" method="POST"
                                                        class="d-inline approve-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm" title="Setujui">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('leaves.reject', $leave->id) }}" method="POST"
                                                        class="d-inline reject-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada permohonan izin yang menunggu</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-rocket"></i> Akses Cepat</h4>
                        </div>
                        <div class="card-body">
                            {{-- Sesuaikan dengan route yang sudah ada --}}
                            <a href="{{ route('employees.index') }}" class="btn btn-block btn-lg mb-3"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none">
                                <i class="fas fa-users"></i> Data Pegawai
                            </a>
                            <a href="{{ route('departemen.index') }}" class="btn btn-block btn-lg mb-3"
                                style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
                                <i class="fas fa-building"></i> Data Departemen
                            </a>
                            <a href="{{ route('positions.index') }}" class="btn btn-block btn-lg mb-3"
                                style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
                                <i class="fas fa-briefcase"></i> Data Jabatan
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-block btn-lg mb-3"
                                style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; border: none;">
                                <i class="fas fa-user-cog"></i> Data User
                            </a>
                            <a href="{{ route('attendances.index') }}" class="btn btn-block btn-lg"
                                style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); color: white; border: none;">
                                <i class="fas fa-calendar-check"></i> Data Absensi
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-history"></i> Aktivitas Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @forelse($recentActivities as $activity)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="text-job text-muted">{{ $activity['time'] }}</div>
                                            <div class="media-title mb-1">{{ $activity['title'] }}</div>
                                            <div class="text-small text-muted">{{ $activity['description'] }}</div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="text-muted">Belum ada aktivitas terbaru</div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Konfirmasi untuk approve
            $('.approve-form').on('submit', function (e) {
                return confirm('Apakah Anda yakin ingin menyetujui permohonan ini?');
            });

            // Konfirmasi untuk reject
            $('.reject-form').on('submit', function (e) {
                return confirm('Apakah Anda yakin ingin menolak permohonan ini?');
            });
        });
    </script>
@endsection