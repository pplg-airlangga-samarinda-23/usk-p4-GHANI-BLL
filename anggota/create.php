<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password default

    $stmt = $koneksi->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menambahkan anggota: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
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
        <h1>Tambah Anggota</h1>

        <?php if (!empty($error)) : ?>
            <p style="color: red; text-align: center;"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td><label for="role">Role:</label></td>
                    <td>
                        <select name="role" id="role" required>
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
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