<?php
// Database connection (assuming $conn is your connection object)
include 'db_connect.php'; // Include your database connection file

function insertPackage($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $package_name = $_POST['package_name'];
        $description = $_POST['description'];

        // Handle pricing based on the pricing type
        $fixed_price = isset($_POST['fixed_price']) ? $_POST['fixed_price'] : null;
        $price_per_kg = isset($_POST['price_per_kg']) ? $_POST['price_per_kg'] : null;
        $discount_recyclables = isset($_POST['discount_recyclables']) ? $_POST['discount_recyclables'] : null;

        // Handle image upload
        $image_url = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/"; // Directory to upload the images
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = array("jpg", "png", "jpeg", "gif");

            // Check if file is a valid image type
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $target_file; // Set the image URL to the uploaded file's path
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'There was an error uploading the image!',
                        });
                    </script>";
                    return;
                }
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Only JPG, JPEG, PNG, and GIF are allowed.',
                    });
                </script>";
                return;
            }
        }

        // Prepare SQL query
        $sql = "INSERT INTO main_package_types (package_name, description, base_price, price_per_kg, discount_for_recyclables, image_url) 
        VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssddds", $package_name, $description, $fixed_price, $price_per_kg, $discount_recyclables, $image_url);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: ../Admin/waste-types.php?message=success");
            exit(); // Ensure no further code is executed after redirect
        } else {
            header("Location: ../Admin/waste-types.php?message=error");
            exit(); // Ensure no further code is executed after redirect
        }


        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}

// Call the function to insert the package
insertPackage($conn);

?>
