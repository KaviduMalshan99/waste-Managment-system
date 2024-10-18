<?php
session_start();  // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: userlogin.php');
    exit();
}

include 'db_connect.php'; // Ensure the database connection path is correct

// Query to get user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, contact, street_address, city, postal_code, state_province, country FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

$stmt->close();
$conn->close();

// Get first letter of the name
$firstLetter = strtoupper($userData['name'][0]);  // Convert first letter to uppercase
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="userprofile.scss"> <!-- Ensure you link to the compiled CSS from SCSS -->
</head>
<body>
    <div class="profile-container">
        <h1>MY PROFILE</h1>
        <div class="profile-picture">
            <div class="image-placeholder">
                <?php echo $firstLetter; ?> <!-- Display the first letter of the name -->
            </div>
            <button class="btn-update">Update</button>
        </div>
        <form action="#" method="POST" class="profile-form">
            <div class="form-group">
                <label for="name">Full Name :</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>">
            </div>
            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($userData['contact']); ?>">
            </div>
            <div class="form-group">
                <label for="street_address">Street Address:</label>
                <input type="text" id="street_address" name="street_address" value="<?php echo htmlspecialchars($userData['street_address']); ?>">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($userData['city']); ?>">
            </div>
            <div class="form-group">
                <label for="postal_code">Postal code:</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($userData['postal_code']); ?>">
            </div>
            <div class="form-group">
                <label for="state_province">State/Province:</label>
                <input type="text" id="state_province" name="state_province" value="<?php echo htmlspecialchars($userData['state_province']); ?>">
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($userData['country']); ?>">
            </div>
            <button type="submit" class="btn-save">Save</button>
        </form>
    </div>
</body>
</html>
