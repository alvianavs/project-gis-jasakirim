<?php
$row = array();
if (isset($_GET['idjasa'])) {
    require_once 'app/config.php';
    $query = "SELECT * FROM jasa_kirim WHERE id=".$_GET['idjasa'];
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<!-- Page ini punya map -->
<div id="hasMap">
    <!-- Page Heading -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jasa Pengiriman Barang</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-5">
            <form class="user p-3" id="<?php echo ($row == null) ? 'formTambahJasa':'formEditJasa' ?>" method="post">
                <?php if($row != null) : ?>
                    <input type="hidden" name="id" id="id" value="<?= $row['id'] ?>">
                <?php endif; ?>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="nama" id="nama" placeholder="Nama jasa..." value="<?php echo (isset($row['nama'])) ? $row['nama'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="alamat" id="alamat" placeholder="Alamat..." value="<?php echo (isset($row['alamat'])) ? $row['alamat'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="nohp" id="nohp" placeholder="No telepon..." value="<?php echo (isset($row['no_hp'])) ? $row['no_hp'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="deskripsi" id="deskripsi" placeholder="Deskripsi..." value="<?php echo (isset($row['deskripsi'])) ? $row['deskripsi'] : ''; ?>" required>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="lat" id="lat" placeholder="Latitude..." value="<?php echo (isset($row['lat'])) ? $row['lat'] : ''; ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="lng" id="lng" placeholder="Longitude..." value="<?php echo (isset($row['lng'])) ? $row['lng'] : ''; ?>" required>
                    </div>
                </div>
                <?php if($row == null) : ?>
                    <div class="form-group">
                      <input class="form-control" name="file" type="file" id="file" style="font-size: 0.8rem" required>
                  </div>
              <?php endif; ?>
              <div class="d-flex gap-2">
                <?php if ($row != null) : ?>
                    <a href="http://localhost/project-akhir-gis/index.php?page=jasa" type="button" class="btn bg-gray-400 text-dark btn-user btn-block fw-bold text-uppercase"><i class="fas fa-times"></i>
                         CANCEL
                    </a>
                <?php endif; ?>
                <button type="submit" name="submit" class="btn btn-primary mt-0 btn-user btn-block fw-bold text-uppercase"><i class="fas fa-save"></i>
                    <?php echo ($row == null) ? ' SAVE':' UPDATE' ?>
                </button>
            </div>

            <div class="text-center mt-3"><a href="/project-akhir-gis/index.php?page=jasa-tabel">Lihat data tabel</a></div>
        </form>
    </div>
    <div class="col">
        <div id="map" class="rounded" style="width: 100%; height:500px;"></div>
    </div>
</div>

<!-- Content Row -->
</div>