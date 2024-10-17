<?php
// Include the DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "waste_management";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pickupId = $_GET['pickup_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $weight = $_POST['weight'];

    // Update the waste_pickups table with the collected weight and mark as collected
    $sql = "UPDATE waste_pickups SET weight = ?, collected = 1 WHERE pickup_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $weight, $pickupId);
    $stmt->execute();
    $stmt->close();

    // Success message, audio and delayed redirection
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Play the success audio
            var successAudio = document.getElementById('successAudio');
            successAudio.play();
            
            // Show success message
            alert('Waste collection recorded successfully!');

            // Wait for 4 seconds before redirecting to collector_map.php
            setTimeout(function() {
                window.location.href = 'collector_map.php';
            }, 2000);
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scan</title>
</head>
<body>
    <h1>Scan QR Code</h1>
    <form method="POST" action="">
        <label for="weight">Enter Waste Weight (kg):</label>
        <input type="text" id="weight" name="weight" required>
        <button type="submit">Submit</button>
    </form>

    <!-- Audio for success chime -->
    <audio id="successAudio" src="success-chime.mp3" preload="auto"></audio>
</body>
</html>
