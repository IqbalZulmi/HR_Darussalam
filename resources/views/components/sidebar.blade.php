<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @canany([
            'manajemen_user.read',
            'manajemen_rekap_absensi.read',
            'manajemen_evaluasi.read',
            'verifikasi_cuti.read',
        ])
            <li class="nav-heading">HRD</li>
        @endcanany

        @hasanyrole(['staff hrd','kepala hrd','kepala yayasan','superadmin'])
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('hrd.dashboard.page') ? '' : ' collapsed' }}" href="{{ route('hrd.dashboard.page') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @endhasanyrole

        @can('manajemen_rekap_absensi.read')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('rekap.absensi.today.page') ? '' : ' collapsed' }}" href="{{ route('rekap.absensi.today.page') }}">
                <i class="bi bi-clipboard-check"></i>
                <span>Absensi Hari ini</span>
            </a>
        </li>
        @endcan


        @can('manajemen_user.read')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('kelola.pegawai.page') }}">
                        <i class="bi bi-people"></i>
                        <span>Pegawai</span>
                    </a>
                </li>
        @endcan

        @canany([
            'rekap_absensi_pribadi.read',
            'pengajuan_cuti.read',
            'rekap_evaluasi_pribadi.read'
        ])
            <li class="nav-heading">Pegawai</li>
        @endcanany

        @hasanyrole(['tenaga pendidik','kepala sekolah','kepala departemen','superadmin','direktur pendidikan'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pegawai.dashboard.page') ? '' : ' collapsed' }}" href="{{ route('pegawai.dashboard.page') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('rekap.absensi.pribadi.page') ? '' : ' collapsed' }}" href="{{ route('rekap.absensi.pribadi.page') }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Rekap Absensi Pribadi</span>
                </a>
            </li>
            <li class="nav-heading">Direktur Pendidikan</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('verifikasi.cuti.dirpen.page') ? '' : ' collapsed' }}" href="{{ route('verifikasi.cuti.dirpen.page') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Verifikasi Cuti</span>
                </a>
            </li>
            <li class="nav-heading">Kepala Sekolah</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('verifikasi.cuti.kepsek.page') ? '' : ' collapsed' }}" href="{{ route('verifikasi.cuti.kepsek.page') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Verifikasi Cuti</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pengajuan.cuti.tendik.page') ? '' : ' collapsed' }}" href="{{ route('pengajuan.cuti.tendik.page') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Pengajuan Cuti</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kelola.pegawai.page') ? '' : ' collapsed' }}" href="{{ route('kelola.pegawai.page') }}">
                    <i class="bi bi-ui-checks"></i>
                    <span>Evaluasi</span>
                </a>
            </li>
        @endhasanyrole

        @canany([
            'manajemen_role.read',
            'manajemen_hak_akses.read',
            'manajemen_hak_akses_user.read',
        ])
            <li class="nav-heading">Roles & Permission</li>
        @endcanany

        @can('manajemen_role.read')
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
