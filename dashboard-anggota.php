<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

include __DIR__ . '/koneksi.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

if ($keyword) {
    $sql = "SELECT * FROM buku WHERE judul LIKE ? OR pengarang LIKE ? ORDER BY id DESC";
    $stmt = $koneksi->prepare($sql);
    $searchTerm = "%$keyword%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $sql = "SELECT * FROM buku ORDER BY id DESC";
    $result = $koneksi->query($sql);
    $books = $result->fetch_all(MYSQLI_ASSOC);
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
<style>
    .search {
        text-align: center;
        margin: 20px 0;
    }
</style>

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

    <div class="search">
        <form method="GET" action="dashboard-anggota.php">
            <input type="text" name="keyword" placeholder="Cari judul atau pengarang..." value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="books-section">
        <div class="book-container">
            <?php if ($books): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <div class="book-title"><?= htmlspecialchars($book['judul']) ?></div>
                        <div class="book-author"><?= htmlspecialchars($book['pengarang']) ?></div>
                        <div class="book-stock">Stok: <?= htmlspecialchars($book['stok']) ?></div>

                        <?php if ($book['stok'] > 0): ?>
                            <form action="form-pinjam.php" method="POST">
                                <input type="hidden" name="id_buku" value="<?= $book['id'] ?>">
                                <button type="submit" class="pinjam-btn" onclick="return confirm('Ingin pinjam buku?');">Pinjam Buku</button>
                            </form>
                        <?php else: ?>
                            <button class="stok-habis" disabled>Stok Habis</button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; width: 100%;">Buku tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>