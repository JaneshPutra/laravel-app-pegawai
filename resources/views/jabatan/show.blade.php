@extends('layouts.app')

@section('title', 'Detail Jabatan')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Detail Jabatan</h1>
            <a href="{{ route('positions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Jabatan</th>
                            <td>{{ $position->nama_jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Gaji Pokok</th>
                            <td>Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
