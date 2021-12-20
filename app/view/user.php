<!-- Page Heading -->
<div class="mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data user</h1>
</div>

<div class="row px-4">
  <!-- DataTales Example -->
  <div class="card shadow p-0">
    <div class="card-header py-3 bg-primary">
      <h6 class="m-0 font-weight-bold text-white">Data table user</h6>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-gray-300 text-dark">
            <tr>
                <th>No</th>
                <th>Nama user</th>
                <th>Username</th>
                <th>Email</th>
                <th>Tanggal register</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php
            require_once 'app/config.php';
            $query = "SELECT nama, username, email, created_at FROM user";
            $result = mysqli_query($conn, $query);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td>
                    <small><?= date('H:i l, M Y', strtotime($row['created_at'])) ?></small>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
