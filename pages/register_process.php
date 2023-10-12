<?php
session_start();
include "../conf/conn.php"; // Gantilah dengan file konfigurasi database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama = $_POST["nama_user"];
    $level = $_POST["id_level"];

    // Periksa apakah username sudah digunakan
    $checkQuery = "SELECT id_user FROM user WHERE username = ?";
    $stmtCheck = mysqli_prepare($koneksi, $checkQuery);
    mysqli_stmt_bind_param($stmtCheck, "s", $username);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        // Username sudah digunakan
        header("Location: register.php?error=1"); // Redirect kembali ke halaman registrasi dengan pesan error
        exit();
    } else {
        // Buat akun baru
        $insertQuery = "INSERT INTO user (username, nama_user, password, id_level) VALUES (?, ?, ?, ?)";
        $stmtInsert = mysqli_prepare($koneksi, $insertQuery);
        mysqli_stmt_bind_param($stmtInsert, "ssss", $username, $nama,$password, $level);

        if (mysqli_stmt_execute($stmtInsert)) {
            // Registrasi berhasil
            header("Location: login.php"); // Redirect ke halaman login setelah registrasi berhasil
            exit();
        } else {
            // Registrasi gagal
            header("Location: register.php?error=2"); // Redirect kembali ke halaman registrasi dengan pesan error
            exit();
        }
    }
} else {
    // Jika akses langsung ke file ini tanpa melalui form registrasi, maka redirect ke halaman registrasi
    header("Location: register.php");
    exit();
}
