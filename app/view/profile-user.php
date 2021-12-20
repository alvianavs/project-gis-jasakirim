<?php require_once 'app/config.php'; ?>
<!-- Page Heading -->
<div class="mb-4">
  <h1 class="h3 mb-0 text-gray-800">Profile dan ulasan kamu</h1>
</div>

<div class="row px-3">

  <div class="col-4">
    <div class="card shadow p-0">
      <div class="card-header py-3 bg-primary">
        <h6 class="m-0 fw-bold text-white">Profile</h6>
      </div>
      <div class="card-body text-center">
        <?php
        $query = "SELECT * FROM user WHERE id=".$_SESSION['user_id'];
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        ?>
        <img class="img-profile rounded-circle w-50" src="assets/img/undraw_profile.svg">
        <div class="mt-3">
          <h6 class="fw-bold text-uppercase"><?= $row['nama'] ?></h6>
          <div class="fw-bold">@<?= $row['username'] ?></div>
          <div class="fw-bold"><?= $row['email'] ?></div>
        </div>
      </div>
      <div class="card-footer">
        <div class="small float-end">Since <?= date('l, M Y', strtotime($row['created_at'])) ?></div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow p-0">
      <div class="card-header py-3 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">Data tabel ulasan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-gray-300 text-dark">
              <tr>
                <th>No</th>
                <th>Nama jasa</th>
                <th>Rating</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              <?php
              $query = "SELECT j.id AS id_jasa, j.nama, j.alamat, r.* FROM jasa_kirim j, ulasan r WHERE j.id=r.jasa_kirim_id AND r.user_id=".$_SESSION['user_id'];

              $result = mysqli_query($conn, $query);
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td class="small">
                    <a href="/project-akhir-gis/index.php?page=jasa-detail&&idjasa=<?= $row['id_jasa'] ?>" class="text-decoration-none"><?= $row['nama'] ?></a>
                  </td>
                  <td class="text-warning"><small>
                    <?php for($i = 1; $i < 6; $i++) {
                      if ($row['rating'] >= $i) { ?>
                        <i class="fas fa-star"></i>
                      <?php } else { ?>
                        <i class="far fa-star"></i>
                      <?php }
                    } ?>
                  </small>
                </td>
                <td><small><?= $row['deskripsi'] ?></small></td>
                <td>
                  <small><?= date('H:i l, M Y', strtotime($row['updated_at'])) ?></small>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- DataTales Example -->
</div>
