@extends('layouts.app')

@section('title', 'Data Departemen')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-users"></i> Data Departemen</h1>
                <div>
                    <a href="{{ route('departemens.create') }}" class="btn btn-lg"
                        style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); color: white; border: none;">
                        <i class="fas fa-plus"></i> Tambah Departemen
                    </a>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-list"></i> Daftar Departemen</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0" id="departmentTable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="60%">Nama Departemen</th>
                                        <th width="25%">Jumlah Pegawai</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departemens as $departemen)
                                        <tr style="transition: all 0.3s ease;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $departemen->nama_departemen }}</td>
                                            <td>{{ $departemen->employees_count }} Pegawai</td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownDepartemen{{ $departemen->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownDepartemen{{ $departemen->id }}">
                                                        <a class="dropdown-item" href="{{ route('departemens.show', $departemen->id) }}">
                                                            <i class="fas fa-eye text-info mr-2"></i> Detail
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('departemens.edit', $departemen->id) }}">
                                                            <i class="fas fa-edit text-warning mr-2"></i> Edit
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form method="POST" action="{{ route('departemens.destroy', $departemen->id) }}" onsubmit="return confirm('Yakin ingin menghapus departemen ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash mr-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
            // Hover effect untuk table rows
            $(document).on('mouseenter', '#departmentTable tbody tr', function () {
                $(this).css('background-color', '#f8f9fa');
            }).on('mouseleave', '#departmentTable tbody tr', function () {
                $(this).css('background-color', '');
            });
        });
    </script>
@endpush
