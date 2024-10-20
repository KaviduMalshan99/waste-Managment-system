<?php
session_start();  // Start the session

// Include the database connection
include 'db_connect.php'; // Ensure the database connection path is correct

// Function to handle package addition
function handlePackageAddition($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['package_id'])) {
        $user_id = $_POST['user_id'];  // Retrieve user ID from form post
        $package_id = $_POST['package_id'];  // Retrieve package ID from form post

        // SQL to insert the selected package into customer_packages
        $sql = "INSERT INTO customer_packages (user_id, package_id, start_date, total_waste_collected, total_price, last_billing_date) 
                VALUES (?, ?, CURDATE(), 0.00, 0.00, CURDATE())";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ii", $user_id, $package_id);
            if($stmt->execute()) {
                echo "<script>alert('Your Package added successfully.'); window.location.href = 'userProfile.php';</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: userlogin.php');
    exit();
}

// Check if we're handling a package addition
handlePackageAddition($conn);

// Query to get data for all packages
$sql = "SELECT * FROM main_package_types";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Waste Management Plans</title>
<style>

    .header {
        text-align: center;
        width: 100%; /* Ensures header is full width */
        margin-bottom: 20px; /* Space below the header */
    }
    .topiccc{
        margin-left:42%;
        margin-top:50px;
        font-size:20px;
        margin-bottom:80px;
    }
    .card-container {
        display: flex;
        justify-content: space-around; /* Evenly space content */
        align-items: flex-start; /* Align items at the start of the flex container */
        flex-wrap: no-wrap; /* Prevents wrapping */
        width: 90%; /* Adjust as needed */
        max-width: 1200px; /* Restrict maximum width for better control */
        margin-left:370px;
    }
    .card {
        background: #e0e0d1;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 20px;
        height: 550px;
        text-align: center;
        flex: 1; /* Allows each card to grow */
        margin: 10px;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.1);
        min-width: 300px; /* Minimum width of each card */
        max-width: 360px; /* Maximum width of each card to ensure three fit in a row */
    }
    h2 {
        margin-top:15px;
        margin-bottom:10px;
        color: #333;
        font-size: 25px;
    }
    p, li {
        margin-top:20px;
        color: #000;
        font-size: 16px;
        line-height: 1.5;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        background: #fff;
        margin-bottom: 8px;
        padding: 10px;
        border-radius: 20px;
    }
    .package-btn {
        background-color: #404A3D;
        color: white;
        margin-top:20px;
        padding: 12px 30px;
        border: none;
        border-radius: 20px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .package-btn:hover {
        background-color: #36482f; /* Darken color on hover */
    }
</style>
</head>
<body>
<?php include 'sidebarUser.php'; ?> <!-- Including the sidebar here -->

    <div class="maincontainer">
        <div class="topiccc">
            <h1>WASTE PLAN PACKAGES</h1>
        </div>

        <div class="card-container">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<form method='post'>";
                    echo "<div class='card'>";
                    echo "<h2>" . htmlspecialchars($row["package_name"]) . "</h2>";
                    echo "<p>Description: " . htmlspecialchars($row["description"]) . "</p>";
                    echo "<ul>";
                    echo "<li>Base Price: Rs. " . number_format($row["base_price"], 2) . "</li>";
                    echo "<li>Price per kg: Rs. " . number_format($row["price_per_kg"], 2) . "</li>";
                    echo "<li>Discount: Rs. " . number_format($row["discount_for_recyclables"], 2) . "</li>";
                    echo "</ul>";
                    echo "<input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>";
                    echo "<input type='hidden' name='package_id' value='" . $row['id'] . "'>";
                    echo "<button type='button' onclick='confirmPackage(this.form)' class='package-btn'>Get Package</button>";
                    echo "</div>";
                    echo "</form>";
                }
            } else {
                echo "<p>No packages found.</p>";
            }
            $conn->close();
            ?>
        </div>

    </div>
    <script>
function confirmPackage(form) {
    if (confirm("Do you want to add this Waste Plan Package?")) {
        form.submit();
    }
}
</script>
</body>
</html>
