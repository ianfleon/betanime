<?php

require_once('config/handler.php'); // fungsi utama

// query
$query = "SELECT * FROM video_tbl INNER JOIN user_tbl ON video_tbl.id_user = user_tbl.id_user WHERE status_video = 1 ORDER BY id_video DESC";

$page_active = 1; // halaman aktif
$total_data = 12; // total data yang tampil

$hasil = getDataByPage($query, $page_active, $total_data); // ambil data
$videos = $hasil['data']; // data video

$total_halaman = $hasil['total_halaman']; // total halaman

$url_page = 'page'; // url default pagination

/* Cari */
if (isset($_GET['cari'])) {

    $keyword = $_GET['cari']; // berisi keyword

    $url_page = 'cari=' . $keyword . '&&page';
    
    // cek url 'page'
    if (isset($_GET['page'])) {
        $page_active = $_GET['page'];
    }

    // query
    $query = "SELECT * FROM video_tbl INNER JOIN user_tbl ON video_tbl.id_user = user_tbl.id_user WHERE judul LIKE '%$keyword%' AND status_video = 1 ORDER BY id_video DESC";

    // hasil query
    $hasil = getDataByPage($query, $page_active, $total_data);
    $videos = $hasil['data'];

    // jika data tidak ada, redirect ke halaman utama
    if (empty($videos)) {
        header('Location: 404.php');
        die();
    }

}

/* Page */
if (isset($_GET['page'])) {

    $page_active = $_GET['page']; // berupa halaman aktif

    // hasil query
    $hasil = getDataByPage($query, $page_active, $total_data);
    $videos = $hasil['data'];

    // redirect ke home jika data kosong
    if (empty($videos)) {
        header('Location: 404.php');
        die();
    }

}

?>

<!-- ++ Header -->
<?php require_once 'partial/head.php'; ?>

<div class="container-fluid mt-3">
    <div class="row">

        <!-- ++ Looping Data Video -->
        <?php foreach($videos as $v) : ?>
        <? $v['nama_user'] ?>
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <img src="<?= BASE_URL ?>/static/thumbnails/<?= $v['id_user']?>/<?= $v['thumb_video'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="nonton.php?v=<?= $v['id_video'] ?>" class="card-title"><?= $v['judul'] ?></a>
                    <p class="card-text text-muted fs-6">Upload By : <?= $v['nama_user'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    
    </div>

<!-- ++ Pagination -->
<?php require_once 'partial/page.php'; ?>

</div>

<!-- ++ Footer -->
<?php require_once 'partial/footer.php'; ?>