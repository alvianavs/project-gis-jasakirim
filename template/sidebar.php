
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-globe-asia"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Project GIS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/project-akhir-gis/index.php?page=home">
                <i class="fas fa-fw fa-map-marked-alt"></i>
                <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-truck"></i>
                <span>Jasa pengiriman</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola jasa:</h6>
                    <a class="collapse-item" href="/project-akhir-gis/index.php?page=jasa">Tambah baru</a>
                    <a class="collapse-item" href="/project-akhir-gis/index.php?page=jasa-tabel"">Data tabel</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="/project-akhir-gis/index.php?page=user">
                <i class="fas fa-fw fa-users"></i>
                <span>User</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="/project-akhir-gis/index.php?page=ulasan">
                <i class="fas fa-fw fa-comments"></i>
                <span>Ulasan</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pencarian
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="/project-akhir-gis/index.php?page=cari-rute" id="test">
                <i class="fas fa-fw fa-route"></i>
                <span>Cari rute</span>
            </a>
        </li>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include 'navbar.php'; ?>

        