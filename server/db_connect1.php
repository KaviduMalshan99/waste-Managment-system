<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "waste_management";
    private static $instance = null;
    private $conn;

    // Private constructor to prevent direct object creation
    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to get the single instance of the class
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the database connection
    public function getConnection() {
        return $this->conn;
    }
}
?>
