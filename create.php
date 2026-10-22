<?php
session_start();
require "koneksi.php";
require "includes/lang.php";
require "includes/fungsi.php";
cek_login();

$error = [];
$val   = ["nim" => "", "nama" => "", "email" => "", "jurusan" => "", "angkatan" => ""];

if (isset($_POST["simpan"])) {
    $val   = ambil_input();
    $error = validasi_mahasiswa($val);

    try {
        // Cek apakah NIM sudah dipakai
        if (empty($error)) {
            $stmt = $pdo->prepare("SELECT id FROM mahasiswa WHERE nim = :nim");
            $stmt->execute([":nim" => $val["nim"]]);
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                $error[] = t("err_dup");
            }
        }

        // CREATE: simpan data baru
        if (empty($error)) {
            $stmt = $pdo->prepare(
                "INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan)
                 VALUES (:nim, :nama, :email, :jurusan, :angkatan)"
            );
            $stmt->execute([
                ":nim"      => $val["nim"],
                ":nama"     => $val["nama"],
                ":email"    => $val["email"],
                ":jurusan"  => $val["jurusan"],
                ":angkatan" => $val["angkatan"]
            ]);

            $_SESSION["pesan"] = t("ok_add");
            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        $error[] = t("err_db").$e->getMessage();
    }
}

include "includes/header.php";
?>
<h2><?= e(t('add_student')) ?></h2>

<?php if (!empty($error)): ?>
  <div class="err">
    <?php foreach ($error as $pesan_error): ?>
      - <?= e($pesan_error) ?><br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<form method="POST" action="<?= e($_SERVER['PHP_SELF']) ?>">
  <?php include "includes/form_fields.php"; ?>
  <br><br>
  <button class="btn" type="submit" name="simpan"><?= e(t('save')) ?></button>
  <a class="btn btn-gray" href="index.php"><?= e(t('back')) ?></a>
</form>
<?php include "includes/footer.php"; ?>
