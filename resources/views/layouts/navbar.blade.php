<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle d-lg-none" href="javascript:void(0);">
        <i class="hamburger align-self-center"></i>
    </a>


    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/logo-tpq-2.png') }}" class="avatar img-fluid rounded-circle me-1"
                        alt="{{ Auth::user()->name }}" />
                    <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person align-middle me-1"></i> Profil
                    </a>
                    <div class="dropdown-divider"></div> --}}
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
