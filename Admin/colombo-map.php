<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users Map</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map {
            height: 500px;
            width: 80%;
            margin: auto; /* Center the map */
        }
    </style>
</head>
<body>

<?php 
    $title = 'Map of Registered Users';
    $subTitle = 'Components / Users Map';
?>

<?php include './partials/layouts/layoutTop.php' ?>

<!-- Map container -->
<div id="map"></div>

<?php
    // Include the Singleton Database class
    include '../server/database.php'; // Ensure this path is correct

    // Get the database connection instance
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();

    // Prepare an array to hold user data
    $users = [];

    // Fetch users with non-null latitude and longitude
    $sql = "SELECT name, latitude, longitude, street_address, city FROM users WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
    $result = $conn->query($sql);

    // Check if the query was successful and fetch the data
    if ($result && $result->num_rows > 0) {
        // Store user data in the array
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        // Pass the users data to JavaScript
        echo "<script>var users = " . json_encode($users) . ";</script>";
    } else {
        echo "<script>console.warn('No users found with latitude and longitude');</script>";
    }

    // No need to close the database connection as it's managed by the Singleton class
?>

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
// Initialize the map and set its view to a central location
var map = L.map('map').setView([6.9271, 79.8612], 10); // Adjust this based on your data

// Add OpenStreetMap tile layer
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Debug: Check if users array is passed correctly
console.log('Users array in JavaScript:', users);

// Check if there are users to display
if (users.length > 0) {
    // Loop through the users fetched from the database
    users.forEach(function(user) {
        if (user.latitude && user.longitude) {
            // Ensure latitude and longitude are treated as numbers
            var lat = parseFloat(user.latitude);
            var lng = parseFloat(user.longitude);
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup("<b>" + user.name + "</b><br>Address: " + user.street_address + ", " + user.city);
        } else {
            console.warn('User with invalid location data:', user);
        }
    });
} else {
    alert("No users to display on the map.");
}
</script>

</body>
</html>

<?php include './partials/layouts/layoutBottom.php' ?>
