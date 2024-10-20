<?php
session_start();  // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: userlogin.php');
    exit();
}

include 'db_connect.php'; // Ensure the database connection path is correct

// Set error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize userData
$userData = [];

// Check if the form is submitted to update the profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $state_province = $_POST['state_province'];
    $country = $_POST['country'];

    // Prepare SQL statement for updating user data
    $sql = "UPDATE users SET name = ?, email = ?, contact = ?, street_address = ?, city = ?, postal_code = ?, state_province = ?, country = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ssssssssi", $name, $email, $contact, $street_address, $city, $postal_code, $state_province, $country, $user_id);
    $stmt->execute();
    
    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('No changes were made.');</script>";
    }

    $stmt->close();
}

// Query to get user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, contact, street_address, city, postal_code, state_province, country FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "No user data found.";
}

$stmt->close();
$conn->close();

// Get the first letter of the name if userData is available
$firstLetter = isset($userData['name']) ? strtoupper($userData['name'][0]) : '';  // Convert the first letter to uppercase
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        } */

        .profile-container {
            background: #e0e0d1;
            width: 50%;
            margin: 0 auto;
            padding: 50px;
            margin-top: 50px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-placeholder {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            margin-left:290px;
            font-size: 140px;
            color: #404A3D;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            padding: 40px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-size: 18px;
        }

        input[type="text"],
        input[type="email"] {
            padding: 10px;
            border: 1px solid #000000;
            border-radius: 15px;
            font-size: 16px;
        }

        .btn-save, .btn-update {
            background: #404A3D;
            color: #fff;
            border: none;
            padding: 15px 25px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 20px;
            grid-column: span 2;
            font-size: 18px;
        }
    </style>
    
    <script>
        function enableEdit() {
            const inputs = document.querySelectorAll('.profile-form input');
            inputs.forEach(input => {
                input.disabled = false;
            });
            document.querySelector('.btn-save').style.display = 'block'; // Show the save button
        }
    </script>
</head>
<body>
    <?php include 'sidebarUser.php'; ?> <!-- Including the sidebar here -->

    <div class="profile-container">
        <h1>MY PROFILE</h1>
        <div class="profile-picture">
            <div class="image-placeholder">
                <?php echo $firstLetter; ?> <!-- Display the first letter of the name -->
            </div>
        </div>
        <form action="" method="POST" class="profile-form">
            <div class="form-group">
                <label for="name">Full Name :</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($userData['contact'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="street_address">Street Address:</label>
                <input type="text" id="street_address" name="street_address" value="<?php echo htmlspecialchars($userData['street_address'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($userData['city'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal code:</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($userData['postal_code'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="state_province">State/Province:</label>
                <input type="text" id="state_province" name="state_province" value="<?php echo htmlspecialchars($userData['state_province'] ?? ''); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($userData['country'] ?? ''); ?>" disabled>
            </div>
            <button type="button" class="btn-update" onclick="enableEdit()">Update</button>
            <button type="submit" class="btn-save" style="display:none;">Save</button>
            <a href="wastePlan.php?user_id=<?php echo $user_id; ?>" class="btn-pac">Add Packages</a>
        </form>
    </div>
</body>
</html>
