// views/scanQrView.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan the Waste Bin</title>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('bg_waste.jpg');
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
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        #reader {
            width: 500px;
            height: 400px;
            border-radius: 15px;
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
    <a href="collector_map.php" class="back-button">← Back to Map</a>
    <div class="content">
        <h1>Scan the Waste Bin</h1>
        <div id="reader"></div>
        <form id="submitForm" method="POST" action="scan_qr.php">
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <input type="hidden" id="weight" name="weight">
            <input type="hidden" id="pickup_id" name="pickup_id">
        </form>
    </div>
    <audio id="successAudio" src="success-chime.mp3" preload="auto"></audio>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            try {
                let data = JSON.parse(decodedText);
                if (data.pickup_id === '<?php echo $pickupId; ?>') {
                    document.getElementById('latitude').value = data.latitude;
                    document.getElementById('longitude').value = data.longitude;
                    document.getElementById('weight').value = data.weight;
                    document.getElementById('pickup_id').value = data.pickup_id;
                    setTimeout(function() {
                        document.getElementById('submitForm').submit();
                    }, 1000);
                }
            } catch (error) {
                alert("Failed to process the QR Code data. Please try again.");
            }
        }
        function onScanFailure(error) {
            console.warn(`QR scan failed: ${error}`);
        }
        let html5QrCode = new Html5Qrcode("reader");
        setInterval(function () {
            html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 }, onScanSuccess, onScanFailure);
        }, 2000);
    </script>
</body>
</html>
