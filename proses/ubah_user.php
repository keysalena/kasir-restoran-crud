<?php
include "../conf/conn.php";

if ($_POST) {
    $usn     = $_POST['username'];
    $pass   = $_POST['password'];
    $user  = $_POST['nama_user'];
    $level = $_POST['id_level'];
    $userid = $_POST['id_user'];


    $query = ("UPDATE user SET username='$usn',password='$pass',nama_user='$user',id_level='$level'WHERE id_user ='$userid'");
    if (!mysqli_query($koneksi, "$query")) {
        die(mysqli_error);
    } else {
        echo '<script>alert("Data Berhasil Diubah !!!");
window.location.href="../pages/index.php?page=user"</script>';
    }
}
