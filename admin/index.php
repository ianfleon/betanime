<?php

session_start();

if (!isset($_SESSION['admin_logined'])) {
    header('Location: ..');
}

require_once '../config/handler.php';

if (isset($_GET['auth'])) {

  if ($_GET['auth'] === 'logout') {
      logout();
  }

}

/* Users */
if (isset($_GET['blok'])) {
  $id_blok = $_GET['blok'];
  $hasil = queryDB("UPDATE user_tbl SET status_user = 0 WHERE id_user = '$id_blok'");
  header("Refresh:0; url=index.php?view=users");
}

if (isset($_GET['unblok'])) {
  $id_blok = $_GET['unblok'];
  $hasil = queryDB("UPDATE user_tbl SET status_user = 1 WHERE id_user = '$id_blok'");
  header("Refresh:0; url=index.php?view=users");
}


/* Edit Video */
if (isset($_POST['simpan'])) {

    $hasil_db = editVideo($_POST, $_FILES);

    if( $hasil_db > 0 ) {
        $notif['pesan'] = "Data berhasil disimpan!";
        $notif['alert'] = "success";
    } else {
        $notif['pesan'] = "Data gagal disimpan!";
        $notif['alert'] = "danger";
    }

}

$page_active = 1;
$total_data = 12;
$url_page = 'page';

// Semua Video
$query_video = "SELECT * FROM video_tbl INNER JOIN user_tbl ON video_tbl.id_user = user_tbl.id_user WHERE status_video = 1 ORDER BY id_video DESC";
$hasil_video = getDataByPage($query_video, $page_active, $total_data);

// Req. Video
$query_req = "SELECT * FROM video_tbl INNER JOIN user_tbl ON video_tbl.id_user = user_tbl.id_user WHERE status_video = 0 ORDER BY id_video DESC";
$hasil_req = getDataByPage($query_req, $page_active, $total_data);

// User
$query_users = "SELECT * FROM user_tbl WHERE pangkat = 'user'";
$hasil_users = getDataByPage($query_users, $page_active, $total_data);

// Pesan
$query_pesan = "SELECT * FROM pesan_tbl ORDER BY id_pesan DESC";
$hasil_pesan = getDataByPage($query_pesan, $page_active, $total_data);

// Total Halaman
$total_halaman = $hasil_req['total_halaman'];

if (isset($_GET['page'])) {
  $page_active = $_GET['page'];
  $hasil_req = getDataByPage($query_req, $page_active, $total_data);
}

if (isset($_GET['view'])) {
  if ($_GET['view'] == 'users') {
      $url_page = 'view=users&&page';
      $hasil_users = getDataByPage($query_users, $page_active, $total_data);
      $total_halaman = $hasil_users['total_halaman'];
  } elseif ($_GET['view'] == 'pesan') {
      $url_page = 'view=pesan&&page';
      $hasil_pesan = getDataByPage($query_pesan, $page_active, $total_data);
      $total_halaman = $hasil_pesan['total_halaman'];
  } elseif ($_GET['view'] == 'semua') {
      $url_page = 'view=semua&&page';
      $hasil_video = getDataByPage($query_video, $page_active, $total_data);
      $total_halaman = $hasil_video['total_halaman'];
  }
}

$video_user = $hasil_req['data'];

$total_req = queryGet("SELECT * FROM video_tbl WHERE status_video = 0 ORDER BY id_video DESC");

$pesan_baru = queryGet("SELECT * FROM pesan_tbl WHERE status_baca = '0'");

// var_dump($total_halaman);

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= BASE_URL ?>/static/css/style.css"/>

    <title>Halaman Admin | Betanime</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand text-bold" href="<?= BASE_URL ?>">BETANIME</a>
  </div>
</nav>

<!-- List -->
<div class="container mt-3 mb-5">
    <div class="row">

        <!-- Side Menu -->
        <div class="col-md-3 mb-3">
            <div class="list-group">
                <a href="?view=semua" class="list-group-item list-group-item-action"><img src="../static/icons/videos.svg"> Semua Video</a>
                <a href="?view=request" class="list-group-item list-group-item-action"><img src="../static/icons/play-list.svg"> Permintaan Video 
                  <?php if (count($total_req) > 0) : ?>
                      <span class="badge bg-primary rounded-pill"><?= count($total_req) ?></span>
                  <?php endif; ?>
                </a>
                <a href="?view=pesan" class="list-group-item list-group-item-action"><img src="../static/icons/mail.svg"> Pesan 
                  <?php if (count($pesan_baru) > 0) : ?>
                    <span class="badge bg-primary rounded-pill"><?= count($pesan_baru) ?></span></a>
                  <?php endif; ?>
                <a href="?view=users" class="list-group-item list-group-item-action"><img src="../static/icons/users.svg"> Users</a>
                <a href="<?= BASE_URL ?>/admin/?auth=logout" class="list-group-item list-group-item-dark mt-1"><img src="../static/icons/logout.svg"> Logout</a>
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
                    require_once 'views/request.php';
                  }
              } else {
                require_once 'views/semua.php';
              }

          ?>
          
        </div>

    </div>
</div>

</body>
</html>