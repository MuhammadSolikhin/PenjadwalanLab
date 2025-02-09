<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('AdminLte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Penjadwalan Lab</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('AdminLte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/laboratorium" class="nav-link">
                            <i class="nav-icon fas fa-flask"></i>
                            <p>Laboratorium</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.jenis-laboratorium') }}" class="nav-link">
                            <i class="nav-icon fas fa-solid fa-flask"></i>
                            <p>Jenis Laboratorium</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/barang" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/penjadwalan" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Penjadwalan</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'other')
                    <li class="nav-item">
                        <a href="{{route('user.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user.profile')}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'laboran')
                    <li class="nav-item">
                        <a href="{{route('laboran.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('laboran.profile')}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>logout</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>