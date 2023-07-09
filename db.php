<?php

class DbConnect {
    private $server = 'https://node143512-barber97.jelastic.saveincloud.net';
    private $dbname = 'barber';
    private $user = 'root';
    private $pass = 'TOFdrg19957';

    public function connect() {
        try {
            $conn = new PDO('mysql:host=' .$this->server .';dbname=' .$this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(\Exception $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }
}

?>
