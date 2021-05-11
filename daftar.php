<?php

if (isset($_SESSION['user_login_status'])) {
    header('Location: index.php');
}

$hasil = 0;

if (isset($_POST['btndaftar'])) {

    unset($_POST['btndaftar']); // hapus data dari $_POST

    require_once 'config/handler.php';

    $hasil = daftar($_POST);

}

?>

<?php require_once 'partial/head.php' ?>

<div class="container">

</div>

<form action="" method="POST">
<div class="containter mt-5 d-flex justify-content-center">

    <div class="col-md-5">
        <?php
            if (isset($_SESSION['alert'])) {
                if ($_SESSION['alert'] > 0) {
                    alert("Berhasil daftar!", "success");
                } else {
                    alert("Data gagal ditambahkan", "warning");
                }
            }
        ?>
        <h4 class="text-bold">Daftar Akun</h4>
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

</body>
</html>