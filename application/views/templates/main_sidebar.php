<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-motorcycle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MyBengkel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <?php if ($user['role_id'] == 2) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Customer
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('produk/list'); ?>">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Produk</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('cart'); ?>">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Keranjang</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('transaksi'); ?>">
                <i class="fas fa-fw fa-shopping-bag"></i>
                <span>Transaksi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('krisar/create'); ?>">
                <i class="fas fa-fw fa-inbox"></i>
                <span>Kritik & Saran</span></a>
        </li>
    <?php endif; ?>

    <?php if ($user['role_id'] == 1) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Administrator
        </div>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('customer'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Customer</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('montir'); ?>">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Montir</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('produk'); ?>">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Produk</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('transaksi'); ?>">
                <i class="fas fa-fw fa-shopping-bag"></i>
                <span>Transaksi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('krisar'); ?>">
                <i class="fas fa-fw fa-inbox"></i>
                <span>Kritik & Saran</span></a>
        </li>
    <?php endif; ?>

    <?php if ($user['role_id'] == 1 || $user['role_id'] == 3) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('laporan'); ?>">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->