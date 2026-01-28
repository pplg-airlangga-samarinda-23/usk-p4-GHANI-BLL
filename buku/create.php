<?php

include __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = (int) $_POST['stok'];

    $stmt = $koneksi->prepare(
        "INSERT INTO buku (judul, pengarang, stok) VALUES (?,?,?)"
    );
    $stmt->bind_param("ssi", $judul, $pengarang, $stok);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal insert: " . $koneksi->error;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nambah Buku</title>
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
    <div class="data-main-content">
        <h1>Tambah Buku</h2>
            <form action="create.php" method="post">
                <table>
                    <tr>
                        <td>Judul</td>
                        <td><input type="text" name="judul"></td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td><input type="text" name="pengarang"></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td><input type="text" name="stok"></td>
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