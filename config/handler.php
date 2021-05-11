<?php

define('BASE_URL', 'http://localhost/betanime');
define('TITLE', 'Betanime');

$koneksi_db = mysqli_connect('localhost', 'root', '', 'betanime_db');

// Untuk User dan Admin
require_once 'manip.php';

/* Daftar Akun */
function daftar($data) {

    $nama = $data['nama_user'];
    $email = $data['email_user'];
    $pass = $data['pass_user'];

    $query = "INSERT INTO user_tbl VALUES ('', '$nama', '$email', '$pass', 'user', '1')";

    $cek = queryDB("SELECT * FROM user_tbl WHERE nama_user = '$nama' OR email_user = '$email'");

    if ($cek > 0) {
        echo "Nama / Email sudah digunakan..";
        header("Refresh:1; url='daftar.php'");
        die();
    }

    $hasil = queryDB($query);

    $_SESSION['alert'] = $hasil;

}

/* Login */
function login($data) {

    global $koneksi_db;

    $email = $data['email_log'];
    $pass = $data['pass_log'];

    $query = "SELECT * FROM user_tbl WHERE email_user = '$email'";

    $d = getAllData($query);

    if (!empty($d)) {
        
        // Cek Pass
        if ($pass === $d['pass_user']) {
            // Cek Status User
            if ($d['status_user'] == 0) {
                echo "Akun anda diblokir! Silahkan hubungi admin.";
                header("Refresh:5; url=index.php");
                die();
            } elseif ($d['status_user'] == 1) {

                session_start();
                $_SESSION['user_login_status'] = true;
                $_SESSION['user_login_id'] = $d['id_user'];
                $_SESSION['user_login_name'] = $d['nama_user'];
    
                cekPangkat($d['pangkat']);
            }
        } elseif ($pass != $d['pass_user']){
            echo "Email atau password tidak sesuai..";
            header("Refresh:2; url='login.php'");
            die();
        }
    }

}

/* Cek Pangkat Login */
function cekPangkat($p) {

    if ($p == 'user') {
        echo "Login berhasil! Tunggu sebentar..";
        header("Refresh:2; url='user'");
        die();
    } elseif ($p == 'admin') {
        $_SESSION['admin_logined'] = true;
        echo "Login berhasil! Tunggu sebentar..";
        header("Refresh:2; url='admin'");
        die();
    } else {
        session_destroy();
    }

}

/* Ambil Semua Data */
function getAllData($query) {

    global $koneksi_db;

    $exec = mysqli_query($koneksi_db, $query);

    $hasil = [];

    while ( $row = mysqli_fetch_assoc($exec) ) {
        $hasil = $row;
    }

    return $hasil;

}

/* Insert */
function queryDB($q) {

    global $koneksi_db;

    mysqli_query($koneksi_db, $q);

    return mysqli_affected_rows($koneksi_db);

}

function queryGet($query) {

    global $koneksi_db;

    $exec = mysqli_query($koneksi_db, $query);

    $hasil = [];

    while ( $row = mysqli_fetch_assoc($exec) ) {
        $hasil[] = $row;
    }

    return $hasil;
}

/* Logout */
function logout() {
    echo "Logout..";
    $_SESSION['user_login_status'] = false;
    session_destroy();
    header("Refresh:1; url=index.php");
    die();
}

function alert($pesan, $tipe) {
    
    echo "<div class='alert alert-" . $tipe . " alert-dismissible fade show' role='alert'>
            <strong>" . $pesan . "</strong>
    </div>";

    unset($_SESSION['alert']);
}

function getDataByPage($query, $page = 1, $data_per_page = 3) {

    global $koneksi_db;

    $total_hasil = queryGet($query);
    
    $total_data = count($total_hasil); // total data ditabel
    
    // $data_per_page = 3; // data yang tampil /halaman
    $total_page = ceil($total_data / $data_per_page); // total halaman nanti

    $index_limit1 = 0; // index_awal default
        
    // jika page lebih dari 1
    if ( $page > 1 ) {
        $index_limit1 = ($page * $data_per_page) - $data_per_page; // mengambil data dari index berapa
    }

    // LIMIT QUERY TABLE
    $hasil_data = queryGet($query . " LIMIT $index_limit1, $data_per_page");

    $hasil['data'] = $hasil_data;
    $hasil['total_halaman'] = $total_page;

    return $hasil;
}

?>