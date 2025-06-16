<?php
session_start();

// Cek apakah user sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - Rimberio Coffee</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
        <nav class="navbar">
        <div class="brand">
            <img src="gambar/logoo.png" alt="Logo coffeshop" class="logo">
            <div class="name">RIMBERIO COFFEE</div>
        </div>
        <div class="menu">
            <a href="berandaAdmin.php" class="active">Beranda</a>
            <a href="viewmenu.php">Katalog</a>
            <a href="viewakun_admin.php">View Akun</a>
            <a href="Transaksi.php">Transaksi</a>
            <a href="akunAdmin.php">Akun</a>
            <a href="editmenu.php">Input Menu</a>
        </div>
    </nav>

    <div class="container">
        <div class="promo box">
            <div class="promo-left">
                <h1>ALL COFFEE VARIANT</h1>
                <p>*syarat dan ketentuan berlaku</p>
            </div>
            <div class="promo-right">
                <strong>DISCOUNT</strong>
                <div class="discount">10%</div>
            </div>
        </div>

        <div class="box">
            <h3>Best Seller</h3>
            <img src="gambar/Cappuccino.jpeg.jpg" alt="Cappuccino" style="max-width:200px;">
            <p><b>CAPPUCCINO</b></p>
            <p>Keseimbangan sempurna antara espresso yang kuat, susu yang lembut, dan rasa yang kaya.</p>
            <div class="price">Rp. 18.000,-</div>
        </div>

        <div class="box">
            <h3>Lokasi Rimberio Coffee</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.5507780215407!2d111.52652647532366!3d-7.623757892391743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79bf2d96837417%3A0x7e9df19917eda7d6!2sPesenMie%20x%20PesenKopi!5e0!3m2!1sid!2sid!4v1745506319987!5m2!1sid!2sid"
                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

</body>
</html>
