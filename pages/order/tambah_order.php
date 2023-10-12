<?php
// Your database connection code here
include "../../conf/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from the form
    $no_meja = $_POST['no_meja'];
    $id_user = $_POST['id_user'];
    $tanggal = $_POST['tanggal'];

    // Check if an order with the same "no_meja" and "keterangan" equal to "belum pesan" exists
    $existingOrderQuery = mysqli_query($koneksi, "SELECT * FROM `order` WHERE no_meja = '$no_meja' AND keterangan = 'belum pesan'");

    if (mysqli_num_rows($existingOrderQuery) > 0) {
        // An existing order with the same "no_meja" and "keterangan" exists
        echo "<script>alert('Maaf, pesanan untuk nomor meja $no_meja belum selesai atau dibatalkan. Anda tidak dapat membuat pesanan baru untuk nomor meja yang sama.'); window.location.href = '../../index.php?page=tambah_order';</script>";
    } else {
        // Insert the new order since no existing order is found
        $insertQuery = mysqli_query($koneksi, "INSERT INTO `order` (no_meja, id_user, tanggal, keterangan) VALUES ('$no_meja', '$id_user', '$tanggal', 'belum pesan')");
        if ($insertQuery) {
            echo "<script>alert('Pesanan berhasil ditambahkan.'); window.location.href = '../../pages/index.php?page=order';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan pesanan. Silakan coba lagi.'); window.location.href = '../../pages/index.php?page=order';</script>";
        }
    }
}
