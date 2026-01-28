<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = mysqli_prepare($koneksi, "SELECT id, username, password, role FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: dashboard-admin.php");
    } else {
        header("Location: dashboard-anggota.php");
    }
    exit;
} else {
    header("Location: login.php?pesan=gagal");
    exit;
}
