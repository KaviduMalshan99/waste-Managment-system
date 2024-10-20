<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1f2e;
            color: #ffffff;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Header styles */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Location details styles */
        .location-details {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .location-details h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #3498db;
            text-align: center;
        }

        .location-details p {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .location-details strong {
            color: #3498db;
            font-weight: bold;
            margin-right: 5px;
        }

        /* Feedback input styles */
        .feedback-input {
            margin-top: 15px;
            width: 100%;
            max-width: 500px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #3498db;
            background-color: #ffffff;
            color: #333;
        }

        /* QR reader container */
        #qr-reader {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        #qr-reader::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 3px solid #3498db;
            border-radius: 10px;
            z-index: 1;
        }

        #qr-reader::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border: 2px solid #3498db;
            border-radius: 20px;
            box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.5);
        }

        #qr-reader video {
            width: 100% !important;
            height: auto !important;
            border-radius: 10px;
        }

        #qr-reader-results {
            margin-top: 20px;
            font-size: 1.1rem;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 5px;
        }

        /* Back button styles */
        .back-button {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            transform: translateX(-5px);
        }

        /* Enhanced Popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ffffff;
            color: #333;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: none; /* Hidden by default */
            max-width: 90%;
            width: 400px;
        }

        .popup h2 {
            margin-bottom: 20px;
            color: #1a1f2e;
            font-size: 1.8rem;
            text-align: center;
        }

        .popup p {
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .popup button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        .popup button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        /* Submit button styles */
        .submit-button {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.1rem;
            margin-top: 15px;
            width: 100%;
            max-width: 500px;
        }

        .submit-button:hover {
            background-color: #2980b9;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            .location-details,
            #qr-reader {
                width: 95%;
            }

            .back-button {
                top: 10px;
                left: 10px;
            }

            .popup {
                width: 95%;
                padding: 20px;
            }

            #qr-reader::after {
                width: 150px;
                height: 150px;
            }
        }
    </style>

    <!-- Include the QR code scanner library -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>

<body>

    <button class="back-button" onclick="window.history.back()">&#x2190; Back</button>

    <h1>QR Code Scanner</h1>

    <!-- Display passed location details -->
    <div class="location-details">
        <h2>Location Details</h2>
        <p><strong>Location Name:</strong> <span id="location-name"></span></p>
        <p><strong>Address:</strong> <span id="location-address"></span></p>
        <p><strong>Waste Weight (KG):</strong> <span id="waste-weight"></span></p>
        <p><strong>Latitude:</strong> <span id="latitude"></span></p>
        <p><strong>Longitude:</strong> <span id="longitude"></span></p>
        <p><strong>Feedback:</strong> <span id="feedback"></span></p>
        <textarea class="feedback-input" id="feedback-input" placeholder="Enter your feedback here..."></textarea>
        <button class="submit-button" id="submit-btn">Submit Data</button>
    </div>

    <!-- QR Code Reader -->
    <div id="qr-reader"></div>
    <div id="qr-reader-results"></div>

    <!-- Popup for displaying results -->
    <div class="popup" id="resultPopup">
        <h2>Scanned Details</h2>
        <div id="popupContent"></div>
        <button onclick="closePopup()">Next</button>
    </div>

    <script>
        // Get the location details passed via URL
        const urlParams = new URLSearchParams(window.location.search);
        const locationName = urlParams.get('name');
        const locationAddress = urlParams.get('address');
        const wasteWeight = urlParams.get('waste');
        const latitude = urlParams.get('lat');
        const longitude = urlParams.get('lon');
        const feedback = urlParams.get('feedback');

        // Populate the details in the HTML
        document.getElementById('location-name').textContent = locationName;
        document.getElementById('location-address').textContent = locationAddress;
        document.getElementById('waste-weight').textContent = wasteWeight;
        document.getElementById('latitude').textContent = latitude;
        document.getElementById('longitude').textContent = longitude;
        document.getElementById('feedback').textContent = feedback;

        // Initialize the QR code scanner
        let html5QrcodeScanner;

        function onScanSuccess(decodedText, decodedResult) {
            const dataParts = decodedText.split('|');
            const weight = dataParts[2] || 'N/A';

            // Update only the waste weight in the details
            document.getElementById('waste-weight').textContent = weight;

            // Show scanned data in the popup
            document.getElementById('popupContent').innerHTML = `
                <p><strong>Waste Weight:</strong> ${weight}</p>
                <p><strong>Feedback:</strong> ${document.getElementById('feedback-input').value}</p>
            `;
            document.getElementById('resultPopup').style.display = 'block';
            stopScanner();
        }

        function startScanner() {
            html5QrcodeScanner.start(
                { facingMode: "environment" },
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 }
                },
                onScanSuccess
            ).catch(err => {
                console.error(err);
            });
            document.getElementById('qr-reader').style.display = 'block';
        }

        function stopScanner() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.stop().then(() => {
                    console.log('QR Code scanning stopped.');
                    document.getElementById('qr-reader').style.display = 'none';
                }).catch((err) => {
                    console.error('Failed to stop QR Code scanning.', err);
                });
            }
        }

        function closePopup() {
            document.getElementById('resultPopup').style.display = 'none';
            // Restart the scanner after closing the popup
            startScanner();
        }

        window.onload = function () {
            html5QrcodeScanner = new Html5Qrcode("qr-reader");
            startScanner();

            // Add event listener for close button
            document.getElementById('close-scanner').addEventListener('click', stopScanner);
        };

        document.getElementById('submit-btn').addEventListener('click', function () {
            const wasteWeight = document.getElementById('waste-weight').textContent;
            const feedbackInput = document.getElementById('feedback-input').value;

            const data = {
                location_name: locationName,
                location_address: locationAddress,
                waste_weight: wasteWeight,
                latitude: latitude,
                longitude: longitude,
                feedback: feedbackInput
            };

            fetch('waste_feedback.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                alert('Data submitted successfully: ' + data.message);
                // Optionally, reset the input fields after submission
                document.getElementById('feedback-input').value = '';
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Error submitting data.');
            });
        });
    </script>
</body>
</html>