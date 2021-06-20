<?php

if (isset($_GET['acc'])) {
    if (accVideo($_GET['acc']) > 0) {
        header("Refresh:0; url='index.php'");
    }
}

if (isset($_GET['hapus'])) {
    if (hapusVideo($_GET['hapus']) > 0) {
        header("Refresh:0; url='index.php'");
    }
}

?>

<?php if (count($video_user) > 0) : ?>
    <h5 class="text-muted">Permintaan Video:</h5>
<?php endif; ?>

<div class="list-group mb-3">

    <?php if (count($video_user) < 1) : ?>
    <div class="col-md-12 mt-5">
        <div class="col-md-5 mx-auto text-center">
            <img src="<?= BASE_URL ?>/static/img/no-req.svg" class="img-responsive">
            <h4 class="mt-3">Tidak ada permintaan video baru.</h4>
        </div>
    </div>
    <?php endif; ?>

    <?php foreach($video_user as $v) : ?>
    <div class="list-group-item list-group-item-action d-flex align-items-center list-video flex-wrap shadow-sm mb-1 p-1">
        <img class="thumb-list me-2" src="../static/thumbnails/<?= $v['id_user'] ?>/<?= $v['thumb_video'] ?>">
        <div class="info-video">
            <p><strong><?= $v['judul'] ?></strong></p>
            <p class="text-muted"><span class="badge bg-light rounded-pill">Uploader : <?= $v['nama_user'] ?></span></p>
        </div>
        <div class="aksi">
            <a href="?view=demo&&cek=<?= $v['id_video'] ?>" class="aksi-item"><img src="../static/icons/lihat.svg"></a>
            <a href="#" class="aksi-item"><img src="../static/icons/check.svg" onclick="confirm('Yakin diterima?') ? window.location = '<?= $_SERVER['REQUEST_URI'] ?>&&acc=<?= $v['id_video'] ?>' : false"></a>
            <a href="#" class="aksi-item"><img src="../static/icons/cancel.svg" onclick="confirm('Ingin hapus permintaan?') ? window.location = '?hapus=<?= $v['id_video'] ?>' : false"></a>
        </div>
    </div>
    <?php endforeach; ?>

</div>

<?php require_once '../partial/page.php' ?>