<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
  <title>Coffee Rimberio</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
  <div class="navbar">
    <img src="gambar/logo1.png" alt="Logo" class="logo" />
    <h2>RIMBERIO COFFEE</h2>
    <div class="menu">
        <a href="beranda.php">Beranda</a>
        <a href="katalogmenu.php" class="active">Katalog</a>
        <a href="keranjang.php">Keranjang</a>
        <a href="pembayaran.php">Pembayaran</a>
        <a href="akun.php">Akun</a>
    </div>
  </div>
    <div class="menu">
                <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="menu-item">
                        <img src="<?= htmlspecialchars($row['gambarMenu']) ?>" alt="<?= htmlspecialchars($row['namaMenu']) ?>" />
                        <h3 class="menu-nama"><?= htmlspecialchars($row['namaMenu']) ?></h3>
                        <p class="menu-harga">Rp<?= number_format($row['hargaMenu'], 0, ',', '.') ?></p>
                        <button class="tambah-btn" data-id="<?= $row['kodeMenu'] ?>" data-nama="<?= htmlspecialchars($row['namaMenu']) ?>">
                            + Tambah
                        </button>
                    </div>
                <?php endwhile; ?>
            </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.tambah-btn');

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        const IdMenu = button.dataset.id;
        const namaMenu = button.dataset.nama;
        const hargaElem = button.parentElement.querySelector('.menu-harga');
        const priceText = hargaElem.textContent.replace(/[^\d]/g, '');
        const price = parseInt(priceText);

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const existingItemIndex = cart.findIndex(item => item.id === IdMenu);

        if (existingItemIndex !== -1) {
          cart[existingItemIndex].quantity += 1;
        } else {
          cart.push({
            id: IdMenu,
            name: namaMenu,
            price: price,
            quantity: 1
          });
        }

        localStorage.setItem('cart', JSON.stringify(cart));

        // Optional: Tambah notifikasi singkat
        const toast = document.createElement('div');
        toast.textContent = `${namaMenu} ditambahkan ke keranjang`;
        toast.style.position = 'fixed';
        toast.style.bottom = '30px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.backgroundColor = '#8b4513';
        toast.style.color = 'white';
        toast.style.padding = '10px 20px';
        toast.style.borderRadius = '10px';
        toast.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
        toast.style.zIndex = '9999';
        document.body.appendChild(toast);

        setTimeout(() => toast.remove(), 2000); // Hilang dalam 2 detik
      });
    });
  });
</script>
</body>
</html>