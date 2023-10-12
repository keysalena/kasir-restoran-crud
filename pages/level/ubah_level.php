<?php
include "../../conf/conn.php";

if ($_POST) {
    $id     = $_POST['id_level'];
    $nama   = $_POST['nama_level'];

    $query = ("UPDATE level SET nama_level='$nama'WHERE id_level ='$id'");
    if (!mysqli_query($koneksi, "$query")) {
        die(mysqli_error);
    } else {
        echo '<script>alert("Data Berhasil Diubah !!!");
        window.location.href="../../pages/index.php?page=level"</script>';
    }
}
