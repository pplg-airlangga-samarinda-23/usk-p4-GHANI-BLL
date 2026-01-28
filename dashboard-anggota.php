<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
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
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Perpustakaan Airlangga</div>
            <ul class="nav-menu">
                <li><a href="dashboard-anggota.php">Katalog Buku</a></li>
                <li><a href="form-pengembalian.php">Kembalikan</a></li>
                <div class="logout-container">
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>

            </ul>
        </div>
    </nav>

</body>

</html>