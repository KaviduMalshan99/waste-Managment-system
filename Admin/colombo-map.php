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
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>

<h2>Map of Registered Users</h2>
<!-- Map container -->
<div id="map"></div>

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
// Sample users with addresses (latitude, longitude, name)
var users = [
    {name: "User 1", lat: 6.9271, lon: 79.8612, address: "Colombo"},
    {name: "User 2", lat: 6.9345, lon: 79.8428, address: "Colombo 02"},
    {name: "User 3", lat: 6.9681, lon: 79.8745, address: "Colombo 05"},
    {name: "User 4", lat: 6.8500, lon: 79.8800, address: "Moratuwa"},
    {name: "User 5", lat: 6.8214, lon: 80.0409, address: "Panadura"},
    {name: "User 6", lat: 7.0874, lon: 79.8894, address: "Negombo"},
    {name: "User 7", lat: 6.8650, lon: 79.8994, address: "Mount Lavinia"},
    {name: "User 8", lat: 6.7852, lon: 79.8946, address: "Kalutara"},
    {name: "User 9", lat: 6.9571, lon: 79.8820, address: "Rajagiriya"},
    {name: "User 10", lat: 6.9779, lon: 79.8728, address: "Borella"}
];

// Initialize the map and set its view to Western Province
var map = L.map('map').setView([6.9271, 79.8612], 10);

// Add OpenStreetMap tile layer
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Loop through the users and add markers with popups
users.forEach(function(user) {
    var marker = L.marker([user.lat, user.lon]).addTo(map);
    marker.bindPopup("<b>" + user.name + "</b><br>Address: " + user.address).openPopup();
});

</script>

</body>
</html>
