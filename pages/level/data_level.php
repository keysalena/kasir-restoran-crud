<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6> DATA LEVEL </h6>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
        </div>
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Isi modal dengan inputan tambah data -->
                <form method="POST" action="level/tambah_level.php">
                  <div class="mb-3">
                    <label for="nama_masakan" class="form-label">Nama Level</label>
                    <input type="text" class="form-control" id="nama_level" name="nama_level">
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
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA LEVEL</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conf/conn.php";
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id_level DESC")
                  or die(mysqli_error($koneksi));
                while ($row = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td>
                      <h6 class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></h6>
                    </td>
                    <td>
                      <h6 class="align-middle text-center text-sm"><?php echo $row['nama_level']; ?></h6>
                    </td>
                    <td class="align-middle">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="level/hapus_level.php?id=<?php echo $row['id_level']; ?>"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <a class="btn btn-link text-dark px-3 mb-0" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id_level']; ?>"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    </td>
                    <div class="modal fade" id="editModal<?php echo $row['id_level']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Level</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <!-- Isi modal dengan inputan edit -->
                            <form method="POST" action="level/ubah_level.php">
                              <input type="hidden" name="id_level" value="<?php echo $row['id_level']; ?>">
                              <div class="mb-3">
                                <label for="nama_level" class="form-label">Nama level</label>
                                <input type="text" class="form-control" id="nama_level" name="nama_level" value="<?php echo $row['nama_level']; ?>">
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
                        "searchPlaceholder": "Search level", // Search input placeholder
                      }
                    });
                  });
                </script>