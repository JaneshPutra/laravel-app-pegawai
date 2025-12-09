@extends('layouts.app')

@section('title', 'Detail Izin/Cuti')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Izin/Cuti</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Pengajuan</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nama Pegawai:</strong> {{ $leave->employee->nama_lengkap }}</p>
                    <p><strong>Jabatan:</strong> {{ $leave->employee->jabatan->nama ?? '-' }}</p>
                    <p><strong>Tanggal:</strong> 
                        {{ $leave->start_date }}
                        @if($leave->end_date && $leave->end_date != $leave->start_date)
                            s/d {{ $leave->end_date }}
                        @endif
                        (Durasi: {{ $leave->duration }} hari)
                    </p>
                    <p><strong>Jenis Izin:</strong> {{ ucfirst($leave->type) }}</p>
                    <p><strong>Alasan:</strong> {{ $leave->reason ?? '-' }}</p>
                    <p><strong>Status:</strong>
                        @if($leave->status === 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($leave->status === 'pending')
                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </p>
                    <p><strong>Disetujui Oleh:</strong> {{ $leave->approver->name ?? '-' }}</p>

                    @if($leave->attachment)
                        <p><strong>Lampiran:</strong></p>
                        <a href="{{ asset('storage/'.$leave->attachment) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat Lampiran
                        </a>
                    @endif
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
