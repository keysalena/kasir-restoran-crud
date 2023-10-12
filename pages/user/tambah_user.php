<?php
include "../../conf/conn.php";

if ($_POST) {
    $usn   = $_POST['username'];
    $pass  = $_POST['password'];
    $nama = $_POST['nama_user'];
    $level = $_POST['id_level'];

    $query = "INSERT INTO user (username, password, nama_user, id_level) VALUES ('$usn','$pass','$nama','$level')";
    // Execute the query
    if (!mysqli_query($koneksi, $query)) {
        die("Error: " . mysqli_error($koneksi)); // Print the error message
    } else {
        echo '<script>alert("Data Berhasil Ditambahkan !!!");
    window.location.href="../../pages/index.php?page=user"</script>';
    }
}
