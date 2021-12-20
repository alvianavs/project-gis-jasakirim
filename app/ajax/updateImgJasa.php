<?php

if(isset($_FILES['file']['name'])){
	require_once '../config.php';
   $id = $_POST['idJasa'];
   $oldImg = $_POST['oldImg'];
   $locOldImg = "../../assets/img/upload/".$oldImg;

   $newFileName = uniqid('uploaded-', true). '.' . strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

   $location = "../../assets/img/upload/".$newFileName;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   $valid_extensions = array("jpg","jpeg","png");

   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         if (file_exists($locOldImg)) {
            unlink($locOldImg);
         }
      	$query = "UPDATE jasa_kirim SET image='$newFileName', updated_at=NOW() WHERE id=".$id;
      	$exc = mysqli_query($conn, $query);
      	if ($exc)
      		echo "Image berhasil diupdate";
      	else
      		echo "Terjadi kesalahan";
         
         exit;
      }
   }

   echo "Tipe image tidak valid";
   exit;
} else echo "Image tidak ditemukan";
// ?>