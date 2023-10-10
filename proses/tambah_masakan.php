<?php
include "../conf/conn.php";

if ($_POST) {
    $nama   = $_POST['nama_masakan'];
    $harga  = $_POST['harga'];
    $status = 'tersedia';

    $query = "INSERT INTO masakan (nama_masakan, harga, status_masakan) VALUES ('$nama','$harga','$status')";
    // Execute the query
    if (!mysqli_query($koneksi, $query)) {
        die("Error: " . mysqli_error($koneksi)); // Print the error message
    } else {
        echo '<script>alert("Data Berhasil Ditambahkan !!!");
    window.location.href="../pages/index.php?page=masakan"</script>';
    }
}
