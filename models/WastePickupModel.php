// models/WastePickupModel.php
<?php
class WastePickupModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Check if latitude, longitude, and pickup ID match
    public function verifyPickup($latitude, $longitude, $pickupId) {
        $sql = "SELECT * FROM waste_pickups WHERE latitude = ? AND longitude = ? AND pickup_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("dds", $latitude, $longitude, $pickupId);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Update the weight and mark the pickup as collected
    public function updatePickup($weight, $pickupId) {
        $sql = "UPDATE waste_pickups SET weight = ?, collected = 1 WHERE pickup_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ds", $weight, $pickupId);
        $stmt->execute();
        $stmt->close();
    }
}
