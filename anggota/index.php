<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $koneksi->query($sql);
$anggota = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="sidebar">
        <div class="logo">Admin Panel</div>
        <a href="../dashboard-admin.php">Dashboard</a>
        <a href="../buku/index.php">Data Buku</a>
        <a href="index.php" class="active">Data Anggota</a>
        <a href="../peminjaman/index.php">Data Peminjaman</a>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <h1>Data Anggota</h1>
        <a href="create.php" class="btn-tambah">+ Tambah Anggota</a>

        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($anggota as $a): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($a['username']) ?></td>
                        <td><?= htmlspecialchars($a['role']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $a['id'] ?>" class="btn-edit">Edit</a> |
                            <a href="delete.php?id=<?= $a['id'] ?>" class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>