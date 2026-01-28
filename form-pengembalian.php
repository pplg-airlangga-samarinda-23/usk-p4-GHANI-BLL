<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id_user'];
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $tgl_kembali = isset($_POST['tgl_kembali']) ? $_POST['tgl_kembali'] : date('Y-m-d');

    $koneksi->begin_transaction();

    try {
        $stmt = $koneksi->prepare("SELECT id_buku FROM peminjam WHERE id=? AND id_user=? AND status='Dipinjam'");
        $stmt->bind_param("ii", $id, $user_id);
        $stmt->execute();
        $peminjaman = $stmt->get_result()->fetch_assoc();

        if (!$peminjaman) {
            throw new Exception("Data peminjaman tidak ditemukan.");
        }

        $stmt = $koneksi->prepare("UPDATE peminjam SET status='Dikembalikan', tgl_kembali=? WHERE id=?");
        $stmt->bind_param("si", $tgl_kembali, $id);
        $stmt->execute();

        $stmt = $koneksi->prepare("UPDATE buku SET stok = stok + 1 WHERE id=?");
        $stmt->bind_param("i", $peminjaman['id_buku']);
        $stmt->execute();

        $koneksi->commit();
        $message = "Buku berhasil dikembalikan!";
        $message_type = "success";
    } catch (Exception $e) {
        $koneksi->rollback();
        $message = $e->getMessage();
        $message_type = "error";
    }
}

$stmt = $koneksi->prepare("SELECT p.id, b.judul, p.tgl_pinjam FROM peminjam p 
JOIN buku b ON p.id_buku = b.id WHERE p.id_user=? AND p.status='Dipinjam' ORDER BY p.tgl_pinjam DESC");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Perpustakaan Airlangga</div>
            <ul class="nav-menu">
                <li><a href="dashboard-anggota.php">Katalog Buku</a></li>
                <li><a href="form-pengembalian.php" class="active">Kembalikan</a></li>
                <div class="logout-container">
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </ul>
        </div>
    </nav>

    <div class="text">
        <h2>Pengembalian Buku</h2>
    </div>
    <div class="content-wrapper">

        <?php if ($message): ?>
            <div class="message <?= $message_type ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id">Pilih Buku</label>
                    <select name="id" id="id" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>">
                                <?= htmlspecialchars($row['judul']) ?>
                                (Jatuh tempo: <?= date('d M Y', strtotime($row['tgl_pinjam'])) ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Pengembalian</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" value="<?= date('Y-m-d') ?>" required>
                </div>

                <button type="submit" class="btn-submit" onclick="return confirm('Konfirmasi pengembalian buku ini?')">
                    Proses Pengembalian
                </button>
            </form>
        <?php else: ?>
            <div class="empty-state">
                <p>Tidak ada buku yang sedang dipinjam.</p>
                <p><a href="dashboard-anggota.php">Lihat Katalog Buku</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>