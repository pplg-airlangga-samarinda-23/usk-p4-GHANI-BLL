<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

// Cek password sama atau tidak
if ($password !== $confirm) {
    header("Location: register.php?pesan=beda");
    exit;
}

// Cek username sudah ada atau belum
$stmt = mysqli_prepare($koneksi, "SELECT id FROM user WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_fetch_assoc($result)) {
    header("Location: register.php?pesan=ada");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($koneksi, "INSERT INTO user (username, password, role) VALUES (?, ?, 'siswa')");
mysqli_stmt_bind_param($stmt, "ss", $username, $hash);


if (mysqli_stmt_execute($stmt)) {
    header("Location: register.php?pesan=sukses");
    exit;
} else {
    echo "Gagal menyimpan user.";
}
