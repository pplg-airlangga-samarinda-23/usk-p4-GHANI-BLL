<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$sql = "SELECT * FROM buku";
$result = $koneksi->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <a href="../dashboard-admin.php" class="active">Dashboard</a>
        <a href="../buku/index.php" class="active">Data Buku</a>
        <a href="../anggota/index.php">Data Anggota</a>
        <a href="../peminjaman/index.php">Data Peminjaman</a>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>

</body>

</html>