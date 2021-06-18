<?php

/* Demo */
if (isset($_GET['cek'])) {
  $id = $_GET['cek'];
  $dv = queryGet("SELECT * FROM video_tbl WHERE id_video = '$id'")[0];
}

/* Acc Video */
if (isset($_POST['simpan'])) {

    $hasil_db = editVideo($_POST, $_FILES);

    if( $hasil_db > 0 ) {
        $notif['pesan'] = "Data berhasil disimpan!";
        $notif['alert'] = "success";
    } else {
        $notif['pesan'] = "Data gagal disimpan!";
        $notif['alert'] = "danger";
    }

}

?>

<script>
    function preview_image(event) 
    {
        var reader = new FileReader();
        reader.onload = function()
        {
        var output = document.getElementById('thumb-img');
        output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<!-- Notifikasi -->
        <?php if (isset($notif)) : ?>
            <div class="alert alert-<?= $notif['alert'] ?>" role="alert">
                <?= $notif['pesan'] ?>
                <?php
                    header("Refresh: 2; url='index.php'");
                    die();
                ?>
            </div>
        <?php endif; ?>
        <!-- // Notifikasi // -->

<form action="" method="POST" enctype="multipart/form-data" class="shadow p-3 rounded d-flex flex-column">
    <input type="hidden" class="form-control" name="id_video" id="id_video" value="<?= $dv['id_video'] ?>">
    <input type="hidden" class="form-control" name="id_user" id="id_video" value="<?= $dv['id_user'] ?>">
    <div class="mb-3">
        <div class="card bg-white">
        <div class="card-header">
            <h5 class="text-bold text-muted">🌵 Edit data video</h5>
        </div>
        <div class="card-body">
            <video src="../videos/<?= $dv['id_user'] ?>/<?= $dv['nama_video'] ?>" width="100%" controls id="video-ku"></video>
        </div>
        </div>
    </div>
  <div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <input type="text" class="form-control" name="judul" id="judul" value="<?= $dv['judul'] ?>" required>
  </div>
  <div class="mb-3">
    <label for="genre" class="form-label">Genre</label>
    <input type="text" class="form-control" id="genre" name="genre" value="<?= $dv['genre'] ?>" required>
    <div id="emailHelp" class="form-text">Contoh : (Action, Comedy, School, dll.)</div>
  </div>
  <div class="mb-3">
    <label for="sinopsis" class="form-label">Sinopsis</label>
    <textarea type="text" class="form-control" id="sinopsis" name="sinopsis" required><?= $dv['sinopsis'] ?></textarea>
    <div id="emailHelp" class="form-text">Jangan sampai spoiler..</div>
  </div>
  <div class="mb-3">
    <p class="card-text">Pilih custom thumbnail video!</p>
    <img src="../static/thumbnails/<?= $dv['id_user'] ?>/<?= $dv['thumb_video'] ?>" id="thumb-img" width="100">
    <input type="hidden" name="thumbnail-lama" class="form-controll" value="<?= $dv['thumb_video'] ?>">
    <input type="file" name="thumbnail-baru" class="form-controll" id="thumbnail-video" onchange=preview_image(event) accept="image/*">
  </div>
  <button type="submit" class="btn btn-primary ms-auto" name="simpan">Simpan!</button>
</form>