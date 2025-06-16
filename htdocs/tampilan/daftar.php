<?php
require_once "../koneksi.php";
require_once "../query/pengguna.php";

$db = (new Database())->connection();
$pengguna = new Pengguna($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pengguna->idPengguna = $_POST['idPengguna'] ?? null;
    $pengguna->namaPengguna = $_POST['namaPengguna'];
    $pengguna->emailPengguna = $_POST['emailPengguna'];
    $pengguna->memberPengguna = $_POST['memberPengguna'];
    $pengguna->nomor = $_POST['nomor'];
    $pengguna->nama = $_POST['nama'];
    $pengguna->pw = $_POST['pw'];

    if(!empty($_POST['isEdit'])){
        $pengguna->update();
        header("location:akun.php");
        exit;
    }else {
        $pengguna->create();
        header("location:login.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran CoffeeShop</title>
    <link rel="stylesheet" href="stylepend.css">
</head>
<body>

    <div class="container">
        <h2>Pendaftaran CoffeeShop</h2>
        <!-- Tambah method POST biar data ke PHP! -->
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= $editData['nama'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="emailPengguna" name="emailPengguna" value="<?= $editData['emailPengguna'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor HP</label>
                <input type="tel" id="nomor" name="nomor" value="<?= $editData['nomor'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="memberPengguna">Keanggotaan</label>
                <select id="memberPengguna" name="memberPengguna" value="<?= $editData['memeberPengguna'] ?? '' ?>" required>
                    <option value="silver">Silver</option>
                    <option value="gold">Gold</option>
                    <option value="platinum">Platinum</option>
                </select>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="namaPengguna" id="namaPengguna" value="<?= $editData['namaPengguna'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="pw" id="pw" value="<?= $editData['pw'] ?? '' ?>" required>
            </div>

            <form action="login.php" method="get">
            <button type="submit">Daftar </button>
            </form>

        </form>
    </div>

</body>
</html>