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

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$anggota = $result->fetch_assoc();

if (!$anggota) {
    echo "Data anggota tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    $update = $koneksi->prepare("UPDATE users SET username=?, role=? WHERE id=?");
    $update->bind_param("ssi", $username, $role, $id);
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
    <title>Edit Anggota</title>
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

    <div class="data-main-content">
        <h1>Edit Anggota</h1>

        <form method="POST" action="">
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username" value="<?= htmlspecialchars($anggota['username']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="role">Role:</label></td>
                    <td>
                        <select name="role" id="role" required>
                            <option value="admin" <?= $anggota['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $anggota['role'] == 'user' ? 'selected' : '' ?>>User</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <button type="submit">Simpan</button>
                        <a href="index.php">Batal</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>