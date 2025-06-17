
<?php
    class pengguna {
        private $con;
        private $table = "tpengguna";
        public $idPengguna, $namaPengguna, $emailPengguna, $memberPengguna, $nomor,
        $nama, $pw, $role;

        public function __construct($db) {
            $this->con = $db;
        }

        public function create() {
        $hashedPw = password_hash($this->pw, PASSWORD_DEFAULT);

        $query = "INSERT INTO {$this->table} (namaPengguna, emailPengguna, memberPengguna, nomor, nama, pw, role) 
              VALUES (:namaPengguna, :emailPengguna, :memberPengguna, :nomor, :nama, :pw, :role)";
        $statement = $this->con->prepare($query);
        $statement->bindParam(":namaPengguna", $this->namaPengguna);
        $statement->bindParam(":emailPengguna", $this->emailPengguna);
        $statement->bindParam(":memberPengguna", $this->memberPengguna);
        $statement->bindParam(":nomor", $this->nomor);
        $statement->bindParam(":nama", $this->nama);
        $statement->bindParam(":pw", $this->pw);
        $statement->bindParam(":role", $this->role);
        return $statement->execute();
}


        public function update() {
            $query = "UPDATE {$this->table} SET namaPengguna = :namaPengguna, emailPengguna = :emailPengguna,
            memberPengguna = :memberPengguna, nomor = :nomor, nama = :nama, pw = :pw,  WHERE idPengguna = :idPengguna";
            $statement = $this->con->prepare($query);
            $statement->bindParam(":idPengguna", $this->idPengguna);
            $statement->bindParam(":namaPengguna", $this->namaPengguna);
            $statement->bindParam(":emailPengguna", $this->emailPengguna);
            $statement->bindParam(":memberPengguna", $this->memberPengguna);
            $statement->bindParam(":nomor", $this->nomor);
            $statement->bindParam(":nama", $this->nama);
            $statement->bindParam(":pw", $this->pw);
            return $statement->execute();
        }

        public function readAll() {
            $query = "SELECT * FROM {$this->table}";
            $statement = $this->con->prepare($query);
            $statement->execute();
            return $statement;
        }

        public function delete() {
            $query = "DELETE FROM {$this->table} WHERE idPengguna = :idPengguna";
            $statement = $this->con->prepare($query);
            $statement->bindParam(":idPengguna", $this->idPengguna);
            return $statement->execute();
        }

        public function cari($id) {
            $statement = $this->con->prepare("SELECT * FROM {$this->table} WHERE idPengguna =?");
            $statement->execute([$id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public function readById($id) {
        $query = "SELECT * FROM tpengguna WHERE idPengguna = :idPengguna";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':idPengguna', $id);
        $stmt->execute();
        return $stmt;
}

    }
?>
