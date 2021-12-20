<?php
require_once '../config.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$nohp = $_POST['nohp'];
$deskripsi = $_POST['deskripsi'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$query = "UPDATE jasa_kirim SET nama='$nama', alamat='$alamat', no_hp='$nohp', deskripsi='$deskripsi', lat='$lat', lng='$lng', updated_at=NOW() WHERE id=".$id;

$exc = mysqli_query($conn, $query);

if ($exc) echo "Data berhasil diupdate. Otomatis redirect ke data tabel";
?>