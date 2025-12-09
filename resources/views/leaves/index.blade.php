@extends('layouts.app')

@section('title', 'Data Izin/Cuti')

@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1><i class="fas fa-file-alt"></i> Data Izin/Cuti Pegawai</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-clipboard-list" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Total Permohonan</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $leaves->count() }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                        .
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-clock" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Menunggu</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $leaves->where('status', 'pending')->count() }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                            Permohonan
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-check-circle" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Disetujui</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $leaves->where('status', 'approved')->count() }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                            Permohonan
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none;">
                <div class="card-icon" style="background: transparent;">
                    <i class="fas fa-times-circle" style="color: white; font-size: 40px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header" style="border: none; padding-bottom: 5px;">
                        <h4 style="color: white; margin-bottom: 0;">Ditolak</h4>
                    </div>
                    <div class="card-body" style="font-size: 32px; font-weight: bold; color: white;">
                        {{ $leaves->where('status', 'rejected')->count() }}
                    </div>
                    <div class="card-footer" style="background: transparent; border: none; padding-top: 0;">
                        <span style="color: rgba(255,255,255,0.9); font-size: 13px;">
                            Permohonan
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
                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab">
                            <i class="fas fa-list mr-2"></i>Semua ({{ $leaves->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab">
                            <i class="fas fa-clock mr-2"></i>Menunggu ({{ $leaves->where('status', 'pending')->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab">
                            <i class="fas fa-check-circle mr-2"></i>Disetujui ({{ $leaves->where('status', 'approved')->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab">
                            <i class="fas fa-times-circle mr-2"></i>Ditolak ({{ $leaves->where('status', 'rejected')->count() }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0">
                <div class="tab-content">
                    <!-- Tab Semua -->
                    <div class="tab-pane fade show active" id="all" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Pegawai</th>
                                        <th width="13%">Jenis Izin</th>
                                        <th width="11%">Tanggal Mulai</th>
                                        <th width="11%">Tanggal Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="5%" class="text-center">Lampiran</th>
                                        <th width="14%">Status</th>
                                        <th width="13%">Approver</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($leaves as $index => $leave)
                                        @include('leaves.partials.table-row', ['leave' => $leave, 'index' => $index])
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                                <p class="text-muted">Belum ada data permohonan izin/cuti</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Menunggu -->
                    <div class="tab-pane fade" id="pending" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Pegawai</th>
                                        <th width="13%">Jenis Izin</th>
                                        <th width="11%">Tanggal Mulai</th>
                                        <th width="11%">Tanggal Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="5%" class="text-center">Lampiran</th>
                                        <th width="14%">Status</th>
                                        <th width="13%">Approver</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($leaves->where('status', 'pending') as $index => $leave)
                                        @include('leaves.partials.table-row', ['leave' => $leave, 'index' => $index])
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-check-double fa-3x text-success mb-3 d-block"></i>
                                                <p class="text-muted">Tidak ada permohonan yang menunggu approval</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Disetujui -->
                    <div class="tab-pane fade" id="approved" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Pegawai</th>
                                        <th width="13%">Jenis Izin</th>
                                        <th width="11%">Tanggal Mulai</th>
                                        <th width="11%">Tanggal Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="5%" class="text-center">Lampiran</th>
                                        <th width="14%">Status</th>
                                        <th width="13%">Approver</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($leaves->where('status', 'approved') as $index => $leave)
                                        @include('leaves.partials.table-row', ['leave' => $leave, 'index' => $index])
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-times fa-3x text-muted mb-3 d-block"></i>
                                                <p class="text-muted">Tidak ada permohonan yang disetujui</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Ditolak -->
                    <div class="tab-pane fade" id="rejected" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Pegawai</th>
                                        <th width="13%">Jenis Izin</th>
                                        <th width="11%">Tanggal Mulai</th>
                                        <th width="11%">Tanggal Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="14%">Status</th>
                                        <th width="13%">Approver</th>
                                        <th width="5%" class="text-center">Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($leaves->where('status', 'rejected') as $index => $leave)
                                        @include('leaves.partials.table-row', ['leave' => $leave, 'index' => $index])
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-smile fa-3x text-success mb-3 d-block"></i>
                                                <p class="text-muted">Tidak ada permohonan yang ditolak</p>
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
    // Handle approve dengan AJAX
    $(document).on('submit', '.form-approve', function(e) {
        e.preventDefault();
        
        if (!confirm('Apakah Anda yakin ingin menyetujui permohonan ini?')) {
            return false;
        }
        
        let form = $(this);
        let leaveId = form.data('id');
        let statusCell = $('#status-' + leaveId);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Update status cell menjadi badge approved
                statusCell.html(`
                    <span class="badge badge-success" style="font-size: 12px; padding: 6px 12px;">
                        <i class="fas fa-check-circle mr-1"></i> Disetujui
                    </span>
                `);
                
                // Show notification
                iziToast.success({
                    title: 'Berhasil',
                    message: 'Permohonan berhasil disetujui!',
                    position: 'topRight'
                });
                
                // Reload page after 1 second
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr) {
                iziToast.error({
                    title: 'Error',
                    message: 'Gagal menyetujui permohonan',
                    position: 'topRight'
                });
            }
        });
    });
    
    // Handle reject dengan AJAX
    $(document).on('submit', '.form-reject', function(e) {
        e.preventDefault();
        
        if (!confirm('Apakah Anda yakin ingin menolak permohonan ini?')) {
            return false;
        }
        
        let form = $(this);
        let leaveId = form.data('id');
        let statusCell = $('#status-' + leaveId);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Update status cell menjadi badge rejected
                statusCell.html(`
                    <span class="badge badge-danger" style="font-size: 12px; padding: 6px 12px;">
                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                    </span>
                `);
                
                // Show notification
                iziToast.error({
                    title: 'Ditolak',
                    message: 'Permohonan telah ditolak!',
                    position: 'topRight'
                });
                
                // Reload page after 1 second
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr) {
                iziToast.error({
                    title: 'Error',
                    message: 'Gagal menolak permohonan',
                    position: 'topRight'
                });
            }
        });
    });
    
    // Smooth scroll on tab change
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('html, body').animate({
            scrollTop: $('.section-body').offset().top - 100
        }, 300);
    });
});
</script>
@endpush