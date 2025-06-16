<?php
require_once "../koneksi.php";
require_once "../query/pengguna.php";
$db = (new Database())->connection();
$pengguna = new pengguna($db);
$data = $pengguna->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMBERIO COFFEE</title>
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
            <a href="viewmenu.php">Katalog</a>
            <a href="viewakun.php" class="active">View Akun</a>
            <a href="transaksi.php">Transaksi</a>
            <a href="akunAdmin.php">Akun</a>
            <a href="editmenu.php">Input Menu</a>
        </div>
    </nav>

    <h2 style="text-align:center;">Data Pengguna</h2>
    <div class="container" style="display: flex; justify-content: center;">
        <div class="tabel-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Pengguna</th>
                    <th>Email Pengguna</th>
                    <th>Member</th>
                    <th>No. Telp</th>
                    <th>Nama Lengkap</th>
                </tr>
                <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?= $row['idPengguna'] ?></td>
                        <td><?= $row['namaPengguna'] ?></td>
                        <td><?= $row['emailPengguna'] ?></td>
                        <td><?= $row['memberPengguna'] ?></td>
                        <td><?= $row['nomor'] ?></td>
                        <td><?= $row['nama'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
