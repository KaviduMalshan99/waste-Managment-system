<?php
// Database connection parameters
$host = 'localhost';
$db = 'wasteDB1'; // Change this to your database name
$user = 'root'; // Change this to your database username
$pass = ''; // Change this to your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Check if all required fields are present
if (!isset($data['location_name'], $data['location_address'], $data['waste_weight'], $data['latitude'], $data['longitude'], $data['feedback'])) {
    echo json_encode(['message' => 'All fields are required.']);
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO qr_code_data (location_name, location_address, waste_weight, latitude, longitude, feedback) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $data['location_name'], $data['location_address'], $data['waste_weight'], $data['latitude'], $data['longitude'], $data['feedback']);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['message' => 'Data stored successfully']);
} else {
    echo json_encode(['message' => 'Error storing data: ' . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
