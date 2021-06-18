<?php if (count($hasil_users['data']) > 0) : ?>
    <h5 class="text-muted">Pengguna:</h5>
<?php endif; ?>

<?php if (count($hasil_users['data']) < 1) : ?>
    <div class="col-md-12 mt-5">
        <div class="col-md-5 mx-auto text-center">
            <img src="<?= BASE_URL ?>/static/img/no-user.png" class="img-responsive">
            <h4 class="mt-3">Tidak ada pesan.</h4>
        </div>
    </div>
<?php endif; ?>

<div class="shadow-sm p-1 bg-white rounded">
<table class="table table-hover bg-white">
  <thead class="table-dark">
    <tr>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($hasil_users['data'] as $u) : ?>
      <tr>
        <td scope="row"><?= $u['nama_user'] ?></td>
        <td scope="row"><?= $u['email_user'] ?></td>
        <td>
              <div class="aksi">
              <?php if ($u['status_user'] == 0) : ?>
                <a href="#" class="aksi-item" onclick="confirm('Lepas Blokir: <?= $u['nama_user'] ?>?') ? window.location = '?view=users&&unblok=<?= $u['id_user'] ?>' : false"><img src="../static/icons/unlock.svg"/></a>
              <?php else : ?>
                <a href="#" class="aksi-item" onclick="confirm('Blokir: <?= $u['nama_user'] ?>?') ? window.location = '?view=users&&blok=<?= $u['id_user'] ?>' : false"><img src="../static/icons/report.svg"/></a>
              <?php endif; ?>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>

<?php require_once '../partial/page.php' ?>