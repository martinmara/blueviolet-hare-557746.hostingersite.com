<?php
namespace App\Database;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'u920174079_product_db';
    private $username = 'u920174079_scandiweb';
    private $password = 'Martinnew2024pas?';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function prepareQuery($query) {
        return $this->getConnection()->prepare($query);
    }
}