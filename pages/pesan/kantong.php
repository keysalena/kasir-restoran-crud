<?php
include "../conf/conn.php";
if (isset($_POST['id_masakan'], $_POST['pembelian'])) {
  $id_masakan = $_POST['id_masakan'];
  $pembelian = $_POST['pembelian'];
  $produk = mysqli_query($koneksi, "SELECT * FROM masakan WHERE id_masakan = '$id_masakan'");
  $dt_produk = $produk->fetch_assoc();

  if (!isset($_SESSION['kantong_belanja'])) $_SESSION['kantong_belanja'] = [];
  $index = -1;
  $cart = unserialize(serialize($_SESSION['kantong_belanja']));
  for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['id_masakan'] == $id_masakan) {
      $index = $i;
      $_SESSION['kantong_belanja'][$i]['pembelian'] = $pembelian;
      break;
    }
  }
  if ($index == -1) {
    $_SESSION['kantong_belanja'][] = [
      'id_masakan' => $id_masakan,
      'nama_masakan' => $dt_produk['nama_masakan'],
      'harga' => $dt_produk['harga'],
      'pembelian' => $pembelian
    ];
  }
}
// var_dump($_SESSION['kantong_belanja']);
if (!empty($_SESSION['kantong_belanja'])) {
?>
  <br>
  <div class="card-body px-6 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0 custom-table" id="level">
        <tr align="center">
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID MASAKAN</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA MASAKAN</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HARGA</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PEMBELIAN</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL</th>
          <th class="text-secondary opacity-7"></th>
        </tr>
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
              <td class="align-middle text-center text-sm"><?= $cart[$i]['id_masakan']; ?></td>
              <td class="align-middle text-center text-sm"><?= $cart[$i]['nama_masakan']; ?></td>
              <td align="center"><?= $cart[$i]['pembelian']; ?></td>
              <td class="align-middle text-center text-sm"><?= 'Rp ' . number_format($cart[$i]['harga'], 0, ',', '.') ?></td>
              <td class="align-middle text-center text-sm"><?= 'Rp ' . number_format($total, 0, ',', '.') ?></td>
              <td align="center">
                <a href="../pages/pesan/hapus.php?id_masakan=<?= $index; ?>">
                  <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </a>
              </td>
            </tr>
        <?php
            $index++;
          }
          //hapus produk dalam cart
          if (isset($_GET['indeks'])) {
            $cart = unserialize(serialize($_SESSION['kantong_belanja']));
            unset($cart[$_GET['indeks']]);
            $cart = array_values($cart);
            $_SESSION['kantong_belanja'] = $cart;
          }
        }
        ?>
        <tr>
          <td colspan="4" align="right"><strong>Total Bayar</strong></td>
          <td><strong><?= 'Rp ' . number_format($total_bayar, 0, ',', '.') ?></strong></td>
          <td align="center">
            <a href="../pages/index.php?page=pesan">
              <button class="btn btn-success btn-sm">Pesan</button>
            </a>
          </td>
        </tr>
      </table>
      <br>
      <hr>
    <?php
  }
  if (isset($_GET['indeks'])) {
    echo "anda menekan tombol hapus";
    // header('Location: index.php?page=transaksi_produk');
  }
    ?>