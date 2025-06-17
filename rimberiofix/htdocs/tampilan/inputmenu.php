<?php
require_once "../koneksi.php";
require_once "../query/menu.php";

$db = (new Database())->connection();
$menu = new menu($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu->kodeMenu = $_POST['kodeMenu'] ?? null;
    $menu->namaMenu = $_POST['namaMenu'];
    $menu->hargaMenu = $_POST['hargaMenu'];

    // Handle file upload
    if (isset($_FILES['fileGambar']) && $_FILES['fileGambar']['error'] == 0) {
        $targetDir = "gambar/"; // Ensure this directory exists and is writable
        $targetFile = $targetDir . basename($_FILES["fileGambar"]["name"]);
        move_uploaded_file($_FILES["fileGambar"]["tmp_name"], $targetFile);
        $menu->gambarMenu = $targetFile; // Save the file path to the database
    } else {
        $menu->gambarMenu = $_POST['gambarMenu'] ?? ''; // Fallback if no file is uploaded
    }

    if (!empty($_POST['isEdit'])) {
        $menu->update();
    } else {
        $menu->create();
    }
    header("location:editmenu.php");
    exit;
}

$editData = null;

if (isset($_GET['edit'])) {
    $editData = $menu->cari($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editData ? 'Edit' : 'Input' ?> Menu</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f3e1c9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #d2a45d;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #d2a45d;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .form-group input[type="submit"]:hover {
            background-color: #d2a45d;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">
            <img src="gambar/logoo.png" alt="Logo coffeshop" class="logo">
            <div class="name">RIMBERIO COFFEE</div>
        </div>
        <div class="menu">
            <a href="berandaAdmin.php">Beranda</a>
            <a href="viewmenu.php.php">Katalog</a>
            <a href="viewakun_admin.php">View Akun</a>
            <a href="Transaksi.php">Transaksi</a>
            <a href="akunAdmin.php">Akun</a>
            <a href="editmenu.php" class="active">Input Menu</a>
        </div>
    </div>
    

    <div class="form-container">
        <h2><?= $editData ? 'Edit' : 'Input' ?> Menu</h2>
        <form id="daftarform" method="POST" enctype="multipart/form-data">
            <?php if ($editData): ?>
                <input type="hidden" name="kodeMenu" value="<?= htmlspecialchars($editData['kodeMenu']) ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="namaMenu">Nama Menu</label>
                <input type="text" id="namaMenu" name="namaMenu" value="<?= htmlspecialchars($editData['namaMenu'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="hargaMenu">Harga</label>
                <input type="text" id="hargaMenu" name="hargaMenu" value="<?= htmlspecialchars($editData['hargaMenu'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="fileGambar">Upload Gambar</label>
                <input type="file" id="fileGambar" name="fileGambar" accept="image/*">
            </div>

            <?php if ($editData): ?>
                <input type="hidden" name="isEdit" value="1">
            <?php endif; ?>

            <div class="form-group">
                <input type="submit" name="Kirim" value="Kirim">
            </div>
        </form>
    </div>
</body>
</html>
