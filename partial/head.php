<?php

session_start();

$title_button = '#';
$link_button = 'login.php';

if (isset($_SESSION['user_login_name'])) {
  $title_button = $_SESSION['user_login_name'];
  $link_button = 'user/';
} else {
  $title_button = 'Login';
}

if (isset($_SESSION['admin_logined'])) {
  $title_button = "Admin";
  $link_button = 'admin/';
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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/static/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/static/css/style.css">

    <title><?= (isset($title)) ? $title . " | Betanime" : "Betanime" ?></title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">BETANIME</a>
    <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <form class="d-flex" action="index.php" method="GET">
                <input name="cari" class="form-control me-2" type="search" placeholder="Masukan kata kunci.." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Cari</button>
            </form>
        </li>
      </ul>
        <a href="<?= $link_button ?>" class="btn btn-outline-light ms-auto"><?= $title_button ?></a>
    </div>
  </div>
</nav>