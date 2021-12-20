<?php
session_start();

if (isset($_POST['submit'])) {
	require_once '../config.php';

	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];

	if ($password == $repassword) {
		$query = "INSERT INTO user VALUES ('', '$nama', '$username', '$email', '$password', NOW(), NOW())";
		$result = mysqli_query($conn, $query);
		$_SESSION['pesan'] = "<strong>Register berhasil!</strong> Akunmu telah dibuat. Silahkan login";
	} else {
		$_SESSION['pesan'] = "Password yang anda masukkan tidak sama";
	}
	header("location: http://localhost/project-akhir-gis/app/register.php");
}
?>