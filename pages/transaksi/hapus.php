<?php
include "../../conf/conn.php";

$id    = $_GET['id'];
$query = ("DELETE FROM transaksi WHERE id_transaksi ='$id'");

if (!mysqli_query($koneksi, "$query")) {
    die(mysqli_error);
} else {
    echo '<script>alert("Data Berhasil Dihapus !!!");
window.location.href="../../pages/index.php?page=data_transaksi"</script>';
}
