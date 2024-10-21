<?php
include '../server/db_connect.php';  // Make sure the path is correct

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $query = "SELECT cp.total_waste_collected, mpt.package_name 
              FROM customer_packages cp
              JOIN main_package_types mpt ON cp.package_id = mpt.id
              WHERE cp.user_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($data = $result->fetch_assoc()) {
        echo "<p>Package: " . htmlspecialchars($data['package_name']) . "</p>";
        echo "<div style='text-align: center;'>";
        echo "<img src='assets/images/ds.png' alt='site logo' style='width: 150px; height: auto;'>"; // Adjust the size as needed
        echo "</div>";
        echo "<div class='progress' style='margin-top: 20px; height: 40px;'>";
        echo "<div class='progress-bar' role='progressbar' style='width: " . ($data['total_waste_collected'] / 100) * 100 . "%; background-color: #007bff; height: 40px;' aria-valuenow='" . $data['total_waste_collected'] . "' aria-valuemin='0' aria-valuemax='1000'>" . $data['total_waste_collected'] . " kg</div>";
        echo "</div>";
    } else {
        echo "<p>No waste data found for this user.</p>";
    }
}

$conn->close();
?>
