<?php
require_once '../config.php';

$id = $_REQUEST['id'];
$urlGet = $_REQUEST['url'];

$query = "SELECT j.*, ROUND(AVG(u.rating),1) AS rata_rata FROM jasa_kirim j, ulasan u WHERE u.jasa_kirim_id = j.id AND j.id=".$id;

$data = mysqli_query($conn, $query);

$query2 = "SELECT COUNT(id) as count FROM ulasan WHERE jasa_kirim_id=".$id;
$jumlah = mysqli_fetch_assoc(mysqli_query($conn, $query2));


$res = '';
while($row = mysqli_fetch_assoc($data)) {
  $rata_rata = floatval($row["rata_rata"]);
  $ratings = array();
  
  for ($i = 1; $i < 6; $i++) {
      if ($rata_rata >= $i) {
          $ratings[$i] = '<i class="fas fa-star"></i>';
      } else {
          $x = $rata_rata - $i+1;
          if ($x < 1 && $x > 0) {
              $ratings[$i] = '<i class="fas fa-star-half-alt"></i>';
          } else {
            $ratings[$i] = '<i class="far fa-star"></i>';
          }
      }
  }
  $route = '';
  if ($urlGet == 'cari-rute') {
    $route = '<a href="javascript:void(0)" class="text-success me-2" onclick="return setRouteStart('.$row['lat'].','.$row['lng'].')"><i class="fas fa-home"></i> Dari sini</a><a href="javascript:void(0)" class="text-primary" onclick="return setRouteEnd('.$row['lat'].','.$row['lng'].')"><i class="fas fa-map-pin"></i> Ke sini</a>';
  }

	$res = '
  <div class="card mb-4 border-0 overflow-hidden">
  <div class="p-2 bg-primary fw-bold text-light text-uppercase d-flex justify-content-between" style="font-size: 11px">
  '.$row['nama'].'
  <a href="/project-akhir-gis/index.php?page=jasa&&idjasa='.$row['id'].'" class="me-1 text-white"><i class="fas fa-edit"></i></a>
  </div>
  <div class="card-body p-2">
  <div class="text-warning" id="ratings">
  <small class="text-gray-800">'. $rata_rata .'</small>
  '. $ratings[1] .'
  '. $ratings[2] .'
  '. $ratings[3] .'
  '. $ratings[4] .'
  '. $ratings[5] .'
  <small class="text-primary">'. $jumlah['count'] .' ulasan</small>
  </div>
  <div class="row mt-2">
  <i class="col-2 d-flex text-success pe-0 justify-content-center align-items-center fas fa-map-marker-alt"></i>
  <small class="col ps-0">'.$row['alamat'].'</small>
  </div>
  <div class="row mt-2">
  <i class="col-2 d-flex text-success pe-0 justify-content-center align-items-center fas fa-phone"></i>
  <small class="col ps-0">'.$row['no_hp'].'</small>
  </div>
  </div>
  <small class="card-footer py-1 bg-white d-flex justify-content-between">
  <div>
  '.$route.'
  </div>
  <a class="ms-3" href="http://localhost/project-akhir-gis/index.php?page=jasa-detail&&idjasa='.$row[
    'id'].'">Detail</a>
  </small>
  </div>
  ';
}

echo $res;
?>