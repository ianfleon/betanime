<table class="table table-hover bg-white">
  <thead>
    <tr>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users['data'] as $u) : ?>
      <tr>
        <td scope="row"><?= $u['nama_user'] ?></td>
        <td scope="row"><?= $u['email_user'] ?></td>
        <td>
              <div class="aksi">
              <a href="?view=users&&blok=<?= $u['id_user'] ?>" class="aksi-item"><img src="../static/icons/report.svg"></a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require_once '../partial/page.php' ?>