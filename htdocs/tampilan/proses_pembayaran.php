<?php
session_start();
require_once '../koneksi.php';
require_once '../query/transaksi.php';

$db = new Database();
$conn = $db->connection();
$transaksi = new Transaksi($conn);

$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'];
$idPengguna = $_SESSION['idPengguna'];
$tglTransaksi = date('Y-m-d');

foreach ($cart as $item) {
    $kodeMenu = $item['id'];
    $harga = $item['price'];
    $jumlah = $item['quantity'];
    $total = $harga * $jumlah;

    $transaksi->createTransaksi($idPengguna, $kodeMenu, $tglTransaksi, $total);
}

echo json_encode(['status' => 'success']);
?>
