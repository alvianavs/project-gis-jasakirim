<?php
$row = array();
require_once 'app/config.php';
if (isset($_GET['idjasa'])) {
    $query = "SELECT * FROM jasa_kirim WHERE id=".$_GET['idjasa'];
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $query2 = "SELECT COUNT(id) as count FROM ulasan WHERE jasa_kirim_id=".$row['id'];
            $jumlah = mysqli_fetch_assoc(mysqli_query($conn, $query2));

            $query3 = "SELECT ROUND(AVG(rating),1) as rata FROM ulasan WHERE jasa_kirim_id=".$row['id'];
            $avg = mysqli_fetch_assoc(mysqli_query($conn, $query3));
        } else {
            include 'page-404.php';
            exit;
        }
    }
}
?>

<!-- Page ini punya map -->
<div id="hasMap" onload="getJumlahUlasan(<?= $row['id'] ?>)">
    <!-- Page Heading -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Jasa Pengiriman</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-6">
            <img src="/project-akhir-gis/assets/img/upload/<?= $row['image'] ?>" class="img-fluid rounded">
            <div class="p-3">
                <h1 class="h3 text-gray-800 d-flex justify-content-between align-items-center"><?= $row['nama'] ?>
                <div>
                    <a href="/project-akhir-gis/index.php?page=jasa&&idjasa=<?= $row['id'] ?>" class="me-1 text-primary fs-5"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0);" class="fs-4" id="btnSetLocation" onclick="setLocation(<?= $row['lat'] ?>,<?= $row['lng'] ?>,<?= $row['id'] ?>)"><i class="text-primary fas fa-map-marker-alt"></i></a>
                </div>
            </h1>
            <div class="text-warning">
                <?php 
                $rata_rata = floatval($avg['rata']);
                
                ?>
                <small class="text-gray-800"><?= $rata_rata ?></small>
                <?php for ($i = 1; $i < 6; $i++) {
                    if ($rata_rata >= $i) { ?>
                        <i class="fas fa-star"></i>
                    <?php } else {
                        $x = $rata_rata - $i+1;
                        if ($x < 1 && $x > 0) { ?>
                            <i class="fas fa-star-half-alt"></i>
                        <?php } else { ?>
                            <i class="far fa-star"></i>
                        <?php }
                    }
                }
                ?>
                <small class="text-primary"><?= $jumlah['count'] ?> ulasan</small>
            </div>
            <hr class="mb-0">
            <table class="table table-hover table-borderless">
                <tr>
                    <td style="width: 25%" class="text-center align-middle">
                        <i class="text-success fs-5 fas fa-map-marker-alt"></i>
                    </td>
                    <td><?= $row['alamat'] ?></td>
                </tr>
                <tr>
                    <td class="text-center align-middle">
                        <i class="text-success fs-5 fas fa-phone"></i>
                    </td>
                    <td><?= $row['no_hp'] ?></td>
                </tr>
                <tr>
                    <td class="text-center align-middle">
                        <i class="text-success fs-5 fas fa-info-circle"></i>
                    </td>
                    <td><?= $row['deskripsi'] ?></td>
                </tr>
            </table>
            <div id="sectionUlasan">
                <?php
                $sql = "SELECT * FROM ulasan WHERE jasa_kirim_id=".$row['id']." AND user_id=".$_SESSION['user_id'];
                $data = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($data);
                ?>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-gray-800" id="labelJumlahUlasan">Ulasan (<?= $jumlah['count'] ?>)</h5>
                    <a id="tombol-collapse-ulasan" href="javascript:void(0);" class="text-primary text-decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseRating" aria-expanded="false" aria-controls="collapseRating" onclick="setRating(<?= $data['rating'] ?>)"><small><?php echo (isset($data['id'])) ? 'edit ulasan' : 'beri ulasan' ?></small></a>
                </div>
                <hr class="mt-1">
                
                <div class="collapse" id="collapseRating" style="transition: .3s;">
                    <div class="card card-body">

                        <form class="user" id="formSaveUlasan" method="POST">
                            <div class="form-group mb-0">
                                <div class="fs-5 text-center">
                                    <a href="javascript:void(0);" class="text-decoration-none text-warning" onclick="setRating(1)"><i class="far fa-star star-1"></i></a>
                                    <a href="javascript:void(0);" class="text-decoration-none text-warning" onclick="setRating(2)"><i class="far fa-star star-2"></i></a>
                                    <a href="javascript:void(0);" class="text-decoration-none text-warning" onclick="setRating(3)"><i class="far fa-star star-3"></i></a>
                                    <a href="javascript:void(0);" class="text-decoration-none text-warning" onclick="setRating(4)"><i class="far fa-star star-4"></i></a>
                                    <a href="javascript:void(0);" class="text-decoration-none text-warning" onclick="setRating(5)"><i class="far fa-star star-5"></i></a>
                                    <small class="text-primary" id="numRating">0</small>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id'] ?>">
                                <input type="hidden" name="id" id="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="rating" id="rating" value="">
                                <input type="text" class="mt-3 form-control form-control-user" id="ulasan" name="ulasan" placeholder="Tulis ulasan..." value="<?php echo (isset($data['deskripsi'])) ? $data['deskripsi'] : ''; ?>" required>
                            </div>
                            <div class="mt-2 d-flex justify-content-end align-items-center">
                                <?php if(isset($data['id'])) : ?>
                                    <a href="javascript:void(0);" class="btn btn-warning btn-user px-3 py-2 m-2 fw-bold text-uppercase"><i class="fas fa-trash"></i> Hapus</a>
                                <?php endif; ?>
                                <button type="submit" name="submit" class="btn btn-primary btn-user px-3 py-2 m-2 fw-bold text-uppercase"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-borderless text-gray-700" id="listUlasan">
                    <?php
                    $query = "SELECT u.id, s.nama AS nama_user, u.rating, u.deskripsi, j.nama, u.updated_at FROM ulasan u, user s, jasa_kirim j WHERE u.jasa_kirim_id = j.id AND u.user_id = s.id AND j.id = ".$row['id'];
                    $data = mysqli_query($conn, $query);

                    if (mysqli_num_rows($data) > 0) {
                        while ($row = mysqli_fetch_assoc($data)) {

                            ?>
                            <tr>
                                <td class="d-flex align-items-center">
                                    <img src="https://picsum.photos/50?random=<?= $row['id'] ?>" class="img-fluid rounded-circle">
                                    <div class="ms-3">
                                        <span><?= $row['nama_user'] ?></span><br>
                                        <small><?= date('H:i l, M Y', strtotime($row['updated_at'])) ?></small>
                                    </div>
                                </td>
                                <td class="align-middle text-warning text-center">
                                    <?php for($i = 1; $i < 6; $i++) {
                                        if ($row['rating'] >= $i) { ?>
                                            <i class="fas fa-star"></i>
                                        <?php } else { ?>
                                            <i class="far fa-star"></i>
                                        <?php }
                                    } ?>
                                    <br>
                                    <small><?= $row['rating'] ?> bintang</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="pt-0" colspan="2">
                                    <span class="ps-3"><?= $row['deskripsi'] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="pt-0"><hr class="m-0 border-0"></td>
                            </tr>
                            <?php
                        } 
                    } else { ?>
                        <tr>
                            <td>Tidak ada ulasan</td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>

            </div>
        </div>
    </div>
    <div class="col">
        <div id="map" class="rounded" style="width: 100%; height:500px;"></div>
    </div>

    <!-- Content Row -->
</div>