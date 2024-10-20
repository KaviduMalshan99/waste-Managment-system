<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1f2e;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .loccontainer {
            max-width: 600px;
            margin: 0 auto;
            background-color: #242a3f;
            border-radius: 10px;
            padding: 20px;
        }

        .locheader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 24px;
            cursor: pointer;
        }

        .location-title {
            font-size: 18px;
            font-weight: normal;
        }

        .metrics {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .metric {
            background-color: #2a3040;
            padding: 15px;
            border-radius: 10px;
            flex: 1;
            margin: 0 5px;
            text-align: center;
        }

        .metric h3 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
            color: #9aa0b0;
        }

        .metric p {
            margin: 5px 0 0;
            font-size: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #9aa0b0;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            background-color: #2a3040;
            border: none;
            border-radius: 5px;
            color: #ffffff;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .form-group {
            width: 48%;
        }

        .map-container {
            height: 200px;
            background-color: #3a4050;
            border-radius: 10px;
            margin-top: 15px;
        }

        .submit-btn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="loccontainer">
        <div class="locheader">
            <button class="back-button" onclick="goBack()">&#x2190;</button>
            <h1 class="location-title">Location Details</h1>
        </div>

        <div class="metrics">
            <div class="metric">
                <h3>Name</h3>
                <p id="location-name"></p>
            </div>
            <div class="metric">
                <h3>Average Waste Weight (KG)</h3>
                <p id="waste-weight"></p>
            </div>
        </div>

        <div class="form-group">
            <label for="location-address">Address</label>
            <input type="text" id="location-address" readonly>
        </div>

        <div class="form-group">
            <label for="comment">Feedback</label>
            <textarea id="comment" rows="4"></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" id="latitude" readonly>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" id="longitude" readonly>
            </div>
        </div>

        <!-- Modified Scan QR button with data passed to qrScanner.php -->
        <button class="submit-btn" onclick="goToQrScanner()">Scan QR</button>

        <div class="map-container" id="map"></div>

        <button class="submit-btn" onclick="submitForm()">Collected</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        // Get URL parameters for location details
        const urlParams = new URLSearchParams(window.location.search);
        const locationName = urlParams.get('name');
        const locationAddress = urlParams.get('address');
        const wasteWeight = urlParams.get('waste');
        const latitude = urlParams.get('lat');
        const longitude = urlParams.get('lon');

        // Populate form fields with URL parameter values
        document.getElementById('location-name').textContent = locationName;
        document.getElementById('location-address').value = locationAddress;
        document.getElementById('waste-weight').textContent = wasteWeight;
        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;

        function goToQrScanner() {
            // Get the value of the feedback textarea
            const feedback = document.getElementById('comment').value;

            // Pass all details to qrScanner.php via URL parameters
            window.location.href = `qrScanner.php?name=${encodeURIComponent(locationName)}&address=${encodeURIComponent(locationAddress)}&waste=${encodeURIComponent(wasteWeight)}&lat=${encodeURIComponent(latitude)}&lon=${encodeURIComponent(longitude)}&feedback=${encodeURIComponent(feedback)}`;
        }

        function submitForm() {
            const feedback = document.getElementById('comment').value;
            
            const formData = new FormData();
            formData.append('location_name', locationName);
            formData.append('location_address', locationAddress);
            formData.append('waste_weight', wasteWeight);
            formData.append('latitude', latitude);
            formData.append('longitude', longitude);
            formData.append('feedback', feedback);

            fetch('location_feedback.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert('Data submitted successfully!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>