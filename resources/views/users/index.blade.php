@extends('layouts.app')

@section('title', 'Data User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">

        <!-- HEADER + TOMBOL TAMBAH DI KANAN (PERSIS SAMA KAYAK DEPARTEMEN) -->
        <div class="section-header d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-users"></i> Data User</h1>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-lg"
                        style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); color: white; border: none;">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>
            </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-list mr-2"></i> Daftar Pengguna Sistem</h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0" id="usersTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Avatar</th>
                                    <th width="25%">Nama Lengkap</th>
                                    <th width="25%">Email</th>
                                    <th width="15%">Role</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr style="transition: all 0.3s ease;">
                                        <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="avatar avatar-md text-white d-flex align-items-center justify-content-center"
                                                 style="background: {{ ['#667eea','#f093fb','#4facfe','#fa709a','#30cfd0','#764ba2'][$loop->index % 6] }}; border-radius: 50%; width: 48px; height: 48px; font-weight: bold;">
                                                {{ Str::substr($user->name, 0, 2) }}
                                            </div>
                                        </td>

                                        <td class="font-weight-600">
                                            {{ $user->name }}
                                            @if($user->employee)
                                                <br><small class="text-muted">{{ $user->employee->nama_lengkap ?? '-' }}</small>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                                <i class="fas fa-envelope text-info mr-1"></i>
                                                {{ $user->email }}
                                            </a>
                                        </td>

                                        <td>
                                            @switch($user->role)
                                                @case('superadmin')
                                                    <span class="badge badge-danger">Super Admin</span>
                                                    @break
                                                @case('admin')
                                                    <span class="badge badge-warning text-dark">Admin</span>
                                                    @break
                                                @case('manager')
                                                    <span class="badge badge-info">Manager</span>
                                                    @break
                                                @case('pegawai')
                                                    <span class="badge badge-success">Pegawai</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-secondary">{{ ucfirst($user->role) }}</span>
                                            @endswitch
                                        </td>

                                        <td class="text-center">
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                        <i class="fas fa-user-edit text-primary mr-2"></i> Edit Profil
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('profile.change-password') }}">
                                                        <i class="fas fa-key text-warning mr-2"></i> Ganti Password
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash mr-2"></i> Hapus User
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fas fa-users-slash fa-3x text-muted mb-3"></i><br>
                                            <span class="text-muted">Belum ada user terdaftar</span>
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
        // Hover effect PERSIS SAMA kayak semua halaman sebelumnya
        $(document).on('mouseenter', '#usersTable tbody tr', function () {
            $(this).css('background-color', '#f8f9fa');
        }).on('mouseleave', '#usersTable tbody tr', function () {
            $(this).css('background-color', '');
        });
    });
</script>
@endpush