<?php
if (!empty($_SESSION['kantong_belanja'])) {
?>

  <head>
    <script src="script.js"></script>
  </head>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>DATA PESANAN</h6>
          </div>
          <div class="card-body px-6 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0 custom-table" id="masakan">
                <thead>
                  <tr align="center">
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA MASAKAN</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HARGA</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PEMBELIAN</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($_SESSION['kantong_belanja'])) {
                    $cart = unserialize(serialize($_SESSION['kantong_belanja']));
                    $index = 0;
                    $no = 1;
                    $total = 0;
                    $total_bayar = 0;
                    for ($i = 0; $i < count($cart); $i++) {
                      $total = $_SESSION['kantong_belanja'][$i]['harga'] *
                        $_SESSION['kantong_belanja'][$i]['pembelian'];
                      $total_bayar += $total;
                  ?>
                      <tr>
                        <td align="center"><?= $no++; ?></td>
                        <td class="align-middle text-center text-sm"><?= $cart[$i]['nama_masakan']; ?></td>
                        <td align="center"><?= $cart[$i]['pembelian']; ?></td>
                        <td class="align-middle text-center text-sm"><?= 'Rp ' . number_format($cart[$i]['harga'], 0, ',', '.') ?></td>
                        <td class="align-middle text-center text-sm"><?= 'Rp ' . number_format($total, 0, ',', '.') ?></td>
                      </tr>
                    <?php
                      $index++;
                    }
                    ?>
                    <tr>
                      <td colspan="4" align="right"><strong>Total Bayar</strong></td>
                      <td><strong><?= 'Rp ' . number_format($total_bayar, 0, ',', '.') ?></strong></td>
                      <td align="center">
                      </td>
                    </tr>
                    <form method="POST" action="pesan/pesan_proses.php">
                      <tr>
                        <td>Total Belanja</td>
                        <td><input class="form-control" type="number" name="total_bayar" id="total" value="<?= $total_bayar; ?>" readonly></td>
                      </tr>
                      <tr>
                        <td>No Meja</td>
                        <td><input class="form-control pencarian" type="text" name="no_meja" id="no_meja" placeholder="Pilih No Meja"readonly></td>
                      </tr>
                      <input class="form-control pencarian" type="hidden" name="id_order" id="id_order" readonly>
                      <tr>
                        <td colspan="2" align="right"><button type="submit" class="btn btn-primary" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i>
                            Pesan</button>
                        </td>
                      </tr>
                    </form>
                </tbody>

              </table>
              <br>
              <hr>
          <?php
                  }
                }
          ?>

          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title card-header pb-0">DATA ORDER</h4>
                </div>
                <div class="modal-body">
                <table class="table align-items-center mb-3 custom-table" id="produk">
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO MEJA</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TANGGAL</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA USER</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KETERANGAN</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include "../conf/conn.php";
                      $no = 0;
                      $query = mysqli_query($koneksi, "SELECT `order`.*, user.nama_user FROM `order`
            INNER JOIN user ON `order`.id_user = user.id_user
            WHERE `order`.keterangan = 'belum pesan'  
            ORDER BY `order`.id_order DESC")
                        or die(mysqli_error($koneksi));

                      while ($row = mysqli_fetch_array($query)) {
                      ?>
                        <tr class="pilih" data-id_order="<?php echo $row['id_order']; ?>" data-no_meja="<?php echo $row['no_meja']; ?>">
                          <td class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></td>
                          <td class="align-middle text-center text-sm"><?php echo $row['no_meja']; ?></td>
                          <td class="align-middle text-center text-sm"><?php echo $row['tanggal']; ?></td>
                          <td class="align-middle text-center text-sm"><?php echo $row['nama_user']; ?></td>
                          <td class="align-middle text-center text-sm"><?php echo $row['keterangan']; ?></td>
                          <td class="align-middle text-center text-sm"></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            $(document).ready(function() {
              $(".pencarian").focusin(function() {
                $("#myModal").modal('show'); // ini fungsi untuk menampilkan modal
              });
              $('#produk').DataTable();
            });
            $(document).on('click', '.pilih', function(e) {
              document.getElementById("id_order").value = $(this).attr('data-id_order');
              document.getElementById("no_meja").value = $(this).attr('data-no_meja');
              $('#myModal').modal('hide');
            });
          </script>