<?php
session_start(); 
require_once "../koneksi.php"; // Pastikan file ini benar-benar menghubungkan ke database
require_once "../query/pengguna.php"; // Jika tidak dipakai untuk login, bisa dihapus

$database = new Database();
$con = $database->connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUser = $_POST['namaPengguna'];
    $inputPass = $_POST['pw'];

    // Query untuk ambil data pengguna berdasarkan namaPengguna
    $stmt = $con->prepare("SELECT * FROM tpengguna WHERE namaPengguna = :namaPengguna");
    $stmt->execute(['namaPengguna' => $inputUser]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validasi login
    if ($user && $inputPass === $user['pw']) {
        $_SESSION['idPengguna'] = $user['idPengguna'];
        $_SESSION['namaPengguna'] = $user['namaPengguna'];
        $_SESSION['role'] = $user['role'];

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header("Location: berandaAdmin.php");
        } else {
            header("Location: Beranda.php");
        }
        exit();
    } else {
        // Jika login gagal
        echo "<script>alert('Login gagal. Periksa nama pengguna atau kata sandi.'); window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In CoffeeShop</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(235, 207, 153);
            align-items: center;
            height: 100vh;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 500px;
            text-align: left;
            background: rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-group label {
            width: 120px;
            font-weight: bold;
        }
        .form-group input, 
        .form-group select {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            outline: none;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #8B4513;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #5A2D0C;
        }
        .form-links {
            display: flex;
            justify-content: space-between;
        }
        .form-links a {
            text-decoration: none;
            color: #8B4513;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Masuk Rimberio Coffee</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="namaPengguna">Nama Pengguna</label>
                <input type="text" id="namaPengguna" name="namaPengguna" required>
            </div>

            <div class="form-group">
                <label for="pw">Kata Sandi</label>
                <input type="password" id="pw" name="pw" required>
            </div>

            <div class="form-links">
                <a href="lupaPassword.php">Lupa Sandi</a>
                <a href="daftar.php">Daftar</a>
            </div>

            <!-- Perbaikan: Gunakan type="submit" agar form terkirim -->
            <button type="submit">Masuk</button>
        </form>
    </div>

</body>
</html>
