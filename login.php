<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form action="login_proses.php" method="POST">
        <h2>Login</h2>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
            <p style="color:red; text-align:center;">Username atau password salah!</p>
        <?php endif; ?>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        <div class="daftar">
            Belum punya akun? <a href="register.php">Daftar</a>
        </div>
        <div class="btn-kembali">
            <a href="index.php">➤ Kembali</a>
        </div>
    </form>

</body>

</html>