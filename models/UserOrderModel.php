<?php

class UserOrderModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getOrdersByEmail($email) {
        $sql = "SELECT pickup_id, first_name, last_name, address, pickup_date, pickup_time, collected, weight, waste_type, paid 
                FROM waste_pickups 
                WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function updatePaymentStatus($pickupId) {
        $sql = "UPDATE waste_pickups SET paid = 1 WHERE pickup_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $pickupId);
        return $stmt->execute();
    }

    public function reschedulePickup($pickupId, $newDate, $newTime) {
        $sql = "UPDATE waste_pickups SET pickup_date = ?, pickup_time = ? WHERE pickup_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $newDate, $newTime, $pickupId);
        return $stmt->execute();
    }
}
?>
