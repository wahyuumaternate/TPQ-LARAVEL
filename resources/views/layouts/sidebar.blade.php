<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <span class="sidebar-brand-icon">
                <i class="bi bi-book-half"></i>
            </span>
            <span class="sidebar-brand-text align-middle">TPQ KHAIRUNNISA</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Menu Utama</li>

            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door align-middle"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">Data Master</li>

            <li class="sidebar-item {{ request()->routeIs('santri.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('santri.index') }}">
                    <i class="bi bi-people align-middle"></i>
                    <span class="align-middle">Data Base Santri</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('guru.index') }}">
                    <i class="bi bi-person-badge align-middle"></i>
                    <span class="align-middle">Data Base Guru</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('orangtua.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('orangtua.index') }}">
                    <i class="bi bi-people-fill align-middle"></i>
                    <span class="align-middle">Data Base Orangtua</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kelas.index') }}">
                    <i class="bi bi-collection align-middle"></i>
                    <span class="align-middle">Data Kelas</span>
                </a>
            </li>

            <li class="sidebar-header">Akademik</li>

            <li class="sidebar-item {{ request()->routeIs('progress-santri.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('progress-santri.index') }}">
                    <i class="bi bi-graph-up-arrow align-middle"></i>
                    <span class="align-middle">Progress Santri</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <a class="sidebar-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#laporanMenu">
                    <i class="bi bi-file-earmark-bar-graph align-middle"></i>
                    <span class="align-middle">Laporan</span>
                </a>
                <ul id="laporanMenu"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('laporan.*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('laporan.santri-per-kelas') }}">Santri Per Kelas</a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('laporan.progress-bulanan') }}">Progress Bulanan</a>
                    </li> --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('laporan.absensi') }}">Laporan Absensi</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('laporan.statistik') }}">Statistik</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-header">Komunikasi</li>

            {{-- <li class="sidebar-item {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pengumuman.index') }}">
                    <i class="bi bi-megaphone align-middle"></i>
                    <span class="align-middle">Pengumuman WA</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('berita.index') }}">
                    <i class="bi bi-newspaper align-middle"></i>
                    <span class="align-middle">Kelola Berita</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
