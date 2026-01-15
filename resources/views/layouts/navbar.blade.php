<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <!-- Welcome Message -->
            <li class="nav-item px-2 d-none d-md-block">
                <span class="nav-link text-dark">
                    Selamat Datang di TPQ Khairunnisa
                </span>
            </li>

            {{-- <!-- Notifications Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-bell align-middle"></i>
                    <span class="indicator"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0">
                    <div class="dropdown-menu-header">
                        Notifikasi
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="bi bi-bell text-primary"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Belum ada notifikasi</div>
                                    <div class="text-muted small mt-1">Sekarang</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li> --}}

            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/logo-tpq-2.png') }}" class="avatar img-fluid rounded-circle me-1"
                        alt="{{ Auth::user()->name }}" />
                    <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person align-middle me-1"></i> Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right align-middle me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
