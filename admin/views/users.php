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
    <?php foreach($users['data'] as $u) : ?>
      <tr>
        <td scope="row"><?= $u['nama_user'] ?></td>
        <td scope="row"><?= $u['email_user'] ?></td>
        <td>
              <div class="aksi">
              <a href="#" class="aksi-item" onclick="confirm('Blokir: <?= $u['nama_user'] ?>?') ? window.location = '?view=users&&blok=<?= $u['id_user'] ?>' : false"><img src="../static/icons/report.svg"/></a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php require_once '../partial/page.php' ?>