<?php
session_start();  // Start the session

// Include the database connection
include 'db_connect.php'; // Ensure the database connection path is correct

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: userlogin.php');  // Redirect to login page if not logged in
    exit();
}

// Get the logged-in user ID
$user_id = $_SESSION['user_id'];

// Query to get the selected package for the logged-in user, including total waste collected
$sql = "SELECT mt.package_name, mt.description, mt.base_price, mt.price_per_kg, mt.discount_for_recyclables, cp.total_waste_collected 
        FROM customer_packages cp
        JOIN main_package_types mt ON cp.package_id = mt.id
        WHERE cp.user_id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);  // Bind the user ID
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user has a selected package
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();  // Fetch package data
    } else {
        $package = null;  // No package found for the user
    }
    $stmt->close();
} else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
}

$conn->close();

// Calculate the total payment based on the package type
$total_payment = 0;
if ($package) {
    if ($package['package_name'] === 'Weight-Based') {
        $per_kg_price = 50.00;  // Set per kg price for weight-based package
        $total_payment = $package['total_waste_collected'] * $per_kg_price;
    } elseif ($package['package_name'] === 'Flat Rate') {
        $total_payment = $package['base_price'];  // Set to base price for flat-rate package
    } elseif ($package['package_name'] === 'Recyclable Waste') {
        $total_payment = $package['total_waste_collected'] * $package['discount_for_recyclables'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Selected Waste Plan</title>
    <style>
        .container {
            max-width: 750px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #f4f4f4;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        .package-card {
            padding: 20px;
            background-color: #e0e0d1;
            border-radius: 20px;
            text-align: center;
        }
        .package-card h3 {
            margin-bottom: 30px;
            font-size: 24px;
        }
        .package-card p {
            margin-bottom: 20px;
            font-size: 18px;
        }
        /* Special styling for total price */
        .total-price {
            margin-top: 20px;
            padding: 20px;
            background-color: #AFE1AF;
            color: #2c3e50;
            font-size: 22px;
            font-weight: bold;
            border: 2px solid #2c3e50;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .total-price span {
            color: #e74c3c; /* Highlighting the price */
        }
                /* Button styling */
                .payment-button {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            background-color: #00008B;
            color: white;
            text-align: center;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .payment-button:hover {
            background-color: #2980b9;
        }
        .payment-button-container {
            text-align: center; /* Center the button */
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php include 'sidebarUser.php'; ?> <!-- Including the sidebar here -->

<div class="container">
    <h2>Your Selected Waste Plan Package</h2>
    
    <?php if ($package): ?>
        <div class="package-card">
            <h3><?php echo htmlspecialchars($package['package_name']); ?></h3>
            <p><?php echo htmlspecialchars($package['description']); ?></p>
            <p>Base Price: Rs. <?php echo number_format($package['base_price'], 2); ?></p>
            <p>Price per kg: Rs. <?php echo number_format($package['price_per_kg'], 2); ?></p>
            <p>Discount for Recyclables: Rs. <?php echo number_format($package['discount_for_recyclables'], 2); ?></p>
            <p>Total Waste Collected: <?php echo number_format($package['total_waste_collected'], 2); ?> kg</p>

            <!-- Total Payment Section -->
            <div class="total-price">
                Total Payment: <span>Rs. <?php echo number_format($total_payment, 2); ?></span>
            </div>
        </div>

                <!-- Payment Button Section (Outside the card) -->
                <div class="payment-button-container">
            <button class="payment-button">Proceed to Payment</button>
        </div>

    <?php else: ?>
        <p>You have not selected any waste plan package yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
