<head>
  <script src="script.js"></script>
  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      table {
        visibility: visible;
      }
    }
  </style>
</head>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>DATA TRANSAKSI</h6>
          <?php
          if ($_SESSION["nama_level"] == 'Administrator' || $_SESSION["nama_level"] == 'Kasir') {
          ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
          <?php } ?>
          <button class="btn btn-info" onclick="printTable();">Print</button>
        </div>

        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Pilih Data Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Isi modal dengan inputan tambah data -->
                <form method="POST" action="transaksi/tambah_proses.php">
                  <div class="mb-3">
                    <input type="text" name="id_order" id="id_order" class="form-control pencarian" placeholder="Pilih Pelanggan" readonly>
                  </div>
                  <input type="hidden" name="id_user" id="id_user" class="form-control pencarian" readonly required>
                  <input type="hidden" name="id_detail_order" id="id_detail_order" class="form-control pencarian">

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
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA USER</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO MEJA</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TANGGAL</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL BAYAR</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                </tr>
              </thead>
              <tbody>

                <?php
                include "../conf/conn.php";
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC")
                  or die(mysqli_error($koneksi));

                while ($row = mysqli_fetch_array($query)) {
                  $total_bayar = $row['total_bayar'];

                ?>

                  <tr>
                    <td class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></td>
                    <td class="align-middle text-center text-sm"><?php echo $row['nama']; ?></td>
                    <td class="align-middle text-center text-sm"><?php echo $row['nomeja']; ?></td>
                    <td class="align-middle text-center text-sm"><?php echo $row['tanggal']; ?></td>
                    <td class="align-middle text-center text-sm">Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></td>
                    <td class="align-middle text-center text-sm">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="transaksi/hapus.php?id=<?php echo $row['id_transaksi']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');"><i class="far fa-trash-alt me-2"></i>Delete</a>
                    </td>
                  </tr>

                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#level').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [10, 25, 50, 75, 100],
        "processing": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "language": {
          "search": "_INPUT_",
          "searchPlaceholder": "Search level",
        }
  });
});
  </script>
  <script>

  function printTable() {
    var printContents = document.querySelector("#level").outerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
  </html>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DATA DETAIL ORDER</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO MEJA</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA USER</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL BAYAR</th>
              </tr>
            </thead>
            <tbody>

              <?php
              include "../conf/conn.php";
              $query = mysqli_query($koneksi, "SELECT detail_order.qty, masakan.nama_masakan, `order`.no_meja, user.nama_user, SUM(detail_order.total) AS total_bayar, detail_order.keterangan, detail_order.id_detail_order, detail_order.id_order, `order`.id_order, user.id_user
            FROM detail_order
            INNER JOIN masakan ON detail_order.id_masakan = masakan.id_masakan
            INNER JOIN `order` ON detail_order.id_order = `order`.id_order
            INNER JOIN user ON `order`.id_user = user.id_user
            WHERE detail_order.keterangan = 'diproses'  
            GROUP BY `order`.no_meja, user.nama_user, `order`.id_order
            ORDER BY `order`.id_order DESC")
                or die(mysqli_error($koneksi));

              while ($row = mysqli_fetch_array($query)) {
                $no_meja = $row['no_meja'];
                $nama_user = $row['nama_user'];
                $total_bayar = $row['total_bayar'];
              ?>
                <tr class="pilih" data-id_user="<?php echo $row['id_user']; ?>" data-id_order="<?php echo $row['id_order']; ?>" data-id_detail_order="<?php echo $row['id_detail_order']; ?>">
                  <td class="align-middle text-center text-sm"><?php echo $no_meja; ?></td>
                  <td class="align-middle text-center text-sm"><?php echo $nama_user; ?></td>
                  <td class="align-middle text-center text-sm">Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></td>
                  <td class="align-middle text-center text-sm">
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- /.box -->
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
    document.getElementById("id_user").value = $(this).attr('data-id_user');
    document.getElementById("id_order").value = $(this).attr('data-id_order');
    document.getElementById("id_detail_order").value = $(this).attr('data-id_detail_order');
    $('#myModal').modal('hide');
  });
</script>