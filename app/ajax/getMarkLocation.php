<?php
require_once '../config.php';

$query = "SELECT * FROM jasa_kirim";

$data = mysqli_query($conn, $query);

$res = array();
while($row = mysqli_fetch_assoc($data)) {
	$res[] = $row;
}
echo json_encode($res);
?>