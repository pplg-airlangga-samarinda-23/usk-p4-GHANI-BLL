<?php
include __DIR__ . '/../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM buku WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $koneksi->error;
    }

    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}

$koneksi->close();
