<?php

if (!isset($_GET['v'])) {
    header('Location: index.php');
    die();
}

require_once('config/handler.php');

if (isset($_GET['v'])) {

    $id = $_GET['v'];
    $video = queryGet("SELECT * FROM video_tbl WHERE id_video = '$id'");

    if (empty($video)) {
        header('Location: 404.php');
        die();
    }

    $video = $video[0];

    $genre = explode(',', $video['genre']);

}

// download video
if (isset($_GET['download'])) {


        $file = 'videos/' . $video['id_user'] . '/' . $video['nama_video'];

        $format_video = explode('.', $video['nama_video'])[1];
        $format_video = "." . $format_video;

        if (file_exists($file)) {

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename('[Betanime] ' . $video['judul']) . $format_video);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($file));

            ob_clean();
            flush();
            
            readfile($file);
            
            exit;
        }
}

$title = $video['judul'];

?>

<?php require_once 'partial/head.php'; ?>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card">
                <p>
                    <?php foreach($genre as $g) : ?>
                    <span class="badge bg-dark"><?= $g ?></span>
                    <?php endforeach; ?>
                </p>
                <video src="videos/<?= $video['id_user'] ?>/<?= $video['nama_video'] ?>" controls></video>
                <div class="card-body">
                    <h5 class="card-title"><b><?= $video['judul'] ?></b></h5>
                    <p class="card-text text-muted"><?= $video['sinopsis'] ?></p>
                    <a href="nonton.php?v=<?= $id ?>&&download" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'partial/footer.php'; ?>