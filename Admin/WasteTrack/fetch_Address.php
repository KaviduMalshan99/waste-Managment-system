<?php
// Database connection
$host = 'localhost';
$db = 'wasteDB1';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve the data
// $sql = "SELECT name, amount, address, latitude, longitude FROM address_data";
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$locations = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($locations);

$conn->close();

