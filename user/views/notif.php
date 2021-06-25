<div class="list-group">
    <?php foreach ($notif_video['data'] as $n) : ?>
    <?php

        if ($n['status_cek'] == 0) {
            queryDB("UPDATE notif_tbl SET status_cek = '1' WHERE id_user = '$id_user'");
        }

        if ($n['status_notif'] == 1) {
            $bg = "success";
            $ms = "diterima";
        } else {
            $bg = "danger";
            $ms = "ditolak";
        }
    ?>
    <p class="btn btn-outline-<?= $bg ?> text-start mb-1">
        <?= $n['waktu_notif'] ?> :
        Permintaan <strong>[<?= $n['pesan_notif'] ?>]</strong> <?= $ms ?>
    </p>
    <?php endforeach; ?>
</div>

<?php require_once '../partial/page.php' ?>