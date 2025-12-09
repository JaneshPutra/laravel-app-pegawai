@extends('layouts.app')

@section('title', 'Slip Gaji Saya')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HEADER (PERSIS SAMA KAYAK DEPARTEMEN) -->
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1><i class="fas fa-money-check-alt mr-2"></i> Slip Gaji Saya</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-list mr-2"></i> Riwayat Slip Gaji</h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0" id="mySalaryTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Periode</th>
                                    <th width="16%">Gaji Pokok</th>
                                    <th width="16%">Tunjangan</th>
                                    <th width="16%">Potongan</th>
                                    <th width="16%">Total Gaji</th>
                                    <th width="11%">Tanggal</th>
                                    <th width="10%" class="text-center">Slip</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salaries as $salary)
                                    <tr style="transition: all 0.3s ease;">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">
                                            {{ \Carbon\Carbon::parse($salary->periode)->translatedFormat('F Y') }}
                                        </td>
                                        <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                        <td class="text-success">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                                        <td class="font-weight-bold text-primary h6">
                                            Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($salary->created_at)->translatedFormat('d M Y') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('salaries.download', $salary->id) }}"
                                               class="btn btn-sm btn-primary"
                                               style="border-radius: 8px;">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fas fa-file-invoice-dollar fa-3x text-muted mb-3"></i><br>
                                            <span class="text-muted">Belum ada slip gaji</span>
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
        // Hover effect PERSIS SAMA kayak departemen & cuti
        $(document).on('mouseenter', '#mySalaryTable tbody tr', function () {
            $(this).css('background-color', '#f8f9fa');
        }).on('mouseleave', '#mySalaryTable tbody tr', function () {
            $(this).css('background-color', '');
        });
    });
</script>
@endpush