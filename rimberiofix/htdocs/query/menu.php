
<?php
    class menu {
        private $con;
        private $table = "tmenu";
        public $kodeMenu, $namaMenu, $hargaMenu, $gambarMenu;

        public function __construct($db) {
            $this->con = $db;
        }

        public function create() {
            $query = "INSERT INTO {$this->table} (namaMenu, hargaMenu, gambarMenu) VALUES 
            (:namaMenu, :hargaMenu, :gambarMenu)";
            $statement = $this->con->prepare($query);
            $statement->bindParam(":namaMenu", $this->namaMenu);
            $statement->bindParam(":hargaMenu", $this->hargaMenu);
            $statement->bindParam(":gambarMenu", $this->gambarMenu);
            return $statement->execute();
        }

        public function update() {
            $query = "UPDATE {$this->table} SET namaMenu = :namaMenu, hargaMenu = :hargaMenu, gambarMenu = :gambarMenu WHERE kodeMenu = :kodeMenu";
            $statement = $this->con->prepare($query);
            $statement->bindParam(":kodeMenu", $this->kodeMenu);
            $statement->bindParam(":namaMenu", $this->namaMenu);
            $statement->bindParam(":hargaMenu", $this->hargaMenu);
            $statement->bindParam(":gambarMenu", $this->gambarMenu);
            return $statement->execute();
        }

       public function readAll() {
         $query = "SELECT * FROM tmenu";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt; 
        }


        public function delete() {
            $query = "DELETE FROM {$this->table} WHERE kodeMenu = :kodeMenu";
            $statement = $this->con->prepare($query);
            $statement->bindParam(":kodeMenu", $this->kodeMenu);
            return $statement->execute();
        }

        public function cari($id) {
            $statement = $this->con->prepare("SELECT * FROM {$this->table} WHERE kodeMenu =?");
            $statement->execute([$id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
?>