<?php
session_start();
require "koneksi.php";
require "includes/lang.php";
require "includes/fungsi.php";
cek_login();

$pesan = "";
if (isset($_SESSION["pesan"])) {
    $pesan = $_SESSION["pesan"];
    unset($_SESSION["pesan"]);
}

// Ambil seluruh data mahasiswa
try {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa ORDER BY id ASC");
    $stmt->execute();
    $mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data: ".$e->getMessage());
}

include "includes/header.php";
?>
<h2><?= e(t('student_list')) ?></h2>
<p><?= e(t('welcome')) ?></p>

<?php if ($pesan != ""): ?>
  <div class="ok"><?= e($pesan) ?></div>
<?php endif; ?>

<p><a class="btn" href="create.php">+ <?= e(t('add_student')) ?></a></p>

<table>
  <tr>
    <th><?= e(t('no')) ?></th>
    <th><?= e(t('nim')) ?></th>
    <th><?= e(t('name')) ?></th>
    <th><?= e(t('email')) ?></th>
    <th><?= e(t('major')) ?></th>
    <th><?= e(t('year')) ?></th>
    <th><?= e(t('action')) ?></th>
  </tr>

  <?php if (count($mahasiswa) == 0): ?>
    <tr><td colspan="7"><?= e(t('empty_data')) ?></td></tr>
  <?php endif; ?>

  <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= e($mhs["nim"]) ?></td>
    <td><?= e($mhs["nama"]) ?></td>
    <td><?= e($mhs["email"]) ?></td>
    <td><?= e($mhs["jurusan"]) ?></td>
    <td><?= e($mhs["angkatan"]) ?></td>
    <td>
      <a class="btn" href="edit.php?id=<?= (int)$mhs["id"] ?>"><?= e(t('edit')) ?></a>
      <form class="inline" method="POST" action="delete.php"
            onsubmit="return confirm('<?= e(t('confirm_delete')) ?>')">
        <input type="hidden" name="id" value="<?= (int)$mhs["id"] ?>">
        <button class="btn btn-red" type="submit"><?= e(t('delete')) ?></button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
<?php include "includes/footer.php"; ?>
