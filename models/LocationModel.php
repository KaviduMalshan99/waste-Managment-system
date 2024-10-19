<?php
class LocationModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all locations that are not marked as collected
    public function getUncollectedLocations() {
        $sql = "SELECT * FROM waste_pickups WHERE collected = 0";
        $result = $this->conn->query($sql);
        $locations = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $locations[] = $row;
            }
        }
        return $locations;
    }

    // Fetch all collected locations
    public function getCollectedLocations() {
        $sql = "SELECT * FROM waste_pickups WHERE collected = 1";
        $result = $this->conn->query($sql);
        $collectedLocations = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $collectedLocations[] = $row;
            }
        }
        return $collectedLocations;
    }
}
?>
