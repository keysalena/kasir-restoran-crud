<?php
// Your database connection code here
include "../../conf/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from the form
    $id_user = $_POST['id_user'];
    $id_order = $_POST['id_order'];
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date("Y-m-d H:i:s");

    // Update keterangan di tabel detail_order
    $updateKeterangan = "UPDATE detail_order SET keterangan = 'selesai' WHERE id_order = '$id_order'";
    if (!mysqli_query($koneksi, $updateKeterangan)) {
        die(mysqli_error($koneksi));
    }

    // Mengambil total harga dari tabel detail_order berdasarkan id_order
    $queryTotalHarga = mysqli_query($koneksi, "SELECT SUM(total) AS total_harga FROM detail_order WHERE id_order = '$id_order'");
    $rowTotalHarga = mysqli_fetch_assoc($queryTotalHarga);
    $totalHarga = $rowTotalHarga['total_harga'];

    $nama = mysqli_query($koneksi, "SELECT nama_user AS user FROM user WHERE id_user = '$id_user'");
    $nama1 = mysqli_fetch_assoc($nama);
    $namau = $nama1['user'];

    $no = mysqli_query($koneksi, "SELECT no_meja AS nomeja FROM `order` WHERE id_order = '$id_order'");
    $no1 = mysqli_fetch_assoc($no);
    $nom = $no1['nomeja'];

    // Insert data ke tabel transaksi dengan nilai id_detail_order yang sudah di-gabungkan
    $insertQuery = mysqli_query($koneksi, "INSERT INTO transaksi (nama, nomeja, tanggal, total_bayar) VALUES ('$namau', '$nom', '$tgl', '$totalHarga')");
    if ($insertQuery) {
        echo "<script>alert('Pesanan berhasil ditambahkan.'); window.location.href = '../../pages/index.php?page=data_transaksi';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pesanan. Silakan coba lagi.'); window.location.href = '../../pages/index.php?page=data_transaksi';</script>";
    }
}
