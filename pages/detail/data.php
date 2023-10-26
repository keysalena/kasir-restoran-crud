<?php
include "../conf/conn.php";
$query = mysqli_query($koneksi, "SELECT detail_order.qty, masakan.nama_masakan, `order`.no_meja, user.nama_user, SUM(detail_order.total) AS total_bayar, detail_order.keterangan, detail_order.id_detail_order, detail_order.id_order
FROM detail_order
INNER JOIN masakan ON detail_order.id_masakan = masakan.id_masakan
INNER JOIN `order` ON detail_order.id_order = `order`.id_order
INNER JOIN user ON `order`.id_user = user.id_user
GROUP BY `order`.no_meja, user.nama_user, `order`.id_order
ORDER BY `order`.id_order DESC")
  or die(mysqli_error($koneksi));

?>

<head>
  <script src="script.js"></script>
</head>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>DATA DETAIL ORDER</h6>
        </div>

        <div class="card-body px-6 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 custom-table" id="level">
              <div id="detail-content">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO MEJA</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA USER</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KETERANGAN</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AKSI</th>
                  </tr>
                </thead>
                <?php
                $no = 0;
                while ($row = mysqli_fetch_array($query)) {
                  $no_meja = $row['no_meja'];
                  $nama_user = $row['nama_user'];
                  $total_bayar = $row['total_bayar'];

                ?>
                  <tr>
                    <td class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></td>
                    <td class="align-middle text-center text-sm"><?php echo $no_meja; ?></td>
                    <td class="align-middle text-center text-sm"><?php echo $nama_user; ?></td>
                    <td class="align-middle text-center text-sm">Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></td>
                    <td class="align-middle text-center text-sm">
                      <?php
                      if ($row['keterangan'] == 'diproses') {
                        echo '<span class="badge badge-sm bg-gradient-secondary">Diproses</span>';
                      } elseif ($row['keterangan'] == 'selesai') {
                        echo '<span class="badge badge-sm bg-gradient-success">Selesai</span>';
                      }
                      ?>                    <td class="align-middle text-center text-sm">

                      <!-- <a herf="index.php?page=detail_order&id_order=<?= $row['id_order']; ?>>" class="btn btn-link text-info text-gradient px-3 mb-0">
                        <i class="glyphicon glyphicon-list"></i>Detail
                      </a> -->
                      <a href="../pages/index.php?page=detail_order&id_order=<?= $row['id_order']; ?>" class="btn btn-link text-info text-gradient px-3 mb-0"><i class="glyphicon glyphicon-list"></i>Detail</a>

                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="detail/hapus.php?id=<?php echo $row['id_order']; ?>"><i class="far fa-trash-alt me-2"></i>Delete</a>

                    </td>
                  </tr>

                <?php }

                ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
        "searchPlaceholder": "Search masakan", // Search input placeholder
      }
    });
  });
</script>