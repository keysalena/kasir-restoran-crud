<?php
include "../../conf/conn.php";

if ($_POST) {
    $nama   = $_POST['nama_level'];

    $query = "INSERT INTO level (nama_level) VALUES ('$nama')";
    // Execute the query
    if (!mysqli_query($koneksi, $query)) {
        die("Error: " . mysqli_error($koneksi)); // Print the error message
    } else {
        echo '<script>alert("Data Berhasil Ditambahkan !!!");
        window.location.href="../../pages/index.php?page=level"</script>';
    }
}
