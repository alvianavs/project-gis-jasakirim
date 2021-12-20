<?php
session_start();

if (isset($_POST['submit'])) {
	require_once '../config.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT id, nama FROM user WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($conn, $query);
	if($result) {
		$row = mysqli_num_rows($result);
		if ($row > 0) {
			$data = mysqli_fetch_assoc($result);
			$_SESSION['is_login'] = true;
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['user_id'] = $data['id'];
			header("location: http://localhost/project-akhir-gis/index.php?page=home");
		} else {
			$_SESSION['pesan'] = "Password atau username yang anda masukkan salah";
			header("location: http://localhost/project-akhir-gis/app/login.php");
		}
		
	} else {
		header("location: http://localhost/project-akhir-gis/app/login.php");
	}
	
	
}
?>