<nav aria-label="Page navigation example">
    <ul class="pagination mt-3">

        <?php if($page_active > 1) : ?>
            <?= '<li class="page-item"><a class="page-link" href="index.php?'.$url_page.'='.($page_active-1).'">Sebelumnya</a></li>'?>
        <?php endif; ?>

        <?php if($page_active != $total_halaman && $total_halaman != 0) : ?>
            <li class="page-item ms-auto"><a class="page-link" href="index.php?<?= $url_page.'='.($page_active+1)?>">Selanjutnya</a></li>
        <?php endif; ?>

    </ul>
</nav>