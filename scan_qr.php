<?php
// Include the Singleton Database class
include './server/db_connect1.php';

// Get the database instance and connection
$db = Database::getInstance();
$conn = $db->getConnection();
$pickupId = $_GET['pickup_id']; // Get pickup ID from the URL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $weight = $_POST['weight'];
    $pickupId = $_POST['pickup_id'];  // Get the pickup_id from the form

    // Check if the latitude, longitude, and pickup ID match in the database
    $sql = "SELECT * FROM waste_pickups WHERE latitude = ? AND longitude = ? AND pickup_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dds", $latitude, $longitude, $pickupId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If coordinates and pickup_id match, update the weight and mark as collected
        $sql = "UPDATE waste_pickups SET weight = ?, collected = 1 WHERE pickup_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ds", $weight, $pickupId);
        $stmt->execute();
        $stmt->close();

        // Success message and audio alert
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var successAudio = document.getElementById('successAudio');
                
                successAudio.oncanplaythrough = function() {
                    successAudio.play();
                    // Show success message with 'OK' button
                    setTimeout(function() {
                        if (confirm('Waste bin updated successfully! Click OK to return to the map.')) {
                            window.location.href = 'collector_map.php';
                        }
                    }, 500); // Slight delay for sound
                };
            });
        </script>";
    } else {
        // Coordinates or pickup_id do not match
        echo "
        <script>
            alert('Error: Location coordinates or Pickup ID do not match. Please try again.');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan the Waste Bin</title>

    <!-- Include the html5-qrcode library -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    
    <!-- Add some CSS for the page styling -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('bg_waste.jpg'); /* Add your own background image URL */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 60px;
            color: black;

        }

        /* Back button styling */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        /* QR Reader styling */
        #reader {
            width: 500px;
            height: 400px;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .content {
            text-align: center;
        }

        audio {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Back button -->
    <a href="collector_map.php" class="back-button">← Back to Map</a>

    <div class="content">
        <h1>Scan the Waste Bin</h1>

        <!-- Camera Feed to Scan the QR Code -->
        <div id="reader"></div>

        <!-- Hidden Form to Submit the Scanned Data -->
        <form id="submitForm" method="POST" action="scan_qr.php">
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <input type="hidden" id="weight" name="weight">
            <input type="hidden" id="pickup_id" name="pickup_id">
        </form>
    </div>

    <!-- Audio for success chime -->
    <audio id="successAudio" src="success-chime.mp3" preload="auto"></audio>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            try {
                // Parse the scanned QR code data (JSON format)
                let data = JSON.parse(decodedText);

                if (data.pickup_id === '<?php echo $pickupId; ?>') {
                    // Fill the hidden form with the scanned QR data
                    document.getElementById('latitude').value = data.latitude;
                    document.getElementById('longitude').value = data.longitude;
                    document.getElementById('weight').value = data.weight;
                    document.getElementById('pickup_id').value = data.pickup_id;

                    // Automatically submit the form after scanning
                    setTimeout(function() {
                        document.getElementById('submitForm').submit();
                    }, 1000);
                } else {
                    // If the scanned QR doesn't match the pickup ID, continue scanning
                    console.log("QR Code does not match the pickup ID.");
                }
            } catch (error) {
                alert("Failed to process the QR Code data. Please try again.");
            }
        }

        function onScanFailure(error) {
            console.warn(`QR scan failed: ${error}`);
        }

        // Start scanning for QR codes with the camera
        let html5QrCode = new Html5Qrcode("reader");

        function startQrCodeScanner() {
            html5QrCode.start(
                { facingMode: "environment" },  // Camera mode
                {
                    fps: 10,  // Frames per second for scanning
                    qrbox: 250  // QR scanning box size
                },
                onScanSuccess,
                onScanFailure
            );
        }

        // Loop the scanning process every 2 seconds until the correct QR is scanned
        setInterval(function () {
            startQrCodeScanner();
        }, 2000); // 2-second delay between scanning attempts
    </script>
</body>
</html>
