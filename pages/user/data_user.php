<head>
  <script src="script.js"></script>
</head>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>DATA USER</h6>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
        </div>
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Isi modal dengan inputan tambah data -->
                <form method="POST" action="user/tambah_user.php">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="mb-3">
                    <label for="nama_user" class="form-label">Nama User</label>
                    <input type="text" class="form-control" id="nama_user" name="nama_user">
                  </div>
                  <div class="mb-3">
                    <label for="nama_level" class="form-label">Nama Level</label>
                    <select class="form-control" name="id_level">
                      <option value="">-Pilih Level-</option>
                      <option value="1">Administrator</option>
                      <option value="2">Waiter</option>
                      <option value="3">Kasir</option>
                      <option value="4">Owner</option>
                      <option value="5">Pelanggan</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body px-6 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 custom-table" id="level">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USERNAME</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PASSWORD</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA USER</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA LEVEL</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conf/conn.php";
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT user.*, level.nama_level FROM user 
                inner join level on user.id_level=level.id_level
                 ORDER BY user.id_user DESC")
                  or die(mysqli_error($koneksi));
                while ($row = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td>
                      <h6 class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></h6>
                    </td>
                    <td>
                      <h6 class="align-middle text-center text-sm"><?php echo $row['username']; ?></h6>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <h6 class="align-middle text-center text-sm">*************</h6>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <h6 class="align-middle text-center text-sm"><?php echo $row['nama_user']; ?></h6>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <h6 class="align-middle text-center text-sm"><?php echo $row['nama_level']; ?></h6>
                    </td>
                    <td class="align-middle">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="../proses/hapus_user.php?id=<?php echo $row['id_user']; ?>"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <a class="btn btn-link text-dark px-3 mb-0" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id_user']; ?>"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    </td>
                    <div class="modal fade" id="editModal<?php echo $row['id_user']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <!-- Isi modal dengan inputan edit -->
                            <form method="POST" action="/user/ubah_user.php">
                              <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                              <div class="mb-3">
                                <label for="nama_user" class="form-label">Usename</label>
                                <input type="text" class="form-control" id="nama_user" name="username" value="<?php echo $row['username']; ?>">
                              </div>
                              <div class="mb-3">
                                <label for="harga" class="form-label">Password</label>
                                <input type="password" class="form-control" id="harga" name="password" value="<?php echo $row['password']; ?>">
                              </div>
                              <div class="mb-3">
                                <label for="nama_user" class="form-label">Nama User</label>
                                <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?php echo $row['nama_user']; ?>">
                              </div>
                              <div class="mb-3">
                                <label for="id_level" class="form-label">Nama Level</label>
                                <select class="form-control" name="id_level">
                                  <option value="1" <?php if ($row['id_level'] == 1) echo 'selected'; ?>>Administrator</option>
                                  <option value="2" <?php if ($row['id_level'] == 2) echo 'selected'; ?>>Waiter</option>
                                  <option value="3" <?php if ($row['id_level'] == 3) echo 'selected'; ?>>Kasir</option>
                                  <option value="4" <?php if ($row['id_level'] == 4) echo 'selected'; ?>>Owner</option>
                                  <option value="5" <?php if ($row['id_level'] == 5) echo 'selected'; ?>>Pelanggan</option>
                                </select>
                              </div>

                              <!-- Tambahkan input lain sesuai kebutuhan -->
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>
                <?php } ?>
                <script>
                  $(document).ready(function() {
                    $('#level').DataTable({
                      "pagingType": "full_numbers", // Add pagination
                      "lengthMenu": [10, 25, 50, 75, 100], // Items per page options
                      "processing": true, // Show processing indicator
                      "searching": true, // Enable search
                      "ordering": true, // Enable ordering
                      "info": true, // Show table information
                      "autoWidth": true, // Disable auto-width
                      "responsive": true, // Enable responsive design
                      "language": {
                        "search": "_INPUT_", // Search input customization
                        "searchPlaceholder": "Search user", // Search input placeholder
                      }
                    });
                  });
                </script>