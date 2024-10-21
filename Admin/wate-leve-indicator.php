
<?php 
$title = 'Customer Waste Levels';
$subTitle = 'Live Waste Level Indicator';
?>

<?php include './partials/layouts/layoutTop.php'; ?>
<?php include '../server/db_connect.php'; 

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT cp.*, u.name, u.id as user_id, mpt.package_name, mpt.description 
              FROM customer_packages cp
              JOIN users u ON cp.user_id = u.id
              JOIN main_package_types mpt ON cp.package_id = mpt.id
              WHERE u.name LIKE ? OR u.id = ?";

    if ($stmt = $conn->prepare($query)) {
        $searchParam = "%{$search}%";
        $stmt->bind_param("si", $searchParam, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Level Indicator</title>
    
</head>
<body>
    <div class="container">
        
        <form action="" id="userSearchForm" method="post">
            <div class="input-group">
                <input type="text" class="form-control"  name="search" placeholder="Enter User ID or Name" required>
                <button class="btn btn-primary"  type="submit">Search</button>
            </div>
        </form>

        <?php if (isset($data)): ?>
        <div class="user-info" style="margin-top:50px; width:60%; margin-left:20%; text-align:center;">
            <h5><?= htmlspecialchars($data['name']); ?> - <?= htmlspecialchars($data['package_name']); ?></h5>
            <p><?= htmlspecialchars($data['description']); ?></p>
            <img src="assets/images/ds.png" alt="site logo" class="light-logo" >
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= ($data['total_waste_collected'] / 100) * 100; ?>%" aria-valuenow="<?= $data['total_waste_collected']; ?>" aria-valuemin="0" aria-valuemax="1000"><?= $data['total_waste_collected']; ?> kg</div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include './partials/layouts/layoutBottom.php'; ?>
