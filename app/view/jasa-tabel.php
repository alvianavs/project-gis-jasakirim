<!-- Page Heading -->
<div class="mb-4">
      <h1 class="h3 mb-0 text-gray-800">Jasa Pengiriman Barang</h1>
</div>

<!-- Content Row -->
<div class="row px-4">
      <!-- DataTales Example -->
      <div class="card shadow p-0">
            <div class="card-header py-3 bg-primary d-flex justify-content-between">
                  <h6 class="m-0 font-weight-bold text-white">Data Table Jasa</h6>
                  <a href="/project-akhir-gis/index.php?page=jasa" class="text-white text-decoration-none"><i class="fas fa-plus me-1"></i> Tambah data</a>
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                              <thead class="bg-gray-300 text-dark">
                                    <tr>
                                          <th>No</th>
                                          <th>Nama jasa</th>
                                          <th>Alamat</th>
                                          <th>No HP</th>
                                          <th>Lat/Lng</th>
                                          <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody class="text-gray-700">
                                    <?php
                                    require_once 'app/config.php';
                                    $query = "SELECT * FROM jasa_kirim";
                                    $data = mysqli_query($conn, $query);
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($data)) { ?>
                                          <tr class="ID-<?= $row['id'] ?>">
                                                <td><?= $no++ ?></td>
                                                <td>
                                                      <a href="/project-akhir-gis/index.php?page=jasa-detail&&idjasa=<?= $row['id'] ?>" class="text-decoration-none"><?= $row['nama'] ?></a>
                                                </td>
                                                <td class="small"><?= $row['alamat'] ?></td>
                                                <td><?= $row['no_hp'] ?></td>
                                                <td><?= $row['lat'] ?><br><?= $row['lng'] ?></td>
                                                <td>
                                                      <a href="/project-akhir-gis/index.php?page=jasa&&idjasa=<?= $row['id'] ?>" class="me-1 text-primary"><i class="fas fa-pen-square"></i></a>
                                                      <a href="javascript:void(0);" class="me-1 text-danger" onclick="hapusJasa(<?= $row['id'] ?>,'<?= $row['image'] ?>')"><i class="fas fa-trash"></i></a>
                                                      <a href="javascript:void(0);" id="editImgJasa" data-id="<?= $row['id'] ?>" data-img="<?= $row['image'] ?>" class="me-1 text-success"><i class="fas fa-eye"></i></a>
                                                </td>
                                          </tr>
                                          <?php
                                    }
                                    ?>
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
</div>

<div class="position-fixed top-50 start-50 translate-middle" style="display: none; z-index: 1055" id="modalImg">
      <div class="modal-dialog">
            <div class="modal-content shadow">
                  <div class="modal-header">
                        <h5 class="modal-title">Update image</h5>
                        <button class="close" type="button" aria-label="Close" onclick="closeModal()">
                              <span aria-hidden="true">×</span>
                        </button>
                  </div>

                  <form id="formUpdateImg" method="post">
                        <div class="modal-body pb-0">
                              <input type="hidden" name="idJasa" id="idJasa" value="">
                              <input type="hidden" name="oldImg" id="oldImg" value="">
                              <img id="imgPreview" src="" class="img-fluid rounded mx-auto d-block">
                              <div class="form-group mt-3">
                                    <input type="file" class="form-control" name="file" id="inputUpdateImg" style="font-size: 0.8rem" required>
                              </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" onclick="closeModal()">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                      </div>
                </form>
          </div>
    </div>
</div>
<div class="modal-backdrop" style="opacity: .4; display: none"></div>
