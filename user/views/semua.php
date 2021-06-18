<?php

$id_user = $_SESSION['user_login_id'];
$nama_user = $_SESSION['user_login_name'];

$page_active = 1;
$total_data = 12;

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

/* Query ke db */
$hasil = getDataByPage($query, $page_active, $total_data);

/* Hasil Query */
$video_user = $hasil['data'];
$total_halaman = $hasil['total_halaman'];

$url_page = 'page';

if (isset($_GET['status'])) {
    $url_page = 'status=' . $_GET['status'] . '&&page';
}

?>

<div class="list-group mb-3">

    <?php if (count($video_user) < 1) : ?>
<!--     <div class="alert alert-secondary" role="alert">
        Tidak ada video. <strong>Upload sekarang!</strong>
    </div> -->
    <div class="col-md-12 mt-5">
        <div class="col-md-5 mx-auto text-center">
            <img src="<?= BASE_URL ?>/static/img/no-data.png" class="img-responsive">
            <h4 class="mt-3">Tidak ada video disini.</h4>
        </div>
    </div>
    <?php endif; ?>

    <?php foreach($video_user as $v) : ?>
    <div class="list-group-item list-group-item-action d-flex align-items-center mb-1 list-video flex-wrap shadow-sm p-2 rounded">
        <img class="thumb-list me-2" src="../static/thumbnails/<?= $v['id_user'] ?>/<?= $v['thumb_video'] ?>">
        <div class="info-video">
            <p><?= $v['judul'] ?></p>
            <?php if ($v['status_video'] == 0) : ?></span>
                <p class="text-muted">
                <span class="badge bg-primary rounded-pill">Diproses</span>
                </p>
            <?php else : ?>
                <p class="text-muted">
                <span class="badge bg-success rounded-pill">Diterima</span>
                </p>
            <?php endif; ?>
        </div>
        <div class="aksi">
            <?php if ($v['status_video'] != 1) : ?>
            <a href="?view=demo&&cek=<?= $v['id_video'] ?>" class="aksi-item"><img src="../static/icons/edit.svg"></a>
            <?php else : ?>
            <a href="<?= BASE_URL ?>/nonton.php?v=<?= $v['id_video'] ?>" class="aksi-item"><img src="../static/icons/lihat.svg"></a>
            <?php endif; ?>
            <a href="#" class="aksi-item" onclick="confirm('Ingin hapus video?') ? window.location = '?hapus=<?= $v['id_video'] ?>' : false"><img src="../static/icons/hapus.svg"></a>
        </div>
    </div>
    <?php endforeach; ?>

</div>

<?php require_once '../partial/page.php' ?>