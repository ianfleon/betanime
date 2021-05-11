<?php

if (isset($_SESSION['user_login_status'])) {
    header('Location: index.php');
}

if (isset($_POST['btnlogin'])) {

    require_once 'config/handler.php';

    unset($_POST['btnlogin']);

    login($_POST);
}

?>

<?php require_once 'partial/head.php' ?>

<form action="" method="POST">
<div class="containter mt-5 d-flex justify-content-center">
        <div class="col-md-5">
            <h4 class="text-bold">Login</h4>
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email_log" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="pass_log" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <button class="btn btn-primary" name="btnlogin">Login</button>
            </div>
            <p class="text-muted">Belum punya akun? Silahkan <a href="daftar.php">daftar!</a></p>
        </div>
</div>
</form>

</body>
</html>