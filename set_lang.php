<?php
session_start();

// Simpan pilihan bahasa di session
if (isset($_GET["lang"]) && ($_GET["lang"] == "id" || $_GET["lang"] == "en")) {
    $_SESSION["lang"] = $_GET["lang"];
}

// Kembali ke halaman sebelumnya (hanya halaman milik aplikasi ini)
$boleh   = ["index.php", "login.php", "create.php", "edit.php"];
$halaman = "index.php";
$query   = "";

if (isset($_SERVER["HTTP_REFERER"])) {
    $ref = parse_url($_SERVER["HTTP_REFERER"]);
    if (isset($ref["path"]) && in_array(basename($ref["path"]), $boleh)) {
        $halaman = basename($ref["path"]);
        if (isset($ref["query"])) {
            $query = "?".$ref["query"];
        }
    }
}

header("Location: ".$halaman.$query);
exit;
