<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Waste Management</title>
    <style>
        /* Basic styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .m-sidebar {
            background-color: #1C2336;
            width: 250px;
            padding: 20px;
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .m-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .m-logo img {
            width: 60px;
            height: auto;
        }

        .m-menu-section {
            margin-bottom: 25px;
        }

        .m-menu-section h4 {
            margin-bottom: 15px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6B7280;
        }

        .m-menu-item {
            margin-left: 10px;
            cursor: pointer;
            padding: 10px;
            transition: all 0.3s ease;
            border-radius: 5px;
            font-size: 14px;
        }

        .m-menu-item:hover {
            background-color: #2B384F;
            color: #FFFFFF;
        }

        .m-main-content {
            flex-grow: 1;
            background-color: #F0F0F0;
            display: flex;
            flex-direction: column;
        }

        .m-header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #1C2336;
            color: white;
            align-items: center;
        }

        .m-header button {
            background-color: #2B384F;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .m-header button:hover {
            background-color: #394866;
        }

        .m-map-container {
            position: relative;
            flex-grow: 1;
            padding: 20px;
        }

        .m-map {
            width: 100%;
            height: 100%;
            background-color: #E0E0E0;
        }

        .m-floating-card {
            display: none;
            position: absolute;
            top: 20%;
            right: 5%;
            background-color: #1C2336;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            z-index: 1000;
        }

        .m-floating-card h4 {
            margin-top: 0;
        }

        .m-floating-card p {
            margin: 5px 0;
        }

        .m-card-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .m-card-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .m-card-buttons button:hover {
            background-color: #45a049;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

</head>

<body>
    <!-- Main Content -->
    <div class="m-main-content">
        <!-- Header -->
        <div class="m-header">
            <div>
                <button>Map</button>
                <a href="binusers.php"><button>Table</button></a>
            </div>
            <div>
                <input id="search-input" type="text" placeholder="Search..."
                    style="padding: 10px; border-radius: 5px; border: none;">
                <button id="search-button">Search</button>
                <button>Filter</button>
                <button>Create</button>
            </div>
        </div>

        <!-- Map and Floating Card -->
        <div class="m-map-container">
            <div id="map" class="m-map">
                <!-- Leaflet Map will be rendered here -->
            </div>

            <div id="floating-card" class="m-floating-card">
                <button id="close-card-btn"
                    style="position: absolute; top: 10px; right: 10px; background-color: transparent; color: white; border: none; font-size: 18px; cursor: pointer;">&times;</button>
                <!-- Close Button -->
                <h4 id="location-name"></h4>
                <p id="location-slug"></p>
                <p id="location-rating"></p>
                <p id="location-waste"></p>
                <p id="location-address"></p>
                <!-- Add hidden latitude and longitude for use in directions -->
                <p id="location-lat" style="display:none;"></p>
                <p id="location-lon" style="display:none;"></p>
                <div class="m-card-buttons">
                    <button onclick="openLocation()">Open</button>
                    <button onclick="duplicateLocation()">Direction</button>
                </div>
            </div>


        </div>
    </div>

    <script>
        // Step 1: Declare `map` globally so it can be accessed by all functions
        var map;
        let routingControl = null;

        document.addEventListener("DOMContentLoaded", function () {
            // Step 2: Initialize the map without re-declaring it inside the event listener
            // Step 2: Initialize the map with Colombo's coordinates
            map = L.map('map').setView([6.9271, 79.8612], 13); // Colombo's coordinates

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Fetch location data from the server and place markers
            fetch('fetch_Address.php')
                .then(response => response.json())
                .then(locations => {
                    locations.forEach(location => {
                        var marker = L.marker([location.latitude, location.longitude]).addTo(map);
                        marker.bindPopup(`<b>${location.name}</b>`);

                        marker.on('click', function () {
                            showFloatingCard(location);
                        });
                    });
                })
                .catch(err => console.error('Error fetching locations:', err));

            // Search functionality
            document.getElementById('search-button').addEventListener('click', function () {
                var searchInput = document.getElementById('search-input').value;

                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${searchInput}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lon = data[0].lon;
                            map.setView([lat, lon], 14);
                            var searchMarker = L.marker([lat, lon]).addTo(map);
                            searchMarker.bindPopup(`<b>${data[0].display_name}</b>`).openPopup();
                        } else {
                            alert('Location not found. Please try a different query.');
                        }
                    })
                    .catch(err => console.error('Error fetching search results:', err));
            });
        });

        // Close card functionality
        document.getElementById('close-card-btn').addEventListener('click', function () {
            document.getElementById('floating-card').style.display = 'none';
        });

        function showFloatingCard(location) {
            document.getElementById('location-name').textContent = `Name: ${location.name}`;
            document.getElementById('location-waste').textContent = `Average waste weight: ${location.amount || 'N/A'} KG`;
            document.getElementById('location-address').textContent = `Address: ${location.street_address}`;
            document.getElementById('location-lat').textContent = location.latitude; // Set lat value
            document.getElementById('location-lon').textContent = location.longitude; // Set lon value
            document.getElementById('floating-card').style.display = 'block';
        }

        function openLocation() {
            const name = document.getElementById('location-name').textContent.replace('Name: ', '');
            const address = document.getElementById('location-address').textContent.replace('Address: ', '');
            const waste = document.getElementById('location-waste').textContent.replace('Average waste weight: ', '');
            const lat = document.getElementById('location-lat').textContent;
            const lon = document.getElementById('location-lon').textContent;

            // Redirect to locationDetails.php with query parameters
            window.location.href = `locationDetails.php?name=${encodeURIComponent(name)}&address=${encodeURIComponent(address)}&waste=${encodeURIComponent(waste)}&lat=${encodeURIComponent(lat)}&lon=${encodeURIComponent(lon)}`;
        }





        function duplicateLocation() {
            const locationLat = parseFloat(document.getElementById('location-lat').textContent);
            const locationLon = parseFloat(document.getElementById('location-lon').textContent);

            if (isNaN(locationLat) || isNaN(locationLon)) {
                alert('Invalid location data. Please try again.');
                return;
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const userLat = position.coords.latitude;
                    const userLon = position.coords.longitude;

                    // Step 3: Ensure map is accessible globally
                    if (!map || typeof map.getSize !== 'function') {
                        alert('Map not initialized properly.');
                        return;
                    }

                    // Remove existing routing control if it exists
                    if (routingControl) {
                        map.removeControl(routingControl);  // Ensure previous route is cleared
                    }

                    // Initialize routing control with route style customization
                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userLat, userLon),  // User's current location
                            L.latLng(locationLat, locationLon)  // Destination
                        ],
                        routeWhileDragging: true,  // Interactive routing
                        show: true,
                        autoRoute: true,  // Auto-route when waypoints change
                        createLine: function (alt) {
                            // Customize route color and other styles
                            return L.Routing.line(alt, {
                                styles: [
                                    { color: 'green', opacity: 0.7, weight: 15 } // Custom route color and style
                                ]
                            });
                        }
                    }).addTo(map);  // Add routing control to the map
                }, function (error) {
                    alert('Unable to retrieve your location.');
                    console.error('Geolocation error:', error);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

    </script>

</body>

</html>