<?php
// Include the database connection configuration file
include 'db_connect.php'; // Ensure this path is correct

function getGeocodeFromOpenCage($address) {
    $apiKey = '890b4af89de84ca5b49ed56c8a7f1132'; // Replace with your actual OpenCage API key
    $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key=" . $apiKey . "&limit=1";

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'YourAppName/1.0 (contact@yourdomain.com)');

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "<script>showToast('cURL error: " . curl_error($ch) . "');</script>";
        curl_close($ch);
        return false;
    }
    curl_close($ch);

    $json = json_decode($response, true);

    if (!empty($json) && $json['total_results'] > 0) {
        $latitude = $json['results'][0]['geometry']['lat'];
        $longitude = $json['results'][0]['geometry']['lng'];
        return array('latitude' => $latitude, 'longitude' => $longitude);
    } else {
        echo "<script>showToast('Geocoding failed: No results found.');</script>";
        return false;
    }
}

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Process the form only if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $password = $conn->real_escape_string(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $street_address = $conn->real_escape_string($_POST['street_address']);
    $city = $conn->real_escape_string($_POST['city']);
    $postal_code = $conn->real_escape_string($_POST['postal_code']);
    $state_province = $conn->real_escape_string($_POST['state_province']);
    $country = $conn->real_escape_string($_POST['country']);

    // Combine address components into a single string
    $fullAddress = "$street_address, $city, $postal_code, $state_province, $country";
    $coordinates = getGeocodeFromOpenCage($fullAddress);

    if ($coordinates) {
        $latitude = $coordinates['latitude'];
        $longitude = $coordinates['longitude'];

        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (name, email, contact, password, street_address, city, postal_code, state_province, country, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssdds", $name, $email, $contact, $password, $street_address, $city, $postal_code, $state_province, $country, $latitude, $longitude);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>setTimeout(function() { window.location.href = 'userlogin.php'; }, 3000);</script>";
            echo "<script>alert('Registration successful! Redirecting to login...');</script>";
        } else {
            echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Geocoding failed: Unable to register.');</script>";
    }
    $conn->close();
}
?>
