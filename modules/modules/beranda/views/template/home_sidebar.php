<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(''); ?>">
        <div class="sidebar-brand-text ml-2">E-Commerce</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-grip-horizontal"></i>
        <span>Produk</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= base_url('products'); ?>">Semua Produk</a>
        <a class="collapse-item" href="<?= base_url('category/barang'); ?>">Berdasarkan Kategori</a>
        </div>
    </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('order'); ?>">
            <i class="fas fa-folder"></i>
            <span>Daftar Pesanan</span></a>
    </li>


    <?php if($this->session->userdata('role') == '1'): ?>
        <!-- Nav Item - Profil User -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('category'); ?>">
                <i class="fas fa-align-justify"></i>
                <span>Kategori</span></a>
        </li>
    <?php endif; ?>

    
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('account'); ?>">
            <i class="fas fa-stream"></i>
            <span>Log</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->