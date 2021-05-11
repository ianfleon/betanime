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

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 

    <!-- Custom CSS -->
    <link rel="stylesheet" href="static/css/style.css">

    <title><?= (isset($title)) ? $title . " | Betanime" : "Betanime" ?></title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">BETANIME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <form class="d-flex" action="index.php" method="GET">
                <input name="cari" class="form-control me-2" type="search" placeholder="Masukan kata kunci.." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>
        </li>
      </ul>
        <a href="<?= $link_button ?>" class="btn btn-outline-primary ms-auto"><?= $title_button ?></a>
    </div>
  </div>
</nav>