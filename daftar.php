<?php

if (isset($_SESSION['user_login_status'])) {
    header('Location: index.php');
}

$hasil = 0;

if (isset($_POST['btndaftar'])) {

    unset($_POST['btndaftar']); // hapus data dari $_POST

    require_once 'config/handler.php';

    $hasil = daftar($_POST);

    if ($hasil > 0) {
        $notif['pesan'] = "Akun berhasil dibuat. Silahkan login!"; 
        $notif['alert'] = "success";
        header("Refresh: 2; url='login.php'");
    } else {
        $notif['pesan'] = "Akun gagal dibuat";
        $notif['alert'] = "danger";
    }

}

?>

<?php require_once 'partial/head.php' ?>

<div class="container">

</div>

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

        <h4 class="text-bold text-muted bg-light py-2">☁️ Daftar Akun</h4>

        <div class="input-group mb-3">
            <input type="text" class="form-control" name="nama_user" placeholder="Nama Lengkap" aria-label="Nama" required>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" name="email_user" placeholder="Email" aria-label="Username" required>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass_user" placeholder="Password" aria-label="Password" required>
        </div>
        <div class="input-group mb-3">
            <button class="btn btn-primary" name="btndaftar">Daftar!</button>
        </div>
        <p class="text-muted">Sudah punya akun? Silahkan <a href="login.php">login!</a></p>
    </div>
</div>
</form>

<?php require_once 'partial/footer.php'; ?>