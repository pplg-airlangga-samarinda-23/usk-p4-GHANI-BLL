<?php
include 'koneksi.php';

$sql = "SELECT * FROM buku ORDER BY id DESC";
$result = $koneksi->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Perpustakaan Airlangga</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Perpustakaan Airlangga</div>
            <ul class="nav-menu">
                <li><a href="index.php">Katalog Buku</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

    <div class="books-section">
        <div class="book-container">
            <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <div class="book-title"><?= htmlspecialchars($book['judul']) ?></div>
                    <div class="book-author"><?= htmlspecialchars($book['pengarang']) ?></div>
                    <div class="book-stock <?= $book['stok'] > 0 ? 'available' : 'out' ?>">
                        Stok: <?= htmlspecialchars($book['stok']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>

</body>

</html>