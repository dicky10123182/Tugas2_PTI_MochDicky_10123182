<?php
session_start();
require "koneksi.php";
require "includes/lang.php";
require "includes/fungsi.php";
cek_login();

if (isset($_POST["id"]) && is_numeric($_POST["id"])) {
    try {
        // DELETE berdasarkan id
        $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->execute([":id" => (int)$_POST["id"]]);

        if ($stmt->rowCount() > 0) {
            $_SESSION["pesan"] = t("ok_delete");
        }
    } catch (PDOException $e) {
        $_SESSION["pesan"] = t("err_db").$e->getMessage();
    }
}

header("Location: index.php");
exit;
