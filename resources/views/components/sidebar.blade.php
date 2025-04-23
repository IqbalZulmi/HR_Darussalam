<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">MAIN MENU</li>
        @hasanyrole(['staff hrd','kepala hrd','kepala yayasan'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hrd.dashboard.page') ? '' : ' collapsed' }}" href="{{ route('hrd.dashboard.page') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hrd.kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('hrd.pegawai.index') }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Rekap Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hrd.kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('hrd.pegawai.index') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Verifikasi Cuti</span>
                </a>
            </li>
        @endhasanyrole

        @hasanyrole(['tenaga pendidik','kepala sekolah','kepala departemen'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pegawai.dashboard.page') ? '' : ' collapsed' }}" href="{{ route('pegawai.dashboard.page') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hrd.kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('hrd.pegawai.index') }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Rekap Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hrd.kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('hrd.pegawai.index') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Pengajuan Cuti</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hrd.kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('hrd.pegawai.index') }}">
                    <i class="bi bi-ui-checks"></i>
                    <span>Evaluasi</span>
                </a>
            </li>
        @endhasanyrole

        @can('manajemen_user.read')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('hrd.pegawai.index') ? '' : ' collapsed' }}" href="{{ route('hrd.pegawai.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Pegawai</span>
                    </a>
                </li>
        @endcan

        @can('manajemen_role.read')
            <li class="nav-heading">Roles & Permission</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('role.index') ? '' : ' collapsed' }}" href="{{ route('role.index') }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endcan

        @can('manajemen_hak_akses.read')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('permission.index') ? '' : ' collapsed' }}" href="{{ route('permission.index') }}">
                    <i class="bi bi-person-video2"></i>
                    <span>Hak Akses</span>
                </a>
            </li>
        @endcan

        @can('manajemen_hak_akses_user.read')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.assign.index') ? '' : ' collapsed' }}" href="{{ route('user.assign.index') }}">
                    <i class="bi bi-person-gear"></i>
                    <span>Hak Akses Pengguna</span>
                </a>
            </li>
        @endcan
    </ul>
</aside><!-- End Sidebar-->
