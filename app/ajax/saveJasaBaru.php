<?php
require_once '../config.php';

if(isset($_FILES['file']['name'])){
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$nohp = $_POST['nohp'];
   $deskripsi = $_POST['deskripsi'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

   /* Getting file name */
   $newFileName = uniqid('uploaded-', true). '.' . strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

   /* Location */
   $location = "../../assets/img/upload/".$newFileName;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","png");



   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      	$query = "INSERT INTO jasa_kirim VALUES('', '$nama', '$alamat', '$nohp', '$deskripsi', '$lat', '$lng', '$newFileName', NOW(), NOW())";
      	$exc = mysqli_query($conn, $query);
      	if ($exc)
      		echo "Data berhasil disimpan";
      	else
      		echo "Terjadi kesalahan";
         
         exit;
      }
   }

   echo "Tipe image tidak valid";
   exit;
} else echo "Image tidak ditemukan";
?>