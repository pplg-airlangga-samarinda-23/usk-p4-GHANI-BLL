<?php
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM buku WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];

    $sql_update = "UPDATE buku SET judul = ?, pengarang = ?, stok = ? WHERE id = ?";
    $stmt_update = $koneksi->prepare($sql_update);
    $stmt_update->bind_param("ssii", $judul, $pengarang, $stok, $id);

    if ($stmt_update->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . $koneksi->error;
    }

    $stmt_update->close();
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>

<body>
    <h1>Edit Data Buku</h1>

    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="judul">Judul:</label></td>
                <td><input type="text" name="judul" id="judul" value="<?= htmlspecialchars($book['judul']) ?>" required></td>
            </tr>
            <tr>
                <td><label for="pengarang">Pengarang:</label></td>
                <td><input type="text" name="pengarang" id="pengarang" value="<?= htmlspecialchars($book['pengarang']) ?>" required></td>
            </tr>
            <tr>
                <td><label for="stok">Stok:</label></td>
                <td><input type="number" name="stok" id="stok" value="<?= $book['stok'] ?>" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="index.php">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>