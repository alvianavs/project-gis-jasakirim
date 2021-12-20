<?php
require_once '../config.php';

$key = $_REQUEST['key'];

$query = "SELECT * FROM jasa_kirim WHERE nama LIKE '%$key%' OR alamat LIKE '%$key%'";

$data = mysqli_query($conn, $query);

$res = array();
while($row = mysqli_fetch_assoc($data)) {
	echo '<a class="px-3 py-1 text-decoration-none d-flex align-items-center" href="#" onclick="setLocation('.$row['lat'].','. $row['lng'].','. $row['id'].')">
      <div class="fw-normal">
        <div class="text-truncate text-primary">'.$row["alamat"].'</div>
        <div class="small text-gray-600">'.$row['nama'].'</div>
      </div>
    </a>';
}
?>