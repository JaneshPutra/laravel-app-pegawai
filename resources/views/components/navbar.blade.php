<nav class="navbar navbar-expand-lg main-navbar fixed-top custom-navbar">
    <!-- Brand di kiri -->
    <a href="{{ url('/manager') }}" class="navbar-brand">APP PEGAWAI</a>

    @if (!Request::is('login') && !Request::is('register'))
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarMenu">
            <!-- ✅ Menu utama di tengah -->
            <ul class="navbar-nav flex-grow-1 justify-content-center">
                @auth
                    @if(Auth::user()->role === 'Manager')
                        <li class="nav-item {{ Request::is('employees') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('employees') }}">
                                <i class="fas fa-table"></i> Data Pegawai
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('departemen') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('departemen') }}">
                                <i class="fas fa-building"></i> Departemen
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('jabatan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('jabatan') }}">
                                <i class="fas fa-briefcase"></i> Jabatan
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('salaries') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('salaries') }}">
                                <i class="fas fa-money-bill-wave"></i> Salary
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('users') }}">
                                <i class="fas fa-briefcase"></i> User
                            </a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('attendances*') || Request::is('leaves*') ? 'active' : '' }}">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-clock"></i> Absensi
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{ Request::is('attendances') ? 'active' : '' }}" href="{{ url('attendances') }}">
                                    <i class="fas fa-user-check"></i> Data Absensi
                                </a>
                                <a class="dropdown-item {{ Request::is('leaves') ? 'active' : '' }}" href="{{ url('leaves') }}">
                                    <i class="fas fa-calendar-times"></i> Data Izin/Cuti
                                </a>
                            </div>
                        </li>
                    @elseif(Auth::user()->role === 'Pegawai')
                        <li class="nav-item {{ Request::is('my-attendance') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('my-attendances') }}">
                                <i class="fas fa-user-check"></i> Absensi
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('my-leave') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('my-leaves') }}">
                                <i class="fas fa-calendar-times"></i> Pengajuan Cuti
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('my-salary') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('my-salary') }}">
                                <i class="fas fa-money-bill-wave"></i> Pengambilan Gaji
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- ✅ Bagian kanan: notif + profile -->
            <ul class="navbar-nav">
                @auth
                    <!-- Notifikasi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="notifDropdown" role="button" data-toggle="dropdown">
                            <span class="position-relative">
                                🔔
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge badge-primary position-absolute"
                                          style="top: -8px; right: -10px; font-size: 0.7rem; padding: 2px 6px; border-radius: 10px;">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-lg p-2" aria-labelledby="notifDropdown"
                             style="width: 320px; max-height: 400px; overflow-y: auto;">
                            <h6 class="dropdown-header">Notifikasi</h6>
                            @forelse(auth()->user()->notifications as $notif)
                                <a href="{{ route('notifications.read', $notif->id) }}" class="text-decoration-none">
                                    <div class="card mb-2 {{ $notif->read_at ? 'bg-light' : 'border-primary' }}">
                                        <div class="card-body p-2">
                                            <p class="mb-1 small" style="white-space: normal; word-wrap: break-word; font-size: 0.85rem;">
                                                {{ $notif->data['message'] }}
                                            </p>
                                            <small class="text-muted">
                                                {{ $notif->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="dropdown-item text-muted">Tidak ada notifikasi</p>
                            @endforelse
                        </div>
                    </li>

                    <!-- Profile -->
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-user">
                            <img alt="image"
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6a11cb&color=fff"
                                 class="rounded-circle mr-1" width="30">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
                            </a>
                            <a href="{{ route('profile.change-password') }}" class="dropdown-item has-icon">
                                <i class="fas fa-key"></i> Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    @endif
</nav>
