@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-users"></i> Data Pegawai</h1>
                <div>
                    <a href="{{ route('employees.create') }}" class="btn btn-lg"
                        style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); color: white; border: none;">
                        <i class="fas fa-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4><i class="fas fa-list"></i> Daftar Pegawai</h4>
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control"
                                    placeholder="Cari nama, email, atau departemen..." style="min-width: 300px;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="loading" class="text-center my-5" style="display:none;">
                            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p class="text-muted mt-3">Sedang memuat data...</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0" id="employeeTable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Nama Lengkap</th>
                                        <th width="18%">Email</th>
                                        <th width="15%">No. Telepon</th>
                                        <th width="12%">Departemen</th>
                                        <th width="12%">Jabatan</th>
                                        <th width="10%">Status</th>
                                        <th width="8%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data akan diisi via AJAX --}}
                                </tbody>
                            </table>
                        </div>

                        <div id="pagination" class="card-footer text-right">
                            {{-- Pagination AJAX --}}
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
            function loadEmployees(query = '', page = 1) {
                $.ajax({
                    url: "{{ route('employees.search') }}",
                    type: "GET",
                    data: { q: query, page: page },
                    beforeSend: function () {
                        $('#loading').show();
                        $('#employeeTable tbody').html('');
                    },
                    success: function (response) {
                        // Update statistik cards
                        $('#totalEmployees').text(response.total || 0);
                        $('#activeEmployees').text(response.active || 0);
                        $('#totalDepartments').text(response.departments || 0);
                        $('#totalPositions').text(response.positions || 0);

                        let rows = '';
                        if (response.data.length > 0) {
                            response.data.forEach((employee, index) => {
                                // Generate random color for avatar
                                const colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0', '#fbc531', '#e74c3c', '#3498db'];
                                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                                const initials = employee.nama_lengkap.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();

                                rows += `
                                        <tr style="transition: all 0.3s ease;">
                                            <td>${response.from + index}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="employee-avatar" style="background: ${randomColor};">
                                                        ${initials}
                                                    </div>
                                                    <div class="employee-info ml-2">
                                                        <div class="employee-name">${employee.nama_lengkap}</div>
                                                        <div class="employee-id text-muted small">ID: EMP${String(employee.id).padStart(4, '0')}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="fas fa-envelope text-muted mr-1"></i>
                                                ${employee.email}
                                            </td>
                                            <td>
                                                <i class="fas fa-phone text-muted mr-1"></i>
                                                ${employee.nomor_telepon || '-'}
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    ${employee.departemen ? employee.departemen.nama_departemen : '-'}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    ${employee.jabatan ? employee.jabatan.nama_jabatan : '-'}
                                                </span>
                                            </td>
                                            <td>
                                                ${employee.status.toLowerCase() === 'aktif'
                                        ? '<span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Aktif</span>'
                                        : '<span class="badge badge-danger"><i class="fas fa-times-circle mr-1"></i> Tidak Aktif</span>'}
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="/employees/${employee.id}">
                                                            <i class="fas fa-eye text-info mr-2"></i> Detail
                                                        </a>
                                                        <a class="dropdown-item" href="/employees/${employee.id}/edit">
                                                            <i class="fas fa-edit text-warning mr-2"></i> Edit
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form method="POST" action="/employees/${employee.id}" 
                                                            onsubmit="return confirm('Yakin ingin menghapus data pegawai ${employee.nama_lengkap}?')" class="d-inline">
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
                                    `;
                            });
                        } else {
                            rows = `
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Tidak ada data pegawai</p>
                                        </td>
                                    </tr>
                                `;
                        }
                        $('#employeeTable tbody').html(rows);

                        // Pagination
                        let pagination = '';
                        if (response.last_page > 1) {
                            pagination += '<nav aria-label="Page navigation example"><ul class="pagination justify-content-end mb-0">';
                            if (response.current_page > 1) {
                                pagination += `
                                        <li class="page-item">
                                            <a class="page-link" href="#" data-page="${response.current_page - 1}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    `;
                            }
                            for (let i = 1; i <= response.last_page; i++) {
                                pagination += `
                                        <li class="page-item ${i === response.current_page ? 'active' : ''}">
                                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                                        </li>
                                    `;
                            }
                            if (response.current_page < response.last_page) {
                                pagination += `
                                        <li class="page-item">
                                            <a class="page-link" href="#" data-page="${response.current_page + 1}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    `;
                            }
                            pagination += '</ul></nav>';
                        }
                        $('#pagination').html(pagination);
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                        $('#employeeTable tbody').html(`
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                        <p class="text-danger">Terjadi kesalahan saat memuat data. Silakan coba lagi.</p>
                                    </td>
                                </tr>
                            `);
                    }
                });
            }

            // Load awal
            loadEmployees();

            // Live search
            $('#search').on('keyup', function () {
                let query = $(this).val();
                loadEmployees(query);
            });

            // Pagination click
            $(document).on('click', '#pagination a', function (e) {
                e.preventDefault();
                let page = $(this).data('page');
                let query = $('#search').val();
                loadEmployees(query, page);
            });
        });
    </script>
    <style>
        .employee-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .employee-info {
            display: flex;
            flex-direction: column;
        }

        .employee-name {
            font-weight: bold;
        }
    </style>
@endpush