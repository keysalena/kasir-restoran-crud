<?php
session_start();
$id_masakan = $_GET['id_masakan'];
//unset($_SESSION["kantong"]);
if (isset($_GET['id_masakan'])) {
    echo $id_masakan . "<br>";
    $cart = unserialize(serialize($_SESSION['kantong_belanja']));
    unset($cart[$_GET['id_masakan']]);
    $cart = array_values($cart);
    $_SESSION['kantong_belanja'] = $cart;
}
if (!empty($_SESSION['kantong_belanja'])) {
    $cart = unserialize(serialize($_SESSION['kantong_belanja']));
    for ($i = 0; $i < count($cart); $i++) {
        echo $cart[$i]['harga'] . "/" . $cart[$i]['nama_masakan'] . "<br>";
    }
}
header('Location: ../../pages/index.php?page=data_pesan');
