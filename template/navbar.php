<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

<!-- Nav Item - Messages -->
<?php
require_once 'app/config.php';
$query = "SELECT j.nama, j.alamat, r.* FROM jasa_kirim j, ulasan r WHERE j.id=r.jasa_kirim_id AND r.user_id=".$_SESSION['user_id'];
$result = mysqli_query($conn, $query);
?>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle text-primary" href="#" id="messagesDropdown" role="button"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-star fa-fw"></i>
    <!-- Counter - Messages -->
    <span class="badge badge-danger badge-counter" id="badge-ulasan-user"></span>
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-list dropdown-menu dropdown-menu-end shadow animated--grow-in"
aria-labelledby="messagesDropdown">
<h6 class="dropdown-header">
    Ulasan saya
</h6>
<?php
$count = 0;
while ($row = mysqli_fetch_assoc($result)) {
$count++;
if ($count > 3) break;
?>
<a class="dropdown-item" href="#">
    <div class="d-inline-block text-truncate" style="max-width: 270px"><?= $row['deskripsi'] ?></div>
    <div class="text-gray-600 d-flex justify-content-between">
        <small><?= $row['nama'] ?></small>
            <small><?= date('H:i l, M Y', strtotime($row['updated_at'])) ?></small>
        </div>
</a>
<?php } ?>
<a class="dropdown-item text-center small text-gray-600" href="http://localhost/project-akhir-gis/index.php?page=profile-user" id="ulasan-user" data-count="<?= $count ?>">Lihat semua</a>
</div>
</li>

<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo (isset($_SESSION['nama'])) ? $_SESSION['nama'] : '' ?></span>
    <img class="img-profile rounded-circle"
    src="assets/img/undraw_profile.svg"></a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
    aria-labelledby="userDropdown">
    <a class="dropdown-item" href="http://localhost/project-akhir-gis/index.php?page=profile-user">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profile
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</div>
</li>

</ul>

</nav>
<!-- End of Topbar -->