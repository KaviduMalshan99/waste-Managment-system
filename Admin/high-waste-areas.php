<?php 
$title = 'High Waste Areas Map';
$subTitle = 'Cities with High Waste Levels';
?>

<?php include './partials/layouts/layoutTop.php'; ?>

<!-- Map container -->
<div id="map"></div>

<?php
// Include the database connection from the external file
include '../server/db_connect.php'; // Ensure this path is correct

// Define your threshold value for high waste
$threshold = 50.00; // Example threshold in kg

// Prepare an array to hold high waste data
$highWasteAreas = [];

// Fetch high waste towns or cities, group by the town/city
$sql = "
    SELECT u.city AS town_name, u.latitude, u.longitude, SUM(cp.total_waste_collected) AS total_waste
    FROM users AS u
    JOIN customer_packages AS cp ON u.id = cp.user_id
    WHERE cp.total_waste_collected > ?
    GROUP BY u.city, u.latitude, u.longitude
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("d", $threshold);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful and fetch the data
if ($result && $result->num_rows > 0) {
    // Store high waste area data in the array
    while ($row = $result->fetch_assoc()) {
        $highWasteAreas[] = $row;
    }

    // Pass the high waste data to JavaScript
    echo "<script>var highWasteAreas = " . json_encode($highWasteAreas) . ";</script>";
} else {
    echo "<script>console.warn('No high waste areas found');</script>";
}

// Close the database connection
$conn->close();
?>

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
    #map {
        height: 500px;
        width: 100%;
    }
</style>

<script>
// Initialize the map and set its view to a central location in Western Province
var map = L.map('map').setView([6.9271, 79.8612], 10); // Centered on Western Province

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var wasteIcon = L.icon({
    iconUrl: 'path_to_your_custom_icon', // Replace with your custom icon URL
    iconSize: [38, 38], // Size of the icon
    iconAnchor: [19, 38], // Point of the icon which will correspond to marker's location
    popupAnchor: [0, -38] // Point from which the popup should open relative to the iconAnchor
});

// Check if there are high waste areas to display
if (highWasteAreas.length > 0) {
    // Loop through the high waste areas fetched from the database
    highWasteAreas.forEach(function(area) {
        if (area.latitude && area.longitude) {
            // Ensure latitude and longitude are treated as numbers
            var lat = parseFloat(area.latitude);
            var lng = parseFloat(area.longitude);
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup("<b>City: " + area.town_name + "</b><br>Total Waste: " + area.total_waste + " kg");
        } else {
            console.warn('Area with invalid location data:', area);
        }
    });
} else {
    alert("No high waste areas to display on the map.");
}
</script>

<?php include './partials/layouts/layoutBottom.php'; ?>

</body>
</html>
