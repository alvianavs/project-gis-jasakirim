<?php
require_once '../config.php';

$id = $_REQUEST['id'];
$image = $_REQUEST['image'];

$query = "DELETE FROM jasa_kirim WHERE id = ".$id;

$data = mysqli_query($conn, $query);
unlink("../../assets/img/upload/".$image);

if ($data) echo "Data berhasil dihapus";
?>