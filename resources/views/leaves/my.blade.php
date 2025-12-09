@extends('layouts.app')

@section('title', 'Riwayat Izin & Cuti Saya')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HEADER + TOMBOL DI KANAN (EXACT SAMA KAYAK DEPARTEMEN) -->
        <div class="section-header d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-users"></i>Riwayat izin & cuti saya</h1>
                <div>
                    <a href="{{ route('leaves.create') }}" class="btn btn-lg"
                        style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); color: white; border: none;">
                        <i class="fas fa-plus"></i> Ajukan Izin
                    </a>
                </div>
            </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-list"></i> Daftar Pengajuan Izin & Cuti</h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0" id="myLeavesTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="22%">Tanggal</th>
                                    <th width="12%">Jenis</th>
                                    <th width="28%">Alasan</th>
                                    <th width="13%">Status</th>
                                    <th width="15%">Disetujui Oleh</th>
                                    <th width="10%" class="text-center">Lampiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                    <tr style="transition: all 0.3s ease;">
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($leave->start_date)->translatedFormat('d M Y') }}
                                            @if($leave->end_date && $leave->end_date != $leave->start_date)
                                                <br><small class="text-muted">s/d {{ \Carbon\Carbon::parse($leave->end_date)->translatedFormat('d M Y') }}</small>
                                            @endif
                                            <br><small class="text-info"><strong>{{ $leave->duration }} hari</strong></small>
                                        </td>

                                        <td>
                                            <span class="badge badge-pill 
                                                @if($leave->type == 'cuti') badge-info
                                                @elseif($leave->type == 'izin') badge-warning
                                                @else badge-secondary @endif">
                                                {{ ucfirst($leave->type) }}
                                            </span>
                                        </td>

                                        <td>
                                            <div style="max-width: 280px;" class="text-truncate" title="{{ $leave->reason ?? '-' }}">
                                                {{ $leave->reason ?? '-' }}
                                            </div>
                                        </td>

                                        <td>
                                            @if($leave->status === 'approved')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif($leave->status === 'pending')
                                                <span class="badge badge-warning text-dark">Menunggu</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $leave->approver?->name ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            @if($leave->attachment)
                                                <a href="{{ asset('storage/'.$leave->attachment) }}" target="_blank"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-paperclip"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i><br>
                                            <span class="text-muted">Belum ada pengajuan izin atau cuti</span>
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
        // Hover effect PERSIS SAMA kayak halaman departemen
        $(document).on('mouseenter', '#myLeavesTable tbody tr', function () {
            $(this).css('background-color', '#f8f9fa');
        }).on('mouseleave', '#myLeavesTable tbody tr', function () {
            $(this).css('background-color', '');
        });
    });
</script>
@endpush