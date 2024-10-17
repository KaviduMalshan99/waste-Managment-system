<?php 
    $title = 'Waste Types';
    $subTitle = 'Settings - Waste Types';
?>

<?php include './partials/layouts/layoutTop.php'; ?>

<?php
// Check if the 'message' parameter is present in the URL
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'success') {
        echo "<div class='alert alert-success bg-success-100 text-success-600 border-success-600 border-start-width-4-px px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between' style='max-width: 500px; width: 100%; margin-left: auto;' role='alert'>
                <div class='d-flex align-items-center gap-2'>
                    <iconify-icon icon='akar-icons:double-check' class='icon text-xl'></iconify-icon>
                    Package inserted successfully!
                </div>
              </div>";
    } elseif ($_GET['message'] == 'error') {
        echo "<div class='alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between' style='max-width: 500px; width: 100%; margin-left: auto;' role='alert'>
                <div class='d-flex align-items-center gap-2'>
                    <iconify-icon icon='akar-icons:double-check' class='icon text-xl'></iconify-icon>
                    There was an error inserting the package!
                </div>
              </div>";
    }
}
?>

    <div class="card h-100 p-0 radius-12 overflow-hidden">
        <div class="card-body p-40">
            <form action="../server/insertType.php" method="POST" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
                <div class="row">
                    <!-- Package Name -->
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="package_name" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Package Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control radius-8" id="package_name" name="package_name" placeholder="Enter Package Name" required>
                        </div>
                    </div>

                    <!-- Package Description -->
                    <div class="col-sm-12">
                        <div class="mb-20">
                            <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Package Description <span class="text-danger-600">*</span>
                            </label>
                            <textarea class="form-control radius-8" id="description" name="description" rows="4" placeholder="Enter Package Description" required></textarea>
                        </div>
                    </div>

                    <!-- Fixed Price (for Flat Rate packages) -->
                    <div class="col-sm-6" id="fixed_price_div">
                        <div class="mb-20">
                            <label for="fixed_price" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Fixed Price (Flat Rate) 
                            </label>
                            <input type="number" class="form-control radius-8" id="fixed_price" name="fixed_price" placeholder="Enter Fixed Price">
                        </div>
                    </div>

                    <!-- Price Per KG (for Weight-Based packages) -->
                    <div class="col-sm-6" id="price_per_kg_div">
                        <div class="mb-20">
                            <label for="price_per_kg" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Price Per KG (Weight-Based) 
                            </label>
                            <input type="number" class="form-control radius-8" id="price_per_kg" name="price_per_kg" placeholder="Enter Price Per KG">
                        </div>
                    </div>

                    <!-- Discount for Recyclables -->
                    <div class="col-sm-6" id="discount_recyclables_div">
                        <div class="mb-20">
                            <label for="discount_recyclables" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Discount for Recyclables
                            </label>
                            <input type="number" class="form-control radius-8" id="discount_recyclables" name="discount_recyclables" placeholder="Enter Discount for Recyclables">
                        </div>
                    </div>

                    

                    <!-- Image Upload -->
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="image" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Upload Image
                            </label>
                            <input type="file" class="form-control radius-8" id="image" name="image" accept="image/*">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                        <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                            Save Package
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
    // Function to toggle price fields based on selected pricing type
    function togglePriceFields() {
        var pricingType = document.getElementById('pricing_type').value;

        // Hide all fields by default
        document.getElementById('fixed_price_div').style.display = 'none';
        document.getElementById('price_per_kg_div').style.display = 'none';
        document.getElementById('discount_recyclables_div').style.display = 'none';

        // Show relevant fields based on the selected type
        if (pricingType === 'flat_rate') {
            document.getElementById('fixed_price_div').style.display = 'block';
        } else if (pricingType === 'weight_based') {
            document.getElementById('price_per_kg_div').style.display = 'block';
        } else if (pricingType === 'recyclable') {
            document.getElementById('discount_recyclables_div').style.display = 'block';
        }
    }
</script>

<?php include './partials/layouts/layoutBottom.php'; ?>
