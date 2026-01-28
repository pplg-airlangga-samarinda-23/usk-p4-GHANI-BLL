<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form action="register_proses.php" method="POST">
        <h2>Daftar Akun</h2>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "ada"): ?>
            <p style="color:red; text-align:center;">Username sudah dipakai!</p>
        <?php endif; ?>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "beda"): ?>
            <p style="color:red; text-align:center;">Password tidak sama!</p>
        <?php endif; ?>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "sukses"): ?>
            <p style="color:green; text-align:center;">Registrasi berhasil! Silakan login.</p>
        <?php endif; ?>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Daftar</button>

        <div class="daftar">
            Sudah punya akun? <a href="login.php">Login</a>
        </div>
    </form>

</body>

</html>