@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
    <div class="main-content">
        <section class="section">
            <!-- HERO CARD KECIL & ELEGAN -->
            <div class="card mb-4"
                style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(102,126,234,0.15);">
                <div class="card-header text-white d-flex align-items-center py-4"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="avatar mr-3"
                        style="width: 56px; height: 56px; background: rgba(255,255,255,0.25); font-size: 20px; border: 3px solid white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        {{ $initials }}
                    </div>
                    <div>
                        <h5 class="mb-0">Selamat datang, {{ $employee->nama_lengkap }}</h5>
                        <small class="opacity-90">
                            <i class="fas fa-briefcase mr-1"></i> {{ $employee->jabatan->nama_jabatan ?? 'Pegawai' }}
                            - {{ $employee->departemen->nama_departemen ?? '-' }}
                        </small>
                    </div>
                    <div class="ml-auto text-right">
                        <div class="h5 mb-0">{{ now()->translatedFormat('l, d F Y') }}</div>
                        <small class="opacity-80">{{ now()->format('H:i') }} WIB</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- KIRI: Absen + Statistik -->
                <div class="col-lg-8">
                    <!-- Absensi Hari Ini -->
                    <div class="card mb-4" style="border-radius: 14px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                        <div class="card-header text-white d-flex justify-content-between align-items-center"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 14px 14px 0 0;">
                            <h4 class="mb-0">Absensi Hari Ini</h4>
                            <span class="badge badge-light badge-lg">{{ now()->format('H:i') }} WIB</span>
                        </div>
                        <div class="card-body py-5 text-center">
                            @if($leaveToday)
                                <div class="py-5">
                                    <i class="fas fa-calendar-times fa-5x text-warning mb-4 opacity-75"></i>
                                    <h4 class="text-warning">Anda Sedang Izin</h4>
                                    <p class="text-muted">
                                        {{ ucfirst($leaveToday->type) }} •
                                        {{ \Carbon\Carbon::parse($leaveToday->start_date)->format('d M') }} -
                                        {{ \Carbon\Carbon::parse($leaveToday->end_date)->format('d M Y') }}
                                    </p>
                                </div>
                            @else
                                <div class="row text-center mb-5">
                                    <div class="col-6">
                                        <div
                                            class="p-4 rounded-lg border {{ $attendanceToday?->clock_in ? 'border-success bg-success-light' : 'border-muted' }}">
                                            <i
                                                class="fas fa-sign-in-alt fa-3x {{ $attendanceToday?->clock_in ? 'text-success' : 'text-muted' }} mb-3"></i>
                                            <h5>Clock In</h5>
                                            <h3 class="mb-0">{{ $attendanceToday?->clock_in ?? '--:--' }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="p-4 rounded-lg border {{ $attendanceToday?->clock_out ? 'border-success bg-success-light' : 'border-muted' }}">
                                            <i
                                                class="fas fa-sign-out-alt fa-3x {{ $attendanceToday?->clock_out ? 'text-success' : 'text-muted' }} mb-3"></i>
                                            <h5>Clock Out</h5>
                                            <h3 class="mb-0">{{ $attendanceToday?->clock_out ?? '--:--' }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    @if(!$attendanceToday || !$attendanceToday->clock_in)
                                        <form action="{{ route('attendances.clockIn') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-lg px-5">
                                                <i class="fas fa-sign-in-alt mr-2"></i> Clock In Sekarang
                                            </button>
                                        </form>
                                    @elseif(!$attendanceToday->clock_out)
                                        <form action="{{ route('attendances.clockOut') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-lg px-5">
                                                <i class="fas fa-sign-out-alt mr-2"></i> Clock Out Sekarang
                                            </button>
                                        </form>
                                    @else
                                        <div class="alert alert-success">
                                            <i class="fas fa-check-circle mr-2"></i> Absensi hari ini sudah selesai!
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success mt-4">
                                    <i class="fas fa-check mr-2"></i> {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Statistik Tahunan -->
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card bg-gradient-success text-white">
                                <div class="card-body py-4 text-center">
                                    <i class="fas fa-user-check fa-2x mb-2"></i>
                                    <h5>Total Hadir {{ $year }}</h5>
                                    <h3 class="mb-0">{{ $totalHadir }} hari</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card bg-gradient-warning text-white">
                                <div class="card-body py-4 text-center">
                                    <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                    <h5>Total Izin {{ $year }}</h5>
                                    <h3 class="mb-0">{{ $totalIzin }} kali</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: KALENDER YANG SUDAH DIREVISI -->
                <div class="col-lg-4">

                    <!-- KALENDER YANG DIREVISI -->
                    <div class="card mb-4"
                        style="border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                        <div class="card-header text-white text-center py-3"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="d-flex justify-content-between align-items-center px-4">
                                <a href="{{ route('attendances.myAttendance', ['month' => $month - 1, 'year' => $year]) }}"
                                    class="text-white calendar-nav-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <h5 class="mb-0 font-weight-bold">
                                    {{ \Carbon\Carbon::create($year, $month)->translatedFormat('F Y') }}
                                </h5>
                                <a href="{{ route('attendances.myAttendance', ['month' => $month + 1, 'year' => $year]) }}"
                                    class="text-white calendar-nav-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="calendar-container">
                            <div class="calendar-weekdays">
                                <div>Min</div>
                                <div>Sen</div>
                                <div>Sel</div>
                                <div>Rab</div>
                                <div>Kam</div>
                                <div>Jum</div>
                                <div>Sab</div>
                            </div>
                            
                            <div class="calendar-days">
                                @php
                                    $date = \Carbon\Carbon::create($year, $month, 1);
                                    $start = $date->copy()->startOfMonth()->startOfWeek(\Carbon\Carbon::SUNDAY);
                                    $end = $date->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SATURDAY);
                                    $today = \Carbon\Carbon::today()->toDateString();
                                @endphp
                                
                                @for($d = $start; $d->lte($end); $d->addDay())
                                    @php
                                        $isCurrentMonth = $d->month == $month;
                                        $isToday = $d->toDateString() == $today;
                                        $isWeekend = $d->isWeekend();
                                        
                                        $status = null;
                                        if ($isCurrentMonth) {
                                            if (isset($attendances[$d->toDateString()])) {
                                                $status = 'present';
                                            } elseif (isset($leaves[$d->toDateString()])) {
                                                $status = 'leave';
                                            } elseif ($d->lt(today()) && !$d->isWeekend()) {
                                                $status = 'absent';
                                            }
                                        }
                                        
                                        $dayClasses = ['calendar-day'];
                                        if (!$isCurrentMonth) $dayClasses[] = 'day-other-month';
                                        if ($isToday) $dayClasses[] = 'day-today';
                                        if ($isWeekend) $dayClasses[] = 'day-weekend';
                                    @endphp
                                    
                                    <div class="{{ implode(' ', $dayClasses) }}">
                                        <div class="day-number">{{ $d->day }}</div>
                                        @if($status)
                                            <div class="day-status status-{{ $status }}"></div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                            
                            <div class="calendar-legend">
                                <div class="legend-item">
                                    <div class="legend-color legend-present"></div>
                                    <span>Hadir</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color legend-leave"></div>
                                    <span>Izin</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color legend-absent"></div>
                                    <span>Alpa</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RINGKASAN BULAN INI (SUDAH MATCH DENGAN TEMA) -->
                    <div class="card" style="border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                        <div class="card-header text-white text-center py-3"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <h5 class="mb-0">Ringkasan {{ now()->translatedFormat('F Y') }}</h5>
                        </div>
                        <div class="card-body py-4">
                            <div class="d-flex justify-content-between py-2">
                                <span>Hadir</span>
                                <strong class="text-success">{{ $hadirBulanIni }} hari</strong>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span>Izin</span>
                                <strong class="text-warning">{{ $izinBulanIni }} hari</strong>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span>Tidak Hadir</span>
                                <strong class="text-danger">{{ $tidakHadirBulanIni }} hari</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection