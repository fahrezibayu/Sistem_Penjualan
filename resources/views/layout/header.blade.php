<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">

        <div class="navber-left">
            <a href="#" class="navbar-brand sidebar-gone-hide ">
                <img src="{{ asset('assets/img/logo') }}/{{ $profile->photo }}" alt="Logo" class="img-rounded"
                    width="50"> {{ $profile->nama_aplikasi }}
            </a>
            <div class="navbar-nav">
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>

            </div>
        </div>
        <ul class="navbar-nav navbar-right">


            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    @if (Auth::user()->foto == '')
                        <img alt="image"
                            src="https://ui-avatars.com/api?name={{ Auth::user()->name }}&color=7FCF5&background=EBF4FF"
                            class="rounded-circle mr-1" width="30" height="30">
                    @else
                        <img alt="image" src="{{ asset('assets/img/profile') }}/{{ Auth::user()->foto }}"
                            class="rounded-circle mr-1" width="30" height="30">
                    @endif
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }} </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">
                        {{ Auth::user()->role }} <br />
                    </div>
                    <a href="{{ url('/setting/profile_user', Auth::user()->id) }}" class="dropdown-item has-icon">
                        <i class="fas fa-user"></i> Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/sign_out') }}" id="logout" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">

            @if (Auth::user()->role == 'Admin')
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}" class="nav-link"><i class="fa fa-home"></i><span>
                            Dashboard </span></a>
                </li>
                <li class="nav-item dropdown {{ request()->segment(1) == 'master' ? 'active' : '' }}">
                    <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                            class="fas fa-archive"></i><span> Master </span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->segment(2) == 'merk' ? 'active' : '' }}"><a
                                href="{{ url('/master/merk') }}" class="nav-link"> Data Merk </a></li>
                        <li class="nav-item {{ request()->segment(2) == 'barang' ? 'active' : '' }}"><a
                                href="{{ url('/master/barang') }}" class="nav-link"> Data Barang </a></li>
                        <li class="nav-item {{ request()->segment(2) == 'pengguna' ? 'active' : '' }}"><a
                                href="{{ url('/master/pengguna') }}" class="nav-link"> Data Pengguna </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown {{ request()->segment(1) == 'penjualan' ? 'active' : '' }}">
                    <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                            class="fas fa-shopping-bag"></i><span> Penjualan </span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item {{ request()->segment(2) == 'pos' ? 'active' : '' }}"><a
                                href="{{ url('/penjualan/pos') }}" class="nav-link"> Kasir Pos </a></li>
                        <li class="nav-item {{ request()->segment(2) == 'laporan' ? 'active' : '' }}"><a
                                href="{{ url('/penjualan/laporan') }}" class="nav-link"> Laporan Penjualan </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'aplikasi' ? 'active' : '' }}">
                    <a href="{{ url('/setting/aplikasi') }}" class="nav-link"><i
                            class="fas fa-cog"></i><span> Setting Aplikasi </span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sign_out') }}" class="nav-link"><i class="fa fa-sign-out-alt"></i><span>
                            Logout </span></a>
                </li>
            @else
                <li class="nav-item {{ request()->segment(2) == 'pos' ? 'active' : '' }}">
                    <a href="{{ url('/penjualan/pos') }}" class="nav-link"><i
                            class="fas fa-shopping-bag"></i><span> Kasir Pos </span></a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'laporan' ? 'active' : '' }}">
                    <a href="{{ url('/penjualan/laporan') }}" class="nav-link"><i
                            class="fas fa-book"></i><span> Laporan Penjualan </span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sign_out') }}" class="nav-link"><i class="fa fa-sign-out-alt"></i><span>
                            Logout </span></a>
                </li>
            @endif

        </ul>
    </div>
</nav>
