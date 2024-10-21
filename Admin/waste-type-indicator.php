<?php 
$title = 'Customer Waste Levels';
$subTitle = 'Waste Collection Details by User';
?>

<?php include './partials/layouts/layoutTop.php'; ?>
<?php include '../server/db_connect.php'; ?>

<!-- Main Content -->
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <form id="userSearchForm" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="user_id" placeholder="Enter User ID or Name" required>
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Initialize variables
    $wasteData = [];
    $totalWaste = 0;
    $totalPrice = 0;

    // Prepare the base query to fetch waste data for all users
    $baseQuery = "
        SELECT 
            u.id AS user_id, 
            u.name AS user_name, 
            mp.package_name,
            mwc.month, 
            mwc.year, 
            SUM(mwc.waste_collected) AS total_waste, 
            SUM(mwc.price_generated) AS total_price
        FROM 
            users u 
        JOIN 
            customer_packages cp ON u.id = cp.user_id
        JOIN 
            main_package_types mp ON cp.package_id = mp.id
        LEFT JOIN 
            monthly_waste_collection mwc ON u.id = mwc.user_id
    ";

    // If search is performed, modify the query
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
        $userInput = $_POST['user_id'];
        $baseQuery .= " WHERE u.id = ? OR u.name LIKE ? ";
        $likeName = "%" . $userInput . "%";
    }

    // Group by user ID and month/year
    $baseQuery .= " GROUP BY u.id, mwc.month, mwc.year ORDER BY u.name, mwc.year DESC, FIELD(mwc.month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')";

    // Prepare and execute the final query
    $stmt = $conn->prepare($baseQuery);
    if (isset($userInput)) {
        $stmt->bind_param('is', $userInput, $likeName);
    }
    $stmt->execute();
    $wasteResult = $stmt->get_result();

    if ($wasteResult->num_rows > 0) {
        while ($row = $wasteResult->fetch_assoc()) {
            $wasteData[] = $row;
            $totalWaste += $row['total_waste'];
            $totalPrice += $row['total_price'];
        }
    } else {
        // If no data found, show message
        if (isset($userInput)) {
            echo "<div class='alert alert-danger'>No data found for this user.</div>";
        } else {
            echo "<div class='alert alert-warning'>No waste data available.</div>";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <div class="table-responsive" style="margin-top:30px; border-radious:10px">
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Package Name</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Total Waste (kg)</th>
                    <th>Total Price ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($wasteData)): ?>
                    <?php foreach ($wasteData as $data): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($data['package_name']); ?></td>
                            <td><?php echo htmlspecialchars($data['month']); ?></td>
                            <td><?php echo htmlspecialchars($data['year']); ?></td>
                            <td><?php echo htmlspecialchars($data['total_waste']); ?></td>
                            <td><?php echo htmlspecialchars($data['total_price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td><?php echo $totalWaste; ?></td>
                        <td><?php echo number_format($totalPrice, 2); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No data available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php'; ?>
