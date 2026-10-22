CREATE DATABASE IF NOT EXISTS db_kampus;

USE db_kampus;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id       INT PRIMARY KEY AUTO_INCREMENT,
    nim      VARCHAR(10)  NOT NULL UNIQUE,
    nama     VARCHAR(100) NOT NULL,
    email    VARCHAR(100) NOT NULL,
    jurusan  VARCHAR(100) NOT NULL,
    angkatan YEAR         NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id       INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50)  NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES
('10123001', 'Budi Santoso', 'budi@email.com', 'Teknik Informatika', 2023),
('10123002', 'Sari Dewi', 'sari@email.com', 'Sistem Informasi', 2023);

-- Akun login: username admin, password admin123
INSERT INTO users (username, password) VALUES
('admin', '$2b$12$1j5609bePDGu6ZSUc86TL.LrxjGuW6hSHmHJXtusoPpK1kscuKsCi');
