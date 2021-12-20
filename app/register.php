<?php
session_start();
if (isset($_SESSION['is_login'])) {
  header("location:http://localhost/project-akhir-gis/index.php?page=home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Project GIS - Register</title>

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="ajax/createAccount.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama" id="nama" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email Address" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="repassword" id="repassword" placeholder="Repeat Password" required>
                  </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <?php if(isset($_SESSION['pesan'])) : ?>
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                  <?= $_SESSION['pesan'] ?>
                </div>
                <?php endif; ?>
                <?php unset($_SESSION['pesan']) ?>
                <a class="small" href="http://localhost/project-akhir-gis/app/login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
