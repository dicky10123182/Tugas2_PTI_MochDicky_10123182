<?php
session_start();
require "koneksi.php";
require "includes/lang.php";
require "includes/fungsi.php";

// Jika sudah login, langsung ke halaman utama
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

$error    = "";
$username = "";

if (isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([":username" => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user["username"];
        header("Location: index.php");
        exit;
    } else {
        $error = t("login_failed");
    }
}

include "includes/header.php";
?>
<h2><?= e(t('login')) ?></h2>

<?php if ($error != ""): ?>
  <div class="err"><?= e($error) ?></div>
<?php endif; ?>

<form method="POST" action="<?= e($_SERVER['PHP_SELF']) ?>">
  <label><?= e(t('username')) ?></label>
  <input type="text" name="username" value="<?= e($username) ?>">

  <label><?= e(t('password')) ?></label>
  <input type="password" name="password">

  <br><br>
  <button class="btn" type="submit" name="login"><?= e(t('login')) ?></button>
</form>
<?php include "includes/footer.php"; ?>
