<?php require_once 'partial/head.php' ?>

<form action="" method="POST">

    <div class="containter mt-5">
        <div class="col-md-5 mx-auto shadow p-3 mb-5 bg-body rounded">

            <!-- Notifikasi -->
            <?php if (isset($notif)) : ?>
                <div class="alert alert-<?= $notif['alert'] ?>" role="alert">
                    <?= $notif['pesan'] ?>
                </div>
            <?php endif; ?>
            <!-- // Notifikasi // -->

            <h4 class="text-bold text-muted mb-3 bg-light py-2">🛫 Hubungi Kami</h4>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Contoh: Budi Doremifasolasido</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Berikan kami email aktif agar mudah dikonfirmasi</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Subjek</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pesan</label>
                <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
            </div>

            <div class="input-group mb-3">
                <button class="btn btn-primary" name="btnlogin">Kirim</button>
            </div>
        </div>

    </div>
</form>

<?php require_once 'partial/footer.php'; ?>