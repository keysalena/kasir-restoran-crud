<?php
include "../../conf/conn.php";

$id    = $_GET['id'];
$query = ("DELETE FROM detail_order WHERE id_order ='$id'");

if (!mysqli_query($koneksi, "$query")) {
    die(mysqli_error);
} else {
    echo '<script>alert("Data Berhasil Dihapus !!!");
window.location.href="../../pages/index.php?page=data_detail"</script>';
}
