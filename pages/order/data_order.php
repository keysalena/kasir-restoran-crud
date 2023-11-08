                <?php
                include "../conf/conn.php";
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT `order`.*, user.nama_user FROM `order`
                INNER JOIN user ON `order`.id_user = user.id_user
                ORDER BY `order`.id_order DESC")
                  or die(mysqli_error($koneksi)); ?>

                <head>
                  <script src="script.js"></script>
                </head>
                <div class="container-fluid py-4">
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h6>DATA ORDER</h6>
                          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">NO Meja</button>
                        </div>
                        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">NO MEJA</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <!-- Isi modal dengan inputan tambah data -->
                                <form method="POST" action="order/tambah_order.php">
                                  <div class="mb-3">
                                    <label for="nama_masakan" class="form-label">No Meja</label>
                                    <input type="text" class="form-control" id="no_meja" name="no_meja">
                                  </div>
                                  <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                                  <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body px-6 pt-0 pb-2">
                          <div class="table-responsive p-0"><?php
                                                            if ($_SESSION["nama_level"] == 'Administrator' || $_SESSION["nama_level"] == 'Waiter') { ?>
                              <table class="table align-items-center mb-0 custom-table" id="level">
                                <thead>
                                  <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO MEJA</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TANGGAL</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA USER</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KETERANGAN</th>
                                    <th class="text-secondary opacity-7"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                                              while ($row = mysqli_fetch_array($query)) {
                                  ?>
                                    <tr>
                                      <td>
                                        <h6 class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></h6>
                                      </td>
                                      <td>
                                        <h6 class="align-middle text-center text-sm">NO. <?php echo $row['no_meja']; ?></h6>
                                      </td>
                                      <td>
                                        <h6 class="align-middle text-center text-sm"><?php echo $row['tanggal']; ?></h6>
                                      </td>
                                      <td>
                                        <h6 class="align-middle text-center text-sm"><?php echo $row['nama_user']; ?></h6>
                                      </td>
                                      <td class="align-middle text-center text-sm">
                                        <?php
                                                                if ($row['keterangan'] == 'belum pesan') {
                                                                  echo '<span class="badge badge-sm bg-gradient-secondary">Belum pesan</span>';
                                                                } elseif ($row['keterangan'] == 'sudah pesan') {
                                                                  echo '<span class="badge badge-sm bg-gradient-success">Sudah Pesan</span>';
                                                                }
                                        ?>
                                      </td>
                                      <td class="align-middle">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="order/hapus.php?id=<?php echo $row['id_order']; ?>"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                      </td>
                                      </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    </tr>
                <?php
                                                              }
                                                            }
                                                            if ($_SESSION["nama_level"] == 'Pelanggan') {
                                                              // Membuat array untuk menyimpan status nomor meja
                                                              $no_meja_status = array();

                                                              // Mengambil data nomor meja dari tabel order
                                                              $queryOrder = mysqli_query($koneksi, "SELECT no_meja FROM `order` WHERE keterangan = 'belum pesan'");
                                                              while ($row = mysqli_fetch_assoc($queryOrder)) {
                                                                $no_meja_status[$row['no_meja']] = true;
                                                              }

                                                              echo '<table class="table align-items-center mb-0 custom-table">';
                                                              $start_number = 1;
                                                              for ($i = 1; $i <= 4; $i++) {
                                                                echo '<tr>';
                                                                for ($j = 1; $j <= 10; $j++) {
                                                                  if (isset($no_meja_status[$start_number])) {
                                                                    // Nomor meja telah digunakan
                                                                    echo '<td>---</td>';
                                                                  } else {
                                                                    echo '<td>' . $start_number . '</td>';
                                                                    // Nomor meja belum digunakan
                                                                  }
                                                                  $start_number++;
                                                                }
                                                                echo '</tr>';
                                                              }
                                                              echo '</table>';
                                                            }
                ?>

                <script>
                  $(document).ready(function() {
                    $('#level').DataTable({
                      "pagingType": "full_numbers", // Add pagination
                      "lengthMenu": [5, 10, 25, 50, 75, 100], // Items per page options
                      "processing": true, // Show processing indicator
                      "searching": true, // Enable search
                      "ordering": true, // Enable ordering
                      "info": true, // Show table information
                      "autoWidth": true, // Disable auto-width
                      "responsive": true, // Enable responsive design
                      "language": {
                        "search": "_INPUT_", // Search input customization
                        "searchPlaceholder": "Search data", // Search input placeholder
                      }
                    });
                  });
                </script>