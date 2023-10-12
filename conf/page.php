<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  switch ($page) {
      // Beranda

    case 'masakan':
      include '../pages/masakan/data_masakan.php';
      break;
    case 'level':
      include '../pages/level/data_level.php';
      break;
    case 'user':
      include '../pages/user/data_user.php';
      break;
    case 'order':
      include '../pages/order/data_order.php';
      break;
    case 'beranda':
      include '../pages/beranda.php';
      break;

       //data pesan
    case 'data_pesan':
      include '../pages/pesan/data.php';
      break;
    case 'tambah_pesan':
      include '../pages/pesan/tambah.php';
      break;
    case 'pesan';
      include '../pages/pesan/pesan.php';
      break;

      //data detail
    case 'data_detail':
      include '../pages/detail/data.php';
      break;
    case 'tambah_detail':
      include '../pages/detail/tambah.php';
      break;

    case 'detail_order';
      include '../pages/detail/detail.php';
      break;
  }
} else {
  include "beranda.php";
}
