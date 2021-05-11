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

/* Edit Video */
if (isset($_POST['simpan'])) {

    $hasil_db = editVideo($_POST, $_FILES);

    if( $hasil_db > 0 ) {
      header("Refresh: 1; url=index.php");
      alert('Berhasil disimpan!', 'success');
    }

}

$page_active = 1;
$total_data = 12;
$url_page = 'page';

// Video
$query_req = "SELECT * FROM video_tbl INNER JOIN user_tbl ON video_tbl.id_user = user_tbl.id_user WHERE status_video = 0 ORDER BY id_video DESC";
$hasil_req = getDataByPage($query_req, $page_active, $total_data);

// User
$query_users = "SELECT * FROM user_tbl WHERE pangkat = 'user' AND status_user = 1";
$users = getDataByPage($query_users, $page_active, $total_data);

if (isset($_GET['page'])) {
  $page_active = $_GET['page'];
  $hasil_req = getDataByPage($query_req, $page_active, $total_data);
}

if (isset($_GET['view'])) {
  if ($_GET['view'] == 'users') {
      $url_page = 'view=users&&page';
      $users = getDataByPage($query_users, $page_active, $total_data);
  }
}

$video_user = $hasil_req['data'];
$total_halaman = $hasil_req['total_halaman'];

$total_req = queryGet("SELECT * FROM video_tbl WHERE status_video = 0 ORDER BY id_video DESC");

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/videoaja/static/css/style.css"/>

    <title>Halaman Admin | Betanime</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand text-bold" href="<?= BASE_URL ?>">BETANIME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- List -->
<div class="container mt-3 mb-5">
    <div class="row">

        <!-- Side Menu -->
        <div class="col-md-3 mb-3">
            <div class="list-group">
                <a href="?view=request" class="list-group-item list-group-item-action"><img src="../static/icons/play-list.svg"> Permintaan Video <span class="badge bg-primary rounded-pill"><?= count($total_req) ?></span></a>
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
                require_once 'views/request.php';
              }

          ?>
        </div>

    </div>
</div>

</body>
</html>