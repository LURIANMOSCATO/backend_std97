<?php

class DbConnect {
    private $server = 'node147581-login-adce.jelastic.saveincloud.net';
    private $dbname = 'centro_estetico';
    private $user = 'root';
    private $pass = 'GBAfcr40559';

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
