<?php
class Database {
    private static $instance = null;
    private $conn;

    // Database credentials
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "wasteproject";

    // Private constructor to prevent direct instantiation
    private function __construct() {
        // Create a new database connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check for a connection error
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // The static method to get the single instance of the database connection
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the connection
    public function getConnection() {
        return $this->conn;
    }

    // Prevent cloning
    private function __clone() {}

    // Change __wakeup method to public to fix the warning
    public function __wakeup() {}
}
?>
