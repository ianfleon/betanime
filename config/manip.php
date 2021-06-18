<?php

// if (!isset($_SESSION['admin_logined']) && !isset($_SESSION['user_login_status'])) {
//     echo "Aowkwkwkwkwk :v";
//     die();
// }

/* Prosesing Video */
function uploadVideo($video, $user) {

    $nama = $video['name'];
    $tipe = $video['type'];
    $lokasi_tmp = $video['tmp_name'];
    $error = $video['error'];
    $size = $video['size'];

    $nama_ex = explode('.', $nama);

    $eksetensi = end($nama_ex);

    $nama = uniqid() . "." . $eksetensi;

    $dir = '../videos/';

    if (!is_dir($dir . $user) ) {
        mkdir($dir. $user);
    }

    $v['status_upload'] = move_uploaded_file($lokasi_tmp, $dir . $user . '/' . $nama);

    if ($v['status_upload']) {
        $v['nama_baru'] = $nama;
    }

    return $v;

}

/* Prosesing Video */
function uploadGambar($gambar, $user) {

    $nama = $gambar['name'];
    $tipe = $gambar['type'];
    $lokasi_tmp = $gambar['tmp_name'];
    $error = $gambar['error'];
    $size = $gambar['size'];

    $nama_ex = explode('.', $nama);

    $eksetensi = end($nama_ex);

    $nama = uniqid() . "." . $eksetensi;

    $dir = '../static/thumbnails/';

    if (!is_dir($dir . $user) ) {
        mkdir($dir. $user);
    }

    $v['status_upload'] = move_uploaded_file($lokasi_tmp, $dir . $user . '/' . $nama);

    if ($v['status_upload']) {
        $v['nama_baru'] = $nama;
    }

    return $v;

}

/* Upload Video by User */
function addVideo($info, $video) {
    
    $judul = $info['judul'];
    $genre = $info['genre'];
    $sinopsis = $info['sinopsis'];

    $user = $_SESSION['user_login_id'];

    $v = uploadVideo($video['video'], $user);
    $thumb = uploadGambar($video['thumbnail-video'], $user);

    $nama_video = $v['nama_baru'];
    $nama_thumb = $thumb['nama_baru'];

    $query = "INSERT INTO video_tbl (id_video, judul, genre, sinopsis, thumb_video, nama_video, id_user) VALUES
            ('', '$judul', '$genre', '$sinopsis', '$nama_thumb', '$nama_video', '$user') ";

    if ($v['status_upload']) {
        return queryDB($query);
    }

}

/* Upload Video by User */
function editVideo($info, $img) {
    
    $user = $info['id_user'];
    
    $id_video = $info['id_video'];
    $judul = $info['judul'];
    $genre = $info['genre'];
    $sinopsis = $info['sinopsis'];

    $thumbnail = $info['thumbnail-lama'];

    if ($img['thumbnail-baru']['size'] > 0) {
        $thumb = uploadGambar($img['thumbnail-baru'], $user);
        $thumbnail = $thumb['nama_baru'];
    }

    $query = "UPDATE video_tbl
        SET judul = '$judul', genre = '$genre', sinopsis = '$sinopsis', thumb_video = '$thumbnail'
        WHERE id_video = '$id_video'";

    return queryDB($query);

}

function accVideo($id_video) {
    $query = "UPDATE video_tbl SET status_video = 1 WHERE id_video = '$id_video'";
    return queryDB($query);
}

function hapusVideo($id_video) {
    return queryDB("DELETE FROM video_tbl WHERE id_video = '$id_video'");
}