<!-- Page Heading -->
<div class="mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data ulasan jasa dari user</h1>
</div>

<div class="row px-4">
  <!-- DataTales Example -->
  <div class="card shadow p-0">
    <div class="card-header py-3 bg-primary">
      <h6 class="m-0 font-weight-bold text-white">Data Table Ulasan</h6>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-gray-300 text-dark">
            <tr>
              <th>No</th>
              <th>Nama jasa</th>
              <th>User</th>
              <th>Rating</th>
              <th>Deskripsi</th>
              <th>Tanggal</th>
          </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
        require_once 'app/config.php';
        $query = "SELECT r.id AS id_ulasan, j.id AS id_jasa, j.nama AS nama_jasa, u.nama AS nama_user, r.rating, r.deskripsi, r.updated_at FROM ulasan r, user u, jasa_kirim j WHERE j.id = r.jasa_kirim_id AND u.id = r.user_id";
        $result = mysqli_query($conn, $query);
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td>
                  <a href="/project-akhir-gis/index.php?page=jasa-detail&&idjasa=<?= $row['id_jasa'] ?>" class="text-decoration-none"><?= $row['nama_jasa'] ?></a>
              </td>
              <td><?= $row['nama_user'] ?></td>
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
