<?php
// Include the Singleton Database class
include './server/db_connect1.php';

// Get the database instance and connection
$db = Database::getInstance();
$conn = $db->getConnection();

// User's email address
$email = "Gamakavihan2002@gmail.com";

// SQL query to retrieve orders for the given email
$sql = "SELECT pickup_id, first_name, last_name, address, pickup_date, pickup_time, collected, weight, waste_type, paid 
        FROM waste_pickups 
        WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Process payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'pay') {
        $pickupId = $_POST['pickup_id'];
        $cardName = $_POST['card_name'];
        $cardNumber = $_POST['card_number'];
        $expiryDate = $_POST['expiry_date'];
        $cvv = $_POST['cvv'];

        // Simple card validation logic
        if (empty($cardName) || empty($cardNumber) || empty($expiryDate) || empty($cvv) || !is_numeric($cardNumber) || strlen($cvv) != 3) {
            echo "<script>alert('Invalid payment details. Please try again.');</script>";
        } else {
            // Update payment status in the database
            $update_sql = "UPDATE waste_pickups SET paid = 1 WHERE pickup_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("s", $pickupId);
            if ($update_stmt->execute()) {
                echo "<script>alert('Payment successful!'); window.location.href = 'user_orders.php';</script>";
            } else {
                echo "<script>alert('Payment failed. Please try again.');</script>";
            }
            $update_stmt->close();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'reschedule') {
        // Reschedule action
        $pickupId = $_POST['pickup_id'];
        $newDate = $_POST['new_pickup_date'];
        $newTime = $_POST['new_pickup_time'];

        // Update the pickup date and time in the database
        $update_sql = "UPDATE waste_pickups SET pickup_date = ?, pickup_time = ? WHERE pickup_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sss", $newDate, $newTime, $pickupId);
        $update_stmt->execute();
        echo "<script>alert('Pickup rescheduled successfully.'); window.location.href = 'user_orders.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .orders-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .collected-orders, .not-collected-orders {
            width: 48%;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .order-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            position: relative;
            background-color: #f9fafc;
        }

        .order-details {
            width: 70%;
            color: #333;
        }

        .order-price {
            margin-top: 30px;

            text-align: right;
            width: 150%;
            font-size: 18px;
            font-weight: bold;
        }

        .pay-button, .reschedule-button {
            margin-top: 60px;

            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pay-button:hover, .reschedule-button:hover {
            background-color: #45a049;
        }

        .paid-button {
            margin-top: 50px;
            padding: 0px 20px;
            background-color: #888;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: not-allowed;
        }

        .order-label {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
        }

        .order-label.not-collected {
            background-color: #FF6347;
        }

        .payment-box, .reschedule-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            z-index: 9999;
        }

        .payment-box input, .reschedule-box input {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .close-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #FF6347;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .submit-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h2>User Orders</h2>

    <div class="orders-section">
        <div class="collected-orders">
            <h3>Collected Orders</h3>
            <?php
            while ($row = $result->fetch_assoc()) {
                $fullName = $row['first_name'] . " " . $row['last_name'];
                $address = $row['address'];
                $pickupTime = $row['pickup_time'];
                $collected = $row['collected'];
                $weight = $row['weight'];
                $wasteType = $row['waste_type'];
                $paid = $row['paid'];

                if ($wasteType == 1) $pricePerKg = 150;
                if ($wasteType == 2) $pricePerKg = 300;
                if ($wasteType == 3) $pricePerKg = 450;
                $dueAmount = $weight * $pricePerKg;

                if ($collected == 1) {
                    echo "<div class='order-container'>";
                    echo "<div class='order-details'>";
                    echo "Order for: $fullName<br>";
                    echo "Address: $address<br>";
                    echo "Pickup Date: {$row['pickup_date']}<br>";
                    echo "Pickup Time: $pickupTime<br>";
                    echo "</div>";
                    echo "<div class='order-price'>LKR $dueAmount<br>";

                    if ($paid == 1) {
                        echo "<button class='paid-button' disabled>Paid</button>";
                    } else {
                        echo "<button class='pay-button' onclick='openPaymentBox(\"{$row['pickup_id']}\", \"$dueAmount\")'>Pay Now</button>";
                    }

                    echo "</div>";
                    echo "<div class='order-label'>Collected</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>

        <div class="not-collected-orders">
            <h3>Not Collected Orders</h3>
            <?php
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $fullName = $row['first_name'] . " " . $row['last_name'];
                $address = $row['address'];
                $pickupDate = $row['pickup_date'];
                $pickupTime = $row['pickup_time'];
                $collected = $row['collected'];

                if ($collected == 0) {
                    echo "<div class='order-container'>";
                    echo "<div class='order-details'>";
                    echo "Order for: $fullName<br>";
                    echo "Address: $address<br>";
                    echo "Pickup Date: $pickupDate<br>";
                    echo "Pickup Time: $pickupTime<br>";
                    echo "</div>";
                    echo "<div class='order-price'>";
                    echo "<button class='reschedule-button' onclick='openRescheduleBox(\"{$row['pickup_id']}\")'>Reschedule</button>";
                    echo "</div>";
                    echo "<div class='order-label not-collected'>Not Collected</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Payment Box Modal -->
    <div class="payment-box" id="paymentBox">
        <h3>Enter Payment Details</h3>
        <form method="POST" onsubmit="return validatePaymentForm()">
            <input type="hidden" id="paymentPickupId" name="pickup_id">
            <input type="hidden" name="action" value="pay">
            <input type="text" name="card_name" id="cardName" placeholder="Cardholder Name" required>
            <input type="text" name="card_number" id="cardNumber" placeholder="Card Number" required>
            <input type="text" name="expiry_date" id="expiryDate" placeholder="Expiry Date (MM/YY)" required>
            <input type="text" name="cvv" id="cvv" placeholder="CVV" required>
            <button type="submit" class="submit-button">Submit Payment</button>
        </form>
        <button class="close-button" onclick="closePaymentBox()">Close</button>
    </div>

    <!-- Reschedule Box Modal -->
    <div class="reschedule-box" id="rescheduleBox">
        <h3>Reschedule Pickup</h3>
        <form method="POST" onsubmit="return validateRescheduleForm()">
            <input type="hidden" id="reschedulePickupId" name="pickup_id">
            <input type="hidden" name="action" value="reschedule">
            <input type="text" name="new_pickup_date" id="newPickupDate" placeholder="Select New Date">
            <input type="time" name="new_pickup_time" id="newPickupTime" placeholder="Select New Time">
            <button type="submit" class="submit-button">Submit Reschedule</button>
        </form>
        <button class="close-button" onclick="closeRescheduleBox()">Close</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#newPickupDate", {
            minDate: "today",
            dateFormat: "Y-m-d"
        });

        function openPaymentBox(pickupId, amount) {
            document.getElementById("paymentBox").style.display = "block";
            document.getElementById("paymentPickupId").value = pickupId;
        }

        function closePaymentBox() {
            document.getElementById("paymentBox").style.display = "none";
        }

        function openRescheduleBox(pickupId) {
            document.getElementById("rescheduleBox").style.display = "block";
            document.getElementById("reschedulePickupId").value = pickupId;
        }

        function closeRescheduleBox() {
            document.getElementById("rescheduleBox").style.display = "none";
        }

        function validatePaymentForm() {
            const cardNumber = document.getElementById('cardNumber').value;
            const cvv = document.getElementById('cvv').value;
            const expiryDate = document.getElementById('expiryDate').value;

            // Basic validation
            if (!/^\d{16}$/.test(cardNumber)) {
                alert('Please enter a valid 16-digit card number.');
                return false;
            }
            if (!/^\d{3}$/.test(cvv)) {
                alert('Please enter a valid 3-digit CVV.');
                return false;
            }
            if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
                alert('Please enter a valid expiry date (MM/YY).');
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
