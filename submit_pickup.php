<?php
// Include the Singleton Database class
include './server/db_connect1.php';

// Get the database instance and connection
$db = Database::getInstance();
$conn = $db->getConnection();

// Function to generate a unique ID
function generateUniqueId() {
    return uniqid('pickup_', true);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Common fields
    $firstName = $_POST['first_name_bagster'] ?? $_POST['first_name_containers'] ?? $_POST['first_name_dumpster'];
    $lastName = $_POST['last_name_bagster'] ?? $_POST['last_name_containers'] ?? $_POST['last_name_dumpster'];
    $companyName = $_POST['company_name_bagster'] ?? $_POST['company_name_containers'] ?? $_POST['company_name_dumpster'];
    $address = $_POST['address_bagster'] ?? $_POST['address_containers'] ?? $_POST['address_dumpster'];
    $postCode = $_POST['post_code_bagster'] ?? $_POST['post_code_containers'] ?? $_POST['post_code_dumpster'];
    $description = $_POST['description_bagster'] ?? $_POST['description_containers'] ?? $_POST['description_dumpster'];
    $email = $_POST['email_bagster'] ?? $_POST['email_containers'] ?? $_POST['email_dumpster'];
    $subject = $_POST['subject_bagster'] ?? $_POST['subject_containers'] ?? $_POST['subject_dumpster'];
    $date = $_POST['date_bagster'] ?? $_POST['date_containers'] ?? $_POST['date_dumpster'];
    $time = $_POST['time_bagster'] ?? $_POST['time_containers'] ?? $_POST['time_dumpster'];
    $latitude = $_POST['latitude_bagster'] ?? $_POST['latitude_containers'] ?? $_POST['latitude_dumpster'];
    $longitude = $_POST['longitude_bagster'] ?? $_POST['longitude_containers'] ?? $_POST['longitude_dumpster'];

    // Waste type, depending on the form
    $wasteType = $_POST['waste_type_bagster'] ?? $_POST['waste_type_containers'] ?? $_POST['waste_type_dumpster'];

    // Check if there is already a pickup scheduled for the same date and time
    $check_sql = "SELECT * FROM waste_pickups WHERE pickup_date = ? AND pickup_time = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $date, $time);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Record already exists for the same date and time, show error message
        echo "
        <html>
        <head>
            <script type='text/javascript'>
                alert('A pickup is already scheduled for this date and time. Please choose a different time slot.');
                window.history.back(); // Go back to the form
            </script>
        </head>
        <body>
            <h2>A pickup is already scheduled for this date and time. Please choose a different time slot.</h2>
        </body>
        </html>
        ";
    } else {
        // No conflict, proceed with saving the data

        // Generate a unique pickup ID
        $pickupId = generateUniqueId();

        // SQL query to insert data into the table
        $sql = "INSERT INTO waste_pickups (pickup_id, first_name, last_name, company_name, address, post_code, description, email, subject, pickup_date, pickup_time, latitude, longitude, waste_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind the query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssss", $pickupId, $firstName, $lastName, $companyName, $address, $postCode, $description, $email, $subject, $date, $time, $latitude, $longitude, $wasteType);

        // Execute the query
        if ($stmt->execute()) {
            // Show success message and wait for the user to click OK before redirecting
            echo "
            <html>
            <head>
                <script type='text/javascript'>
                    alert('Your order has been placed successfully!');
                    window.location.href = 'index.php'; // Redirect to home page after clicking OK
                </script>
            </head>
            <body>
                <h2>Your order has been placed successfully! You will be redirected to the home page shortly after clicking OK.</h2>
            </body>
            </html>
            ";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement and connection
        $stmt->close();
    }

    // Close the check statement
    $check_stmt->close();
    $conn->close();
}
?>
