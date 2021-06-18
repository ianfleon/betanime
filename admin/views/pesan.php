<?php

$baca_on = "bg-active";

?>

<?php if (count($hasil_pesan['data']) > 0) : ?>
    <h5 class="text-muted">Pesan:</h5>
<?php endif; ?>

<?php if (count($hasil_pesan['data']) < 1) : ?>
    <div class="col-md-12 mt-5">
        <div class="col-md-5 mx-auto text-center">
            <img src="<?= BASE_URL ?>/static/img/no-pesan.png" class="img-responsive">
            <h4 class="mt-3">Tidak ada pesan.</h4>
        </div>
    </div>
<?php endif; ?>

<!-- Baca Pesan -->
<?php if (isset($_GET['baca'])) : ?>

<?php
    
    $id_pesan = $_GET['baca'];

    $q_pesan = "SELECT * FROM pesan_tbl WHERE id_pesan = '$id_pesan'";
    $data_pesan = getAllData($q_pesan);

    if ($data_pesan['status_baca'] == 0) {
        queryDB("UPDATE pesan_tbl SET status_baca = '1' WHERE id_pesan = '$id_pesan'");
    }

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        if (queryDB("DELETE FROM pesan_tbl WHERE id_pesan = '$id'") > 0) {
            echo "<script>alert('Pesan telah dihapus')</script>";
            header("Refresh: 2; url='index.php?view=pesan");
        } else {
            echo "<script>alert('Pesan gagal dihapus')</script>";
            header("Refresh: 2; url='index.php?view=pesan");
        }
    }

?>

<div class="card bg-white shadow">
  <div class="card-body">
    <h5 class="card-title"><?= $data_pesan['subjek_pesan'] ?></h5>
    <h6 class="card-subtitle mb-2 text-muted">
        <span><?= $data_pesan['nama_pengirim'] ?></span>
        <span>( <?= $data_pesan['email_pengirim'] ?> )</span>
    </h6>
    <p class="card-text"><?= $data_pesan['isi_pesan'] ?></p>
  </div>
  <div class="card-footer d-flex">
    <span class="text-muted form-text">🗻 <?= $data_pesan['waktu_kirim'] ?></span>
    <a href="<?= $_SERVER['REQUEST_URI'] ?>&&hapus=<?= $data_pesan['id_pesan'] ?>" class="ms-auto">Hapus Pesan</a>
  </div>
</div>

<!-- List Pesan -->
<?php else : ?>

<div class="list-group shadow">

    <?php foreach($hasil_pesan['data'] as $p) : ?>

        <?php if ($p['status_baca'] == 1) { $baca_on = "bg-light"; } ?>

        <a href="?view=pesan&&baca=<?= $p['id_pesan'] ?>" class="list-group-item list-group-item-action <?= $baca_on ?>">
            <div class="row">
                <div class="col-md-4">
                    <span><?= $p['nama_pengirim'] ?></span>
                    <div id="emailHelp" class="form-text"><?= $p['email_pengirim'] ?></div>
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <span class="text-muted"><?= (strlen($p['isi_pesan']) > 45) ? substr($p['isi_pesan'], 0, 45) . ".." : substr($p['isi_pesan'], 0, 45) ?></span>
                </div>
            </div>
        </a>
    <?php endforeach; ?>

</div>


<?php endif; ?>
<?php require_once '../partial/page.php' ?>