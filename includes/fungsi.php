<?php
// Daftar jurusan (array) untuk dropdown
$daftar_jurusan = [
    "Teknik Informatika",
    "Sistem Informasi",
    "Manajemen",
    "Desain Komunikasi Visual"
];

// Sanitasi output: mencegah XSS (Cross-Site Scripting)
function e($teks) {
    return htmlspecialchars($teks, ENT_QUOTES, "UTF-8");
}

// Proteksi halaman: hanya boleh diakses jika sudah login
function cek_login() {
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit;
    }
}

// Mengambil dan membersihkan data dari form
function ambil_input() {
    $kolom = ["nim", "nama", "email", "jurusan", "angkatan"];
    $data  = [];

    foreach ($kolom as $k) {
        if (isset($_POST[$k])) {
            $data[$k] = trim($_POST[$k]);
        } else {
            $data[$k] = "";
        }
    }

    // Sanitasi email: hapus karakter yang tidak valid
    $data["email"] = filter_var($data["email"], FILTER_SANITIZE_EMAIL);

    return $data;
}

// Validasi data mahasiswa. Mengembalikan array pesan error (kosong jika valid)
function validasi_mahasiswa($data) {
    $error = [];

    // Struktur kontrol if-else
    if (empty($data["nim"]) || empty($data["nama"]) || empty($data["email"])
        || empty($data["jurusan"]) || empty($data["angkatan"])) {
        $error[] = t("err_empty");
    } else {
        if (!preg_match("/^[0-9]{8,10}$/", $data["nim"])) {
            $error[] = t("err_nim");
        }

        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $error[] = t("err_email");
        }

        // Struktur kontrol switch untuk memeriksa jurusan
        switch ($data["jurusan"]) {
            case "Teknik Informatika":
            case "Sistem Informasi":
            case "Manajemen":
            case "Desain Komunikasi Visual":
                break;
            default:
                $error[] = t("err_major");
        }

        if (!is_numeric($data["angkatan"])) {
            $error[] = t("err_year");
        } elseif ($data["angkatan"] < 2000 || $data["angkatan"] > date("Y")) {
            $error[] = t("err_year");
        }
    }

    return $error;
}
