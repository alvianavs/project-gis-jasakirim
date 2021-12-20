<?php
require_once '../config.php';

$id = $_REQUEST['idJasa'];

$query2 = "SELECT COUNT(id) as count FROM ulasan WHERE jasa_kirim_id=".$id;

$jumlah = mysqli_fetch_assoc(mysqli_query($conn, $query2));

echo "Ulasan (".$jumlah['count'].")";
?>