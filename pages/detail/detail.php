<head>
  <script src="script.js"></script>
</head>
<div class="container-fluid container-sm py-2">
  <div class="row">
    <div class="col-12 mx-auto">
      <div class="card card-sm">
        <div class="card-header pb-0">
          <h6>DETAIL PESANAN</h6>
        </div>
        <?php
        include "../conf/conn.php";

        if (isset($_GET['id_order'])) {
          $id_order = $_GET['id_order'];

          $query = mysqli_query($koneksi, "SELECT user.nama_user, detail_order.qty, masakan.nama_masakan, masakan.harga, detail_order.id_order
              FROM detail_order
              INNER JOIN masakan ON detail_order.id_masakan = masakan.id_masakan
              INNER JOIN `order` ON detail_order.id_order = `order`.id_order
              INNER JOIN user ON `order`.id_user = user.id_user
              WHERE detail_order.id_order = '$id_order'")
            or die(mysqli_error($koneksi));

          $nama_user = "";
          $order_items = array();

          if ($row = mysqli_fetch_array($query)) {
            $nama_user = $row['nama_user'];

            do {
              $order_items[] = array(
                'nama_masakan' => $row['nama_masakan'],
                'harga' => $row['harga'],
                'qty' => $row['qty'],
                'total' => $row['harga'] * $row['qty']
              );
            } while ($row = mysqli_fetch_array($query));
          }
        ?>
          <div class="card-body px-6 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0 custom-table" id="level">
                <thead>
                  <tr>
                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>Nama Masakan</th>
                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>Harga</th>
                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>Qty</th>
                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($order_items as $item) {
                  ?>
                    <tr>
                      <td class='align-middle text-center text-sm'><?= $item['nama_masakan'] ?></td>
                      <td class='align-middle text-center text-sm'>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                      <td class='align-middle text-center text-sm'><?= $item['qty'] ?></td>
                      <td class='align-middle text-center text-sm'>Rp <?= number_format($item['total'], 0, ',', '.') ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php
        } else {
          echo "Invalid request.";
        }
        ?>
        <a href="index.php?page=data_detail" class="btn btn-primary">Kembali</a>
      </div>
    </div>
  </div>
</div>