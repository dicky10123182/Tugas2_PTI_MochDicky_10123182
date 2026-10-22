<?php
// Pilihan bahasa disimpan di $_SESSION["lang"] agar konsisten antar halaman
if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = "id";
}

// Array multidimensi: bahasa => (kunci => teks)
$terjemahan = [
    "id" => [
        "app_title"      => "Sistem Informasi Data Mahasiswa",
        "login"          => "Masuk",
        "logout"         => "Keluar",
        "username"       => "Nama Pengguna",
        "password"       => "Kata Sandi",
        "login_failed"   => "Nama pengguna atau kata sandi salah.",
        "welcome"        => "Selamat datang",
        "student_list"   => "Daftar Mahasiswa",
        "add_student"    => "Tambah Mahasiswa",
        "edit_student"   => "Ubah Mahasiswa",
        "no"             => "No",
        "nim"            => "NIM",
        "name"           => "Nama",
        "email"          => "Email",
        "major"          => "Jurusan",
        "year"           => "Angkatan",
        "action"         => "Aksi",
        "edit"           => "Ubah",
        "delete"         => "Hapus",
        "save"           => "Simpan",
        "back"           => "Kembali",
        "choose_major"   => "-- Pilih Jurusan --",
        "confirm_delete" => "Yakin ingin menghapus data ini?",
        "err_empty"      => "Semua kolom wajib diisi.",
        "err_nim"        => "NIM harus berupa angka 8-10 digit.",
        "err_email"      => "Format email tidak valid.",
        "err_major"      => "Jurusan tidak valid.",
        "err_year"       => "Angkatan harus berupa angka antara 2000 dan tahun sekarang.",
        "err_dup"        => "NIM sudah terdaftar.",
        "err_db"         => "Terjadi kesalahan pada database: ",
        "ok_add"         => "Data berhasil ditambahkan.",
        "ok_edit"        => "Data berhasil diubah.",
        "ok_delete"      => "Data berhasil dihapus.",
        "empty_data"     => "Belum ada data."
    ],
    "en" => [
        "app_title"      => "Student Data Information System",
        "login"          => "Login",
        "logout"         => "Logout",
        "username"       => "Username",
        "password"       => "Password",
        "login_failed"   => "Wrong username or password.",
        "welcome"        => "Welcome",
        "student_list"   => "Student List",
        "add_student"    => "Add Student",
        "edit_student"   => "Edit Student",
        "no"             => "No",
        "nim"            => "Student ID",
        "name"           => "Name",
        "email"          => "Email",
        "major"          => "Major",
        "year"           => "Class Year",
        "action"         => "Action",
        "edit"           => "Edit",
        "delete"         => "Delete",
        "save"           => "Save",
        "back"           => "Back",
        "choose_major"   => "-- Select Major --",
        "confirm_delete" => "Are you sure you want to delete this record?",
        "err_empty"      => "All fields are required.",
        "err_nim"        => "Student ID must be 8-10 digits.",
        "err_email"      => "Invalid email format.",
        "err_major"      => "Invalid major.",
        "err_year"       => "Class year must be a number between 2000 and the current year.",
        "err_dup"        => "Student ID is already registered.",
        "err_db"         => "A database error occurred: ",
        "ok_add"         => "Record added successfully.",
        "ok_edit"        => "Record updated successfully.",
        "ok_delete"      => "Record deleted successfully.",
        "empty_data"     => "No data yet."
    ]
];

// Mengambil teks sesuai bahasa yang aktif
function t($key) {
    global $terjemahan;
    $lang = $_SESSION["lang"];
    if (array_key_exists($key, $terjemahan[$lang])) {
        return $terjemahan[$lang][$key];
    }
    return $key;
}
