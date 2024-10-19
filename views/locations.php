<?php
include '../server/db_connect1.php'; 
include '../models/LocationModel.php';
include '../controllers/LocationController.php';

// Create a new LocationModel instance
$model = new LocationModel($conn);

// Create a new LocationController instance
$controller = new LocationController($model);

// Fetch locations from the controller
$locations = $controller->getUncollectedLocations();
$collectedLocations = $controller->getCollectedLocations();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Collection Map</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>

<body>
    <h1>Waste Collection Map</h1>
    <div id="map"></div>

    <div class="location-list">
        <h2>Locations to Collect</h2>
        <?php if (!empty($locations)) { ?>
            <?php foreach ($locations as $location) { ?>
                <div class="location-item">
                    <div>
                        <strong><?php echo $location['first_name'] . ' ' . $location['last_name']; ?></strong><br>
                        Address: <?php echo $location['address']; ?><br>
                        Latitude: <?php echo $location['latitude']; ?>, Longitude: <?php echo $location['longitude']; ?>
                    </div>
                    <div>
                        <button onclick="navigateToLocation('<?php echo $location['latitude']; ?>', '<?php echo $location['longitude']; ?>', '<?php echo $location['pickup_id']; ?>')">Navigate</button>
                        <button onclick="updateCollectionStatus('<?php echo $location['pickup_id']; ?>')">Mark as Collected</button>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No locations pending for collection.</p>
        <?php } ?>
    </div>

    <div class="collected-list">
        <h2>Collected Locations</h2>
        <?php if (!empty($collectedLocations)) { ?>
            <?php foreach ($collectedLocations as $collectedLocation) { ?>
                <div class="location-item">
                    <div>
                        <strong><?php echo $collectedLocation['first_name'] . ' ' . $collectedLocation['last_name']; ?></strong><br>
                        Address: <?php echo $collectedLocation['address']; ?><br>
                        Latitude: <?php echo $collectedLocation['latitude']; ?>, Longitude: <?php echo $collectedLocation['longitude']; ?>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No collected locations available.</p>
        <?php } ?>
    </div>

      <!-- Google Maps script should come after the map div -->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPIwUI69LTcLrwSOX8yWKqbopfZcGHJnk&callback=initMap"></script>
    <script>
        var map, directionsService, directionsRenderer, userLocation, destination, currentPickupId;

        function initMap() {
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({ draggable: false });

            // Initialize the map
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: { lat: 6.9271, lng: 79.8612 } // Default to Colombo, Sri Lanka
            });
            directionsRenderer.setMap(map);

            // Try to get the user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(userLocation);

                    // Add a marker for the user's location
                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "Your Location"
                    });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Function to navigate to a selected location and show directions
        function navigateToLocation(lat, lng, pickupId) {
            if (!userLocation) {
                alert("User location not found. Please enable location services.");
                return;
            }

            destination = { lat: parseFloat(lat), lng: parseFloat(lng) };
            currentPickupId = pickupId; // Store the pickup ID

            var request = {
                origin: userLocation,
                destination: destination,
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function (result, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(result);
                    showTurnByTurnInstructions(result.routes[0].legs[0].steps);
                } else {
                    alert("Directions request failed: " + status);
                }
            });

            trackUserAndUpdateDirections();  // Start tracking the user once navigation begins
        }

        // Function to show turn-by-turn instructions
        function showTurnByTurnInstructions(steps) {
            var directionsPanel = document.getElementById('directions-panel');
            directionsPanel.innerHTML = ''; // Clear previous instructions

            steps.forEach(function (step, index) {
                var instruction = document.createElement('li');
                instruction.innerHTML = step.instructions;
                directionsPanel.appendChild(instruction);
            });
        }

        // Function to continuously update location and directions
        function trackUserAndUpdateDirections() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(function (position) {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var request = {
                        origin: userLocation,
                        destination: destination,
                        travelMode: 'DRIVING'
                    };

                    directionsService.route(request, function (result, status) {
                        if (status == 'OK') {
                            directionsRenderer.setDirections(result);
                        }
                    });

                    // Check if the user has reached the destination
                    var distance = google.maps.geometry.spherical.computeDistanceBetween(
                        new google.maps.LatLng(userLocation.lat, userLocation.lng),
                        new google.maps.LatLng(destination.lat, destination.lng)
                    );

                    if (distance < 50) {  // If within 50 meters
                        // Prompt once the user arrives
                        if (confirm("You have arrived at your destination. Mark this as collected?")) {
                            updateCollectionStatus(currentPickupId);  // Update with correct pickupId
                        }
                    }
                });
            }
        }

        // Function to mark location as collected
        function updateCollectionStatus(pickupId) {
            // Redirect to scan_qr.php with the correct pickupId
            window.location.href = 'scan_qr.php?pickup_id=' + pickupId;
        }
    </script>
</body>

</html>
