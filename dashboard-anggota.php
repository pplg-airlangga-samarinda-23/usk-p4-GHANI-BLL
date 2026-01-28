<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

include __DIR__ . '/koneksi.php';

$sql = "SELECT * FROM buku";
$result = $koneksi->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota</title>
    <link rel="stylesheet" href="style.css">

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

    <div class="books-section">
        <div class="book-container">
            <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <div class="book-title"><?= htmlspecialchars($book['judul']) ?></div>
                    <div class="book-author"><?= htmlspecialchars($book['pengarang']) ?></div>
                    <div class="book-stock">Stok: <?= htmlspecialchars($book['stok']) ?></div>

                    <?php if ($book['stok'] > 0): ?>
                        <form action="form-pinjam.php" method="POST">
                            <input type="hidden" name="id_buku" value="<?= $book['id'] ?>">
                            <button type="submit" class="pinjam-btn" onclick=" return confirm('ingin pinjam buku?');"">Pinjam Buku</button>
                        </form>
                    <?php else: ?>
                        <button class=" stok-habis" disabled>Stok Habis</button>
                        <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</body>

</html>