<?php
include './controllers/UserOrderController.php';
$controller = new UserOrderController($conn);

$email = "Gamakavihan2002@gmail.com"; // You can replace this with dynamic email fetching logic
$orders = $controller->getOrders($email);
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
            <?php while ($row = $orders->fetch_assoc()): 
                if ($row['collected'] == 1): ?>
                    <div class='order-container'>
                        <div class='order-details'>
                            Order for: <?= $row['first_name'] . " " . $row['last_name'] ?><br>
                            Address: <?= $row['address'] ?><br>
                            Pickup Date: <?= $row['pickup_date'] ?><br>
                            Pickup Time: <?= $row['pickup_time'] ?><br>
                        </div>
                        <div class='order-price'>
                            LKR <?= $row['weight'] * ($row['waste_type'] == 1 ? 150 : ($row['waste_type'] == 2 ? 300 : 450)) ?><br>
                            <?php if ($row['paid'] == 1): ?>
                                <button class='paid-button' disabled>Paid</button>
                            <?php else: ?>
                                <button class='pay-button' onclick='openPaymentBox("<?= $row['pickup_id'] ?>")'>Pay Now</button>
                            <?php endif; ?>
                        </div>
                        <div class='order-label'>Collected</div>
                    </div>
            <?php endif; endwhile; ?>
        </div>

        <div class="not-collected-orders">
            <h3>Not Collected Orders</h3>
            <?php
            $orders->data_seek(0);  // Reset pointer
            while ($row = $orders->fetch_assoc()):
                if ($row['collected'] == 0): ?>
                    <div class='order-container'>
                        <div class='order-details'>
                            Order for: <?= $row['first_name'] . " " . $row['last_name'] ?><br>
                            Address: <?= $row['address'] ?><br>
                            Pickup Date: <?= $row['pickup_date'] ?><br>
                            Pickup Time: <?= $row['pickup_time'] ?><br>
                        </div>
                        <div class='order-price'>
                            <button class='reschedule-button' onclick='openRescheduleBox("<?= $row['pickup_id'] ?>")'>Reschedule</button>
                        </div>
                        <div class='order-label not-collected'>Not Collected</div>
                    </div>
            <?php endif; endwhile; ?>
        </div>
    </div>

    <!-- Payment and Reschedule Modals -->
    <!-- Add your modal forms here -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // JavaScript to handle form opening, etc.
    </script>

</body>
</html>
