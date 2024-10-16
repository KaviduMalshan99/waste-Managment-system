<?php 
    $title = 'Waste Types';
    $subTitle = 'Settings - WasteTypes';
?>

<?php include './partials/layouts/layoutTop.php'; ?>

    <div class="card h-100 p-0 radius-12 overflow-hidden">
        <div class="card-body p-40">
            <form action="process_package.php" method="POST"> <!-- Add action and method -->
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

                    <!-- Package Type -->
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="pricing_type" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Pricing Type <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-control radius-8 form-select" id="pricing_type" name="pricing_type" required>
                                <option selected disabled>Select Pricing Type</option>
                                <option value="flat_rate">Flat Rate</option>
                                <option value="weight_based">Weight-Based</option>
                                <option value="recyclable">Recyclable Waste</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fixed Price (for Flat Rate packages) -->
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="fixed_price" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Fixed Price (Flat Rate) 
                            </label>
                            <input type="number" class="form-control radius-8" id="fixed_price" name="fixed_price" placeholder="Enter Fixed Price">
                        </div>
                    </div>

                    <!-- Price Per KG (for Weight-Based packages) -->
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="price_per_kg" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Price Per KG (Weight-Based) 
                            </label>
                            <input type="number" class="form-control radius-8" id="price_per_kg" name="price_per_kg" placeholder="Enter Price Per KG">
                        </div>
                    </div>

                    <!-- Discount for Recyclables -->
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="discount_recyclables" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Discount for Recyclables
                            </label>
                            <input type="number" class="form-control radius-8" id="discount_recyclables" name="discount_recyclables" placeholder="Enter Discount for Recyclables">
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

<?php include './partials/layouts/layoutBottom.php'; ?>
