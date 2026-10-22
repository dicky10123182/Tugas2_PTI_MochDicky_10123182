<?php
session_start();
require "koneksi.php";
require "includes/lang.php";
require "includes/fungsi.php";
cek_login();

// Identitas unik data yang akan diubah
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit;
}
$id    = (int)$_GET["id"];
$error = [];

try {
    if (isset($_POST["simpan"])) {
        $val   = ambil_input();
        $error = validasi_mahasiswa($val);

        // Cek NIM tidak dipakai mahasiswa lain
        if (empty($error)) {
            $stmt = $pdo->prepare("SELECT id FROM mahasiswa WHERE nim = :nim AND id <> :id");
            $stmt->execute([":nim" => $val["nim"], ":id" => $id]);
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                $error[] = t("err_dup");
            }
        }

        // UPDATE berdasarkan id
        if (empty($error)) {
            $stmt = $pdo->prepare(
                "UPDATE mahasiswa
                 SET nim = :nim, nama = :nama, email = :email, jurusan = :jurusan, angkatan = :angkatan
                 WHERE id = :id"
            );
            $stmt->execute([
                ":nim"      => $val["nim"],
                ":nama"     => $val["nama"],
                ":email"    => $val["email"],
                ":jurusan"  => $val["jurusan"],
                ":angkatan" => $val["angkatan"],
                ":id"       => $id
            ]);

            $_SESSION["pesan"] = t("ok_edit");
            header("Location: index.php");
            exit;
        }
    } else {
        // Ambil data lama untuk ditampilkan di form
        $stmt = $pdo->prepare("SELECT nim, nama, email, jurusan, angkatan FROM mahasiswa WHERE id = :id");
        $stmt->execute([":id" => $id]);
        $val = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$val) {
            header("Location: index.php");
            exit;
        }
    }
} catch (PDOException $e) {
    $error[] = t("err_db").$e->getMessage();
    if (!isset($val)) {
        $val = ["nim" => "", "nama" => "", "email" => "", "jurusan" => "", "angkatan" => ""];
    }
}

include "includes/header.php";
?>
<h2><?= e(t('edit_student')) ?></h2>

<?php if (!empty($error)): ?>
  <div class="err">
    <?php foreach ($error as $pesan_error): ?>
      - <?= e($pesan_error) ?><br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<form method="POST" action="edit.php?id=<?= $id ?>">
  <?php include "includes/form_fields.php"; ?>
  <br><br>
  <button class="btn" type="submit" name="simpan"><?= e(t('save')) ?></button>
  <a class="btn btn-gray" href="index.php"><?= e(t('back')) ?></a>
</form>
<?php include "includes/footer.php"; ?>
