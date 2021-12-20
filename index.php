<?php
session_start();
if (!isset($_SESSION['is_login'])) {
   header("location: http://localhost/project-akhir-gis/app/login.php");
}
?>
<?php include 'template/header.php' ?>

<!-- Begin Page Content -->
<div class="container-fluid">
   <?php
   $page = (isset($_GET['page']))? $_GET['page'] : '';
   switch($page){
      case 'home':
      include "app/view/home.php";
      break;

      case 'jasa':
      include "app/view/jasa.php";
      break;

      case 'jasa-tabel':
      include "app/view/jasa-tabel.php";
      break;

      case 'jasa-detail':
      include "app/view/jasa-detail.php";
      break;

      case 'user':
      include "app/view/user.php";
      break;

      case 'ulasan':
      include "app/view/ulasan.php";
      break;

      case 'cari-rute':
      include "app/view/cari-rute.php";
      break;

      case 'profile-user':
      include "app/view/profile-user.php";
      break;

      default:
      include "app/view/home.php";
  }
  ?>

</div>
<!-- /.container-fluid -->
<?php include 'template/footer.php' ?>