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
        <a href="index.php" class="active">Data Buku</a>
        <a href="../anggota/index.php">Data Anggota</a>
        <a href="../peminjaman/index.php">Data Peminjaman</a>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="main-content">
        <h1>Data Buku</h1>
        <a href="create.php">+ Tambah Buku</a>

        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($books as $book) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($book['judul']) ?></td>
                        <td><?= htmlspecialchars($book['pengarang']) ?></td>
                        <td><?= htmlspecialchars($book['stok']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $book['id'] ?>">Edit</a> |
                            <a href="delete.php?id=<?= $book['id'] ?>" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</body>

</html>