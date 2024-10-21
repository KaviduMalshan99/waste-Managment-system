<?php 
    $title = 'Waste Types';
    $subTitle = 'Settings - Waste Types';
    // Include the top layout
    include './partials/layouts/layoutTop.php'; 
    
    // Connect to the database (replace with your actual credentials)
    include '../server/db_connect.php';

    // Fetch the waste packages from the database
    $sql = "SELECT id, package_name, description, base_price, price_per_kg, discount_for_recyclables, image_url FROM main_package_types";
    $result = $conn->query($sql);
?>

<div class="">

    <!-- Add Types Button -->
    <div class="mb-4">
        <a href="waste-types.php" style="margin-left:90%; margin-bottom: 50px;" class="btn btn-primary">Add Types</a>
    </div>

    <div class="row gy-4">
        <?php 
        // Check if there are results from the database
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
        ?>
        <div class="col-xxl-4 col-sm-6">
            <div class="card h-100 radius-12 bg-gradient-primary text-center">
                <div class="card-body p-24">
                    
                    
                    <h6 class="mb-8"><?php echo $row['package_name']; ?></h6>
                    <p class="card-text mb-8 text-secondary-light"><?php echo $row['description']; ?></p>
                    <p class="card-text mb-8 text-secondary-light fw-bold">Base Price: <?php echo $row['base_price']; ?></p>
                    <p class="card-text mb-8 text-secondary-light fw-bold">Price per KG: <?php echo $row['price_per_kg']; ?></p>
                    <p class="card-text mb-8 text-secondary-light fw-bold">Discount: <?php echo $row['discount_for_recyclables']; ?></p>
                    
                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            echo "No records found.";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<?php 
// Include the bottom layout
include './partials/layouts/layoutBottom.php'; 
?>
