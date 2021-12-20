<?php
require_once '../config.php';
header("Content-Type: application/json");

$id = $_POST['id'];
$rating = $_POST['rating'];
$ulasan = $_POST['ulasan'];

// Ini user yang login
$idUser = $_POST['user_id'];

$check = "SELECT COUNT(id) as id FROM ulasan WHERE jasa_kirim_id=$id AND user_id=$idUser";
$data = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($data);
if ($row['id'] > 0) {
	$query = "UPDATE ulasan SET rating=$rating, deskripsi='$ulasan', updated_at=NOW() WHERE jasa_kirim_id=$id AND user_id=$idUser";
	if(mysqli_query($conn, $query)) {
		echo json_encode([
			"success" => true,
			"message" => "Ulasan anda berhasil diupdate",
			"rating" => $rating,
		]);
		die;
	} else{
		echo json_encode([
			"success" => false,
			"message" => "Ulasan anda gagal diupdate",
			"rating" => $rating,
		]);
		die;
	}
} else {
	$query = "INSERT INTO ulasan VALUES ('', $id, $idUser, $rating, '$ulasan', NOW(), NOW())";

	if(mysqli_query($conn, $query)) {
		echo json_encode([
			"success" => true,
			"message" => "Ulasan anda berhasil disimpan",
			"rating" => $rating,
		]);
		die;
	} else{
		echo json_encode([
			"success" => false,
			"message" => "Ulasan anda gagal disimpan",
			"rating" => $rating,
		]);
		die;
	}
}
?>