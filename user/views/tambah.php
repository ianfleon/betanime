<?php

if (isset($_POST['upload'])) {
    if (addVideo($_POST, $_FILES) > 0 ) {
        $notif['pesan'] = "Video berhasil diupload!";
        $notif['alert'] = "success";
    } else {
        $notif['pesan'] = "Video gagal diupload!";
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
        var output = document.getElementById('video-ku');
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

<form action="" method="POST" enctype="multipart/form-data" class="shadow p-3 rounded">
    <div class="mb-3">
        <div class="card bg-white">
        <div class="card-header">
            <h5 class="text-bold text-muted">🥥 Tambah video baru!</h5>
        </div>
        <div class="card-body">
            <video src="#" width="100%" controls id="video-ku"></video>
            <!-- <h5 class="card-title">Tarik file kau kesini..</h5> -->
            <p class="card-text">Pilih video yang ingin diupload!</p>
            <input type="file" name="video" class="form-control" id="btn-input-file" accept="video/*" onchange="preview_image(event)" required>
        </div>
        </div>
    </div>
  <div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <input type="text" class="form-control" name="judul" id="judul" required>
  </div>
  <div class="mb-3">
    <label for="genre" class="form-label">Genre</label>
    <input type="text" class="form-control" id="genre" name="genre" required>
    <div id="emailHelp" class="form-text">Contoh : (Action, Comedy, School, dll.)</div>
  </div>
  <div class="mb-3">
    <label for="sinopsis" class="form-label">Sinopsis</label>
    <textarea type="text" class="form-control" id="sinopsis" name="sinopsis" required></textarea>
    <div id="emailHelp" class="form-text">Jangan sampai spoiler..</div>
  </div>
  <div class="mb-3">
    <p class="card-text">Pilih custom thumbnail video!</p>
    <input type="file" name="thumbnail-video" class="form-controll" id="thumbnail-video" accept="image/*" required>
  </div>
  <button type="submit" class="btn btn-primary" name="upload">Upload!</button>
</form>