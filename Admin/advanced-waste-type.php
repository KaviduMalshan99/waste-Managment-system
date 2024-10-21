<?php 
$title = 'Customer Waste Levels';
$subTitle = 'Waste Collection Details by User';
?>

<?php include './partials/layouts/layoutTop.php'; ?>
<?php include '../server/db_connect.php';

if (isset($_GET['export'])) {
    $exportType = $_GET['export'];
    require 'export_data.php'; // Handle the export logic in a separate file
    exit; // Ensure no further processing after export
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Waste Collection</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="row mb-4">
    <div class="col-md-4">
        <button class="btn btn-danger" id="exportExcel">Export to Excel</button>
    </div>
</div>

<div class="container my-5">
    
    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control" id="userFilter" placeholder="Enter User ID or Name">
        </div>
        <div class="col-md-4">
            <select class="form-control" id="yearFilter">
                <option value="">Select Year</option>
                <?php for ($year = 2020; $year <= 2024; $year++): ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" id="monthFilter">
                <option value="">Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <select class="form-control" id="cityFilter">
                <option value="">Select City</option>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Kalutara">Maharagama</option>
                <option value="Kalutara">Panadura</option>
                <option value="Kalutara">Kotte</option>
                <option value="Kalutara">Colombo 3</option>
                <!-- Add more cities as needed -->
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" id="packageFilter">
                <option value="">Select Package</option>
                <?php
                // Fetch package names from the database
                $packageQuery = "SELECT id, package_name FROM main_package_types";
                $packageResult = $conn->query($packageQuery);
                while ($package = $packageResult->fetch_assoc()) {
                    echo "<option value='" . $package['id'] . "'>" . htmlspecialchars($package['package_name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <div class="d-flex">
                <input type="number" class="form-control" id="minWaste" placeholder="Min Waste (kg)">
                <input type="number" class="form-control" id="maxWaste" placeholder="Max Waste (kg)" style="margin-left: 5px;">
            </div>
        </div>
    </div>

    <!-- Data Table Section -->
    <div id="dataTable" style="margin-top:30px;">
        <!-- Table content will be loaded here via AJAX -->
    </div>
</div>

<script>
$(document).ready(function() {
    // Function to load data with filters
    function loadTableData(user = '', year = '', month = '', city = '', package = '', minWaste = '', maxWaste = '') {
        $.ajax({
            url: "fetch_waste_data.php", // The PHP file where you handle the data fetching
            method: "POST",
            data: {
                user: user,
                year: year,
                month: month,
                city: city,
                package: package,
                minWaste: minWaste,
                maxWaste: maxWaste
            },
            success: function(response) {
                $('#dataTable').html(response); // Update the table with the filtered data
            }
        });
    }

    // Load all data on page load
    loadTableData();

    // Trigger AJAX on filter input change
    $('#userFilter, #yearFilter, #monthFilter, #cityFilter, #packageFilter, #minWaste, #maxWaste').on('change keyup', function() {
        var user = $('#userFilter').val();
        var year = $('#yearFilter').val();
        var month = $('#monthFilter').val();
        var city = $('#cityFilter').val();
        var package = $('#packageFilter').val();
        var minWaste = $('#minWaste').val();
        var maxWaste = $('#maxWaste').val();
        loadTableData(user, year, month, city, package, minWaste, maxWaste); // Reload table data based on filters
    });

    $('#exportExcel').on('click', function() {
        const user = $('#userFilter').val();
        const year = $('#yearFilter').val();
        const month = $('#monthFilter').val();
        const city = $('#cityFilter').val();
        const package = $('#packageFilter').val();
        const minWaste = $('#minWaste').val();
        const maxWaste = $('#maxWaste').val();

        window.location.href = 'fetch_waste_data.php?export=excel&user=' + encodeURIComponent(user) +
            '&year=' + encodeURIComponent(year) +
            '&month=' + encodeURIComponent(month) +
            '&city=' + encodeURIComponent(city) +
            '&package=' + encodeURIComponent(package) +
            '&minWaste=' + encodeURIComponent(minWaste) +
            '&maxWaste=' + encodeURIComponent(maxWaste);
    });
});
</script>

</body>
</html>

<?php include './partials/layouts/layoutBottom.php'; ?>
