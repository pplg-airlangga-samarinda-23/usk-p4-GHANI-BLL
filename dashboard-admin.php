<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <a href="dashboard-admin.php" class="active">Dashboard</a>
        <a href="buku/index.php">Data Buku</a>
        <a href="anggota/index.php">Data Anggota</a>
        <a href="peminjaman/index.php">Data Peminjaman</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>

<div class="main-content">
    <h2>Selamat datang Admin, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
    <p>Ini adalah halaman dashboard admin.</p>
</div>


</html>