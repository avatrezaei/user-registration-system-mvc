<?php
namespace App\Models; 

use \PDO;
use \PDOException;

class Database
{
    private $conn;
    private static $instance; 

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    } 

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
    
}
