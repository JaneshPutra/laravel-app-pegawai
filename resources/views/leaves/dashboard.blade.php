@extends('layouts.app')

@section('title', 'Dashboard Izin Saya')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Izin/Cuti Saya</h1>
        </div>

        <div class="section-body">
            <div class="row">
                {{-- Total Pengajuan --}}
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-file-alt"></i></div>
                        <div class="card-body">
                            <h4>Total Pengajuan</h4>
                            <p>{{ $totalLeaves }}</p>
                        </div>
                    </div>
                </div>

                {{-- Disetujui --}}
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-check"></i></div>
                        <div class="card-body">
                            <h4>Disetujui</h4>
                            <p>{{ $approvedLeaves }}</p>
                        </div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-hourglass-half"></i></div>
                        <div class="card-body">
                            <h4>Menunggu</h4>
                            <p>{{ $pendingLeaves }}</p>
                        </div>
                    </div>
                </div>

                {{-- Ditolak --}}
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger"><i class="fas fa-times"></i></div>
                        <div class="card-body">
                            <h4>Ditolak</h4>
                            <p>{{ $rejectedLeaves }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                {{-- Rekap per jenis izin --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h4>Izin Harian</h4></div>
                        <div class="card-body"><p>{{ $izinCount }}</p></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h4>Cuti Tahunan</h4></div>
                        <div class="card-body"><p>{{ $cutiCount }}</p></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h4>Sakit</h4></div>
                        <div class="card-body"><p>{{ $sakitCount }}</p></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('leaves.my') }}" class="btn btn-info">Lihat Riwayat Izin</a>
                <a href="{{ route('leaves.create') }}" class="btn btn-primary">+ Ajukan Izin</a>
            </div>
        </div>
    </section>
</div>
@endsection
