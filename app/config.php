<?php
$conn = mysqli_connect("localhost", "root", "", "gis_finalproject");

if (!$conn)
	die("Koneksi ke database gagal!. " . mysqli_connect_error());
?>