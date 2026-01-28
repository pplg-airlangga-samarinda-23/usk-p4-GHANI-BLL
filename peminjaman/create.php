<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$buku_result = $koneksi->query("SELECT id, judul, stok FROM buku");
$buku_list = $buku_result->fetch_all(MYSQLI_ASSOC);

$anggota_result = $koneksi->query("SELECT id, username FROM users");
$anggota_list = $anggota_result->fetch_all(MYSQLI_ASSOC);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $status = $_POST['status'];

    $stmt = $koneksi->prepare("INSERT INTO peminjam (id_buku, id_user, tgl_pinjam, tgl_kembali, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $id_buku, $id_user, $tgl_pinjam, $tgl_kembali, $status);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menambahkan peminjaman: " . $koneksi->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
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

    <div class="data-main-content">
        <h1>Tambah Peminjaman</h1>

        <?php if (!empty($error)) : ?>
            <p style="color:red; text-align:center;"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <table>
                <tr>
                    <td><label for="id_buku">Buku:</label></td>
                    <td>
                        <select name="id_buku" id="id_buku" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($buku_list as $b): ?>
                                <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['judul']) ?> (Stok: <?= $b['stok'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="id_user">Peminjam:</label></td>
                    <td>
                        <select name="id_user" id="id_user" required>
                            <option value="">-- Pilih Peminjam --</option>
                            <?php foreach ($anggota_list as $u): ?>
                                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['username']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="tgl_pinjam">Tanggal Pinjam:</label></td>
                    <td><input type="date" name="tgl_pinjam" id="tgl_pinjam" required></td>
                </tr>
                <tr>
                    <td><label for="tgl_kembali">Tanggal Kembali:</label></td>
                    <td><input type="date" name="tgl_kembali" id="tgl_kembali" required></td>
                </tr>
                <tr>
                    <td><label for="status">Status:</label></td>
                    <td>
                        <select name="status" id="status" required>
                            <option value="Dipinjam" selected>Dipinjam</option>
                            <option value="Kembali">Kembali</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <button type="submit">Simpan</button>
                        <a href="index.php">Batal</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>