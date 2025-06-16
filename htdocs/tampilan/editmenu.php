<?php
session_start();

require_once "../koneksi.php";
require_once "../query/menu.php";

$db = (new Database())->connection();
$menu = new menu($db);
$data = $menu->readAll();
if(isset($_GET['delete'])) {
        $menu->kodeMenu = $_GET['delete'];
        $menu->delete();
        header("location:editmenu.php");
        exit;
    }
    $data = $menu->readAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coffee Rimberio</title>
  <link rel="stylesheet" href="style1.css">
  <style>
    .tombol {
  display: flex;
  justify-content: center;
  margin: 20px 0;
}

.btn-tambah {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 8px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.btn-tambah:hover {
  background-color: #45a049;
}

  </style>
</head>
<body>
  <div class="navbar">
    <img src="gambar/logo1.png" alt="Logo" class="logo" />
    <h2>RIMBERIO COFFEE</h2>
    <div class="menu">
            <a href="berandaAdmin.php">Beranda</a>
            <a href="viewmenu.php">Katalog</a>
            <a href="viewakun_admin.php" >View Akun</a>
            <a href="transaksi.php">Transaksi</a>
            <a href="akunAdmin.php">Akun</a>
            <a href="editmenu.php" class="active">Input Menu</a>
        </div>
   
  </div>
 <div class="tombol"><a class="btn-tambah" href="inputmenu.php">Tambahkan Produk</a></div>
    <div class="menu">
                <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="menu-item">
                        <img src="<?= htmlspecialchars($row['gambarMenu']) ?>" alt="<?= htmlspecialchars($row['namaMenu']) ?>" />
                        <h3 class="menu-nama"><?= htmlspecialchars($row['namaMenu']) ?></h3>
                        <p class="menu-harga">Rp<?= number_format($row['hargaMenu'], 0, ',', '.') ?></p>
                        <button class="tambah-btn" data-id="<?= $row['kodeMenu'] ?>" data-nama="<?= htmlspecialchars($row['namaMenu']) ?>">
                            + Tambah
                        </button>
                        <div class="action-buttons">
                            <a href="inputmenu.php?edit=<?php echo $row['kodeMenu']; ?>" class="btn-link">Edit</a>
                            <a href="editmenu.php?delete=<?php echo $row['kodeMenu']; ?>" class="btn-link"
                            onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

</body>
</html>
