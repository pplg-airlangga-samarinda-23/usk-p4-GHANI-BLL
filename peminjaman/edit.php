<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM peminjam WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$peminjaman = $result->fetch_assoc();

if (!$peminjaman) {
    echo "Data tidak ditemukan";
    exit;
}

$books = $koneksi->query("SELECT id, judul FROM buku ORDER BY judul ASC")->fetch_all(MYSQLI_ASSOC);
$users = $koneksi->query("SELECT id, username FROM users ORDER BY username ASC")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $status = $_POST['status'];

    $update = $koneksi->prepare("UPDATE peminjam SET id_buku=?, id_user=?, tgl_pinjam=?, tgl_kembali=?, status=? WHERE id=?");
    $update->bind_param("iisssi", $id_buku, $id_user, $tgl_pinjam, $tgl_kembali, $status, $id);
    $update->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
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
        <h1>Edit Peminjaman</h1>

        <form action="" method="POST" class="form-admin" style="max-width: 500px; margin: 0 auto;">
            <label for="id_buku">Buku</label>
            <select name="id_buku" id="id_buku" required>
                <?php foreach ($books as $b): ?>
                    <option value="<?= $b['id'] ?>" <?= $peminjaman['id_buku'] == $b['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($b['judul']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <label for="id_user">Peminjam</label>
            <select name="id_user" id="id_user" required>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u['id'] ?>" <?= $peminjaman['id_user'] == $u['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($u['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="tgl_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tgl_pinjam" id="tgl_pinjam" value="<?= $peminjaman['tgl_pinjam'] ?>" required>
            <br>
            <label for="tgl_kembali">Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" id="tgl_kembali" value="<?= $peminjaman['tgl_kembali'] ?>" required>
            <br>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Dipinjam" <?= $peminjaman['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                <option value="Dikembalikan" <?= $peminjaman['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
            </select>
            <br>
            <button type="submit" class="btn-edit">Simpan Perubahan</button>
        </form>
    </div>

</body>

</html>