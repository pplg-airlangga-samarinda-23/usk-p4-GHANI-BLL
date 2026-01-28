<?php

session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_buku = $_POST['id_buku'];
$tanggal = date('Y-m-d');

$cek = $koneksi->prepare("SELECT stok FROM buku WHERE id = ?");
$cek->bind_param("i", $id_buku);
$cek->execute();
$data = $cek->get_result()->fetch_assoc();

if ($data && $data['stok'] > 0) {

    $update = $koneksi->prepare("UPDATE buku SET stok = stok - 1 WHERE id = ?");
    $update->bind_param("i", $id_buku);
    $update->execute();

    $insert = $koneksi->prepare(
        "INSERT INTO peminjam (id_user, id_buku, tgl_pinjam, tgl_kembali, status)
     VALUES (?, ?, ?, NULL, 'Dipinjam')"
    );
    $insert->bind_param("iis", $id_user, $id_buku, $tanggal);
    if (!$insert->execute()) {
        die("Error insert peminjaman: " . $insert->error);
    }
}

header("Location: dashboard-anggota.php");
exit;
