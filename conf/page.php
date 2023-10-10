<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  switch ($page) {
      // Beranda

    case 'masakan':
      include '../pages/data_masakan.php';
      break;
    case 'level':
      include '../pages/data_level.php';
      break;
    case 'user':
      include '../pages/data_user.php';
      break;
    case 'beranda':
      include '../pages/beranda.php';
      break;
  }
} else {
  include "beranda.php";
}
