<?php

// Cek Login
session_start();

if (isset($_SESSION['user_login_status'])) {
    if ($_SESSION['user_login_status'] === false) {
        header('Location: ..');
    }
} else {
    header('Location: ..');
}

require_once '../config/handler.php'; // Main Function

// Setting Halaman
$page_active = 1;
$total_data = 12;
$total_halaman = 0;

$dir = 'betanime'; // folder

// URL Utama
if (!defined("BASE_URL")) {
    define("BASE_URL", "http://localhost/" . $dir);
}

$id_user = $_SESSION['user_login_id'];
$nama_user = $_SESSION['user_login_name'];

// Logout
if (isset($_GET['auth'])) {

  if ($_GET['auth'] === 'logout') {
    logout();
  }

}

// Hapus Video
if (isset($_GET['hapus'])) {
    if (hapusVideo($_GET['hapus']) > 0) {
        header("Refresh:0; url='index.php'");
    }
}

/* Ambil data video berdasarkan id_user */
$query = "SELECT * FROM video_tbl WHERE id_user = '$id_user'";

if (isset($_GET['status'])) {
    
    $status = $_GET['status'];

    if ($status == 0) {
        $query = "SELECT * FROM video_tbl WHERE id_user = '$id_user' AND status_video = '0'";
    } elseif ($status == 1) {
        $query = "SELECT * FROM video_tbl WHERE id_user = '$id_user' AND status_video = '1'";
    }

}

if (isset($_GET['page'])) {
    $page_active = $_GET['page'];
}

$url_page = 'page';

/* Query ke db */
$hasil = getDataByPage($query, $page_active, $total_data);

/* Hasil Query */
$video_user = $hasil['data'];

// Notifikasi
$id_user = $_SESSION['user_login_id'];

$notif_video = getDataByPage("SELECT * FROM notif_tbl WHERE id_user = '$id_user' ORDER BY id_notif DESC", $page_active, $total_data);
$hasil_notif = queryGet("SELECT * FROM notif_tbl WHERE id_user = '$id_user' AND status_cek = '0'");

if (isset($_GET['view'])) {
    if ($_GET['view'] == 'semua') {
        $total_halaman = $hasil['total_halaman'];
    } elseif ($_GET['view'] == 'notif') {
        $url_page = 'view=notif&&page';
        $total_halaman = $notif_video['total_halaman'];
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/static/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>/static/css/style.css"/>

    <title>Halaman User | Betanime</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand text-bold" href="<?= BASE_URL ?>/user"><strong><?= $_SESSION['user_login_name']; ?></strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a href="?view=notif" type="button" class="btn me-5 position-relative">
            <img src="<?= BASE_URL ?>/static/icons/notifications.svg" alt="/">
            <?php if (count($hasil_notif) > 0) : ?>
                <span class="position-absolute top-3 start-90 translate-middle p-1 bg-primary border rounded-circle fs-6"></span>
            <?php endif; ?>
            </a>
          <a class="btn btn-outline-light" href="?auth=logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- List -->
<div class="container mt-3 mb-5 min-vh">
    <div class="row">

        <!-- Side Menu -->
        <div class="col-md-3 mb-3">
            <div class="list-group">
                <a href="?view=tambah" class="list-group-item list-group-item-action active text-bold mb-2" aria-current="true">
                    <img src="../static/icons/videocam.svg"> + Video Baru
                </a>
                <a href="?view=semua" class="list-group-item list-group-item-action"><img src="../static/icons/movie.svg"> Semua Video</a>
                <a href="?view=semua&&status=0" class="list-group-item list-group-item-action"><img src="../static/icons/time-up.svg"> Diproses</a>
                <a href="?view=semua&&status=1" class="list-group-item list-group-item-action"><img src="../static/icons/time-down.svg"> Diterima</a>
                <a href="<?= BASE_URL ?>" class="list-group-item list-group-item-dark mt-1"><img src="../static/icons/home.svg"> Betanime</a>
            </div>
        </div>

        <!-- Side Content -->
        <div class="col-md-9">
          <!-- Views -->
          <?php

              if (isset($_GET['view'])) {
                  $f = $_GET['view'];

                  if (file_exists('views/' . $f . '.php')) {
                    require_once 'views/' . $_GET['view'] . '.php';
                  } else {
                    require_once 'views/semua.php';
                  }
              } else {
                require_once 'views/semua.php';
              }

          ?>
        </div>

    </div>
</div>

<?php require_once '../partial/footer.php'; ?>