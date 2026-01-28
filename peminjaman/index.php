<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$sql = "SELECT p.*, b.judul AS judul_buku, u.username AS nama_user
        FROM peminjam p
        JOIN buku b ON p.id_buku = b.id
        JOIN users u ON p.id_user = u.id
        ORDER BY p.id DESC";


$result = $koneksi->query($sql);
$peminjam = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjam</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <a href="../dashboard-admin.php">Dashboard</a>
        <a href="../buku/index.php">Data Buku</a>
        <a href="../anggota/index.php">Data Anggota</a>
        <a href="index.php" class="active">Data Peminjaman</a>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <h1>Data Peminjaman</h1>
        <a href="create.php" class="btn-tambah">+ Tambah Peminjaman</a>

        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($peminjam as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($p['judul_buku'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['nama_user'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['tgl_pinjam'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['tgl_kembali'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['status'] ?? '') ?></td>
                        <td>
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn-edit">Edit</a> |
                            <a href="delete.php?id=<?= $p['id'] ?>" class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>