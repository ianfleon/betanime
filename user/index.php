<?php

session_start();

if (isset($_SESSION['user_login_status'])) {
    if ($_SESSION['user_login_status'] === false) {
        header('Location: ..');
    }
} else {
    header('Location: ..');
}

require_once '../config/handler.php';

if (isset($_GET['auth'])) {

  if ($_GET['auth'] === 'logout') {
    logout();
  }

}

if (isset($_GET['hapus'])) {
    if (hapusVideo($_GET['hapus']) > 0) {
        header("Refresh:0; url='index.php'");
    }
}

$dir = 'betanime';

if (!defined("BASE_URL")) {
    define("BASE_URL", "http://localhost/" . $dir);
}


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