<?php
session_start();
include "../../conf/conn.php";

if ($_POST) {
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date("Y-m-d H:i:s");
    $pegawai = $_SESSION['username'];

    if (!empty($_SESSION['kantong_belanja'])) {
        $cart = unserialize(serialize($_SESSION['kantong_belanja']));

        // Assuming you have a form input named 'id_order'
        $ido = $_POST['id_order'];

        // Insert data into the 'detail_order' table for each item in the cart
        foreach ($cart as $item) {
            $id_barang = $item['id_masakan'];
            $harga = $item['harga'];
            $qty = $item['pembelian'];
            $subtotal = $harga * $qty;

            $input = "INSERT INTO detail_order(id_order, id_masakan, qty, total, keterangan) VALUES ('$ido', '$id_barang', '$qty', '$subtotal', 'diproses')";
            if (!mysqli_query($koneksi, $input)) {
                die(mysqli_error($koneksi));
            }
        }

        // Update the 'keterangan' column in the 'order' table to 'sudah pesan'
        $updateKeterangan = "UPDATE `order` SET keterangan = 'sudah pesan' WHERE id_order = '$ido'";
        if (!mysqli_query($koneksi, $updateKeterangan)) {
            die(mysqli_error($koneksi));
        }

        // Clear the shopping cart
        unset($_SESSION["kantong_belanja"]);

        // Redirect to a suitable page after successful insertion and update
        header('Location: ../../pages/index.php?page=data_pesan');
    } else {
        echo "Kantong kosong";
    }
}
