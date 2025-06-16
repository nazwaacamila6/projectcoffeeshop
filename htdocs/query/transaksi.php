<?php
class Transaksi {
    private $conn;
    private $table_name = "ttransaksi";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Buat transaksi baru
    public function createTransaksi($idPengguna, $kodeMenu, $totalHarga) {
    $query = "INSERT INTO " . $this->table_name . "
              (idPengguna, kodeMenu, tgltransaksi, totalHarga)
              VALUES (:idPengguna, :kodeMenu, :tgltransaksi, :totalHarga)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':idPengguna', $idPengguna); 
    $stmt->bindParam(':kodeMenu', $kodeMenu);
    $stmt->bindParam(':totalHarga', $totalHarga);
   
    return $stmt->execute() ? $this->conn->lastInsertId() : false;
}

public function readAllTransaksiWithDetails() {
    $query = "
        SELECT 
            ttransaksi.kodeTransaksi,
            tpengguna.nama AS nama,
            tmenu.namaMenu,
            ttransaksi.totalHarga
        FROM ttransaksi
        JOIN tmenu ON ttransaksi.kodeMenu = tmenu.kodeMenu
        JOIN tpengguna ON ttransaksi.idPengguna = tpengguna.idPengguna
        ORDER BY ttransaksi.kodeTransaksi DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}
}
?>