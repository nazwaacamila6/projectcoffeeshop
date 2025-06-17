<?php
require_once "../database.php";
require_once "../query/pengguna.php";

session_start();
$db = (new Database())->connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM pengguna WHERE namaPengguna = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['pw'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php"); // arahkan ke halaman setelah login
        exit;
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location.href='login.html';</script>";
    }
}
