<!-- resources/views/layouts/sidebar.blade.php -->
<ul class="navbar-nav bg-custom sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #449A51;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?module=dashboard">
        <div class="sidebar-brand-icon" bis_skin_checked="1">
            <img src="{{ asset('images/logofix.png') }}" alt="Logo" width="70%">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard Menu -->
    <li class="nav-item {{ request()->routeIs('Dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading" bis_skin_checked="1">Transaksi</div>

    <li class="nav-item {{ request()->routeIs('pemasukan.tabel') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pemasukan.tabel') }}">
            <i class="fas fa-fw fa-sign-in-alt"></i>
            <span>Pemasukan</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('pengeluaran.tabel') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengeluaran.tabel') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Pengeluaran</span>
        </a>
    </li>

    {{-- <hr class="sidebar-divider">
    <div class="sidebar-heading" bis_skin_checked="1">Referensi</div>

    <li class="nav-item {{ request()->routeIs('kategori') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori') }}">
            <i class="fas fa-fw fa-clone"></i>
            <span>Kategori</span>
        </a>
    </li> --}}

    <hr class="sidebar-divider">
    <div class="sidebar-heading" bis_skin_checked="1">Laporan</div>

    <li class="nav-item {{ request()->routeIs('laporan.pemasukan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.pemasukan') }}">
            <i class="fas fa-fw fa-file-import"></i>
            <span>Laporan Pemasukan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('laporan.pengeluaran') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.pengeluaran') }}">
            <i class="fas fa-fw fa-file-export"></i>
            <span>Laporan Pengeluaran</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('Laporan.Kas') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('Laporan.Kas') }}">
            <i class="fas fa-fw fa-file-contract"></i>
            <span>Laporan Arus Kas</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading" bis_skin_checked="1">Api</div>

    <li class="nav-item {{ request()->routeIs('dokumentasi.api') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dokumentasi.api') }}">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Dokumentasi Api</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline" bis_skin_checked="1">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<style>
    .bg-custom {
        background-color: #449A51 !important;
    }
</style>
