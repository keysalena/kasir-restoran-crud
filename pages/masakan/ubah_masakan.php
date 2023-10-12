<?php
include "../../conf/conn.php";

if ($_POST) {
    $id     = $_POST['id_masakan'];
    $nama   = $_POST['nama_masakan'];
    $harga  = $_POST['harga'];

    // Perbaiki pernyataan UPDATE dengan tanda koma yang benar
    $query = "UPDATE masakan SET nama_masakan='$nama', harga='$harga' WHERE id_masakan='$id'";

    if (!mysqli_query($koneksi, $query)) {
        die(mysqli_error($koneksi));
    } else {
        echo '<script>alert("Data Berhasil Diubah !!!");
        window.location.href="../../pages/index.php?page=masakan"</script>';
    }
}
