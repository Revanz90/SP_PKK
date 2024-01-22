<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="/img/Logo-PKK.png" alt="Logo PKK" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Simpan Pinjam PKK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist') }}/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            {{-- @foreach ($useractive as $username) --}}
            <div class="info">
                <a href="" class="d-block">{{ auth()->user()->name }}</a>
            </div>
            {{-- @endforeach --}}
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MAIN MENU</li>
                <li class="nav-item {{ request()->routeIs('datasimpanan') ? 'menu-open' : '' }}">
                    <a href="{{ route('datasimpanan') }}" class="nav-link">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p>
                            Data Simpanan
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('datapinjaman') ? 'menu-open' : '' }}">
                    <a href="{{ route('datapinjaman') }}" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Data Pinjaman
                        </p>
                    </a>
                </li>
                {{-- @hasrole('super-admin|admin|kamus') --}}
                <li class="nav-item {{ request()->routeIs('dataangsuran') ? 'menu-open' : '' }}">
                    <a href="{{ route('dataangsuran') }}" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Data Angsuran
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('dataanggota') ? 'menu-open' : '' }}">
                    <a href="{{ route('dataanggota') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Data Anggota
                        </p>
                    </a>
                </li>
                {{-- @endhasrole --}}
            </ul>
        </nav>
    </div>
</aside>
