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
<div class="list-group mb-3">

    <?php foreach($video_user as $v) : ?>
    <div class="list-group-item list-group-item-action d-flex align-items-center list-video flex-wrap">
        <img class="thumb-list me-2" src="../static/thumbnails/<?= $v['id_user'] ?>/<?= $v['thumb_video'] ?>">
        <div class="info-video">
            <p><?= $v['judul'] ?></p>
            <p class="text-muted"><span class="badge bg-light rounded-pill">Uploader : <?= $v['nama_user'] ?></span></p>
        </div>
        <div class="aksi">
            <a href="?view=demo&&cek=<?= $v['id_video'] ?>" class="aksi-item"><img src="../static/icons/lihat.svg"></a>
            <a href="?acc=<?= $v['id_video'] ?>" class="aksi-item"><img src="../static/icons/check.svg"></a>
            <a href="?hapus=<?= $v['id_video'] ?>" class="aksi-item"><img src="../static/icons/cancel.svg"></a>
        </div>
    </div>
    <?php endforeach; ?>

</div>

<?php require_once '../partial/page.php' ?>