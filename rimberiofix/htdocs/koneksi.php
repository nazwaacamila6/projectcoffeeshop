<?php
class Database {
    private $host = "sql311.infinityfree.com";
    private $username = "if0_39246890";      
    private $password = "hBXVFsIQm7xZ";
    private $dbname = "if0_39246890_db_coffeshop";
    private $port = 3306;
    private $conn;

    public function connection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
    throw new Exception("Koneksi ke database gagal: " . $exception->getMessage());
    }
        return $this->conn;
    }
}