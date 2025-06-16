<?php
require_once "../koneksi.php";
require_once "../query/transaksi.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = (new Database())->connection();
$transaksi = new Transaksi($db);
$data = $transaksi->readAllTransaksiWithDetails();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - Rimberio Coffee</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <nav class="navbar">
        <div class="brand">
            <img src="gambar/logoo.png" alt="Logo coffeshop" class="logo">
            <div class="name">RIMBERIO COFFEE</div>
        </div>
        <div class="menu">
            <a href="berandaAdmin.php">Beranda</a>
            <a href="inputmenu.php">Katalog</a>
            <a href="viewakun.php">View Akun</a>
            <a href="transaksi.php" class="active">Transaksi</a>
            <a href="akunAdmin.php">Akun</a>
            <a href="editmenu.php">Input Menu</a>
        </div>
    </nav>

    <h2 style="text-align:center;">Data Transaksi</h2>
    <div class="container" style="display: flex; justify-content: center;">
        <div class="tabel-container">
            <table>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Menu</th>
                    <th>Total Harga</th>
                </tr>
                <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?= $row['kodeTransaksi'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['namaMenu'] ?></td>
                        <td>Rp <?= number_format($row['totalHarga'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
