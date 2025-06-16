<?php
require_once "../koneksi.php";
require_once "../query/menu.php";
$db = (new Database())->connection();
$menu = new menu($db);
$data = $menu->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMBERIO COFFEE</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <nav class="navbar">
        <div class="brand">
            <img src="gambar/logoo.png" alt="Logo coffeshop" class="logo">
            <div class="name">RIMBERIO COFFEE</div>
        </div>
        <div class="menu">
            <a href="berandaAdmin.php">Beranda</a>
            <a href="viewmenu.php" class="active">Katalog</a>
            <a href="viewakun_admin.php" >View Akun</a>
            <a href="transaksi.php">Transaksi</a>
            <a href="akunAdmin.php">Akun</a>
            <a href="editmenu.php">Input Menu</a>
        </div>
    </nav>

    </div>
    <div class="menu">
                <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="menu-item">
                        <img src="<?= htmlspecialchars($row['gambarMenu']) ?>" alt="<?= htmlspecialchars($row['namaMenu']) ?>" />
                        <h3 class="menu-nama"><?= htmlspecialchars($row['namaMenu']) ?></h3>
                        <p class="menu-harga">Rp<?= number_format($row['hargaMenu'], 0, ',', '.') ?></p>
                    </div>
                <?php endwhile; ?>
    </div>
</body>
</html>