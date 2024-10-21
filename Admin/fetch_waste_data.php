<?php

require '../vendor/autoload.php'; // Include PhpSpreadsheet
require '../vendor/tecnickcom/tcpdf/tcpdf.php'; // Include TCPDF

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Include database connection
include '../server/db_connect.php'; // This should be your path to the db_connect.php file

// Get filter values from AJAX request
$user = isset($_POST['user']) ? $_POST['user'] : (isset($_GET['user']) ? $_GET['user'] : '');
$year = isset($_POST['year']) ? $_POST['year'] : (isset($_GET['year']) ? $_GET['year'] : '');
$month = isset($_POST['month']) ? $_POST['month'] : (isset($_GET['month']) ? $_GET['month'] : '');
$city = isset($_POST['city']) ? $_POST['city'] : (isset($_GET['city']) ? $_GET['city'] : '');
$package = isset($_POST['package']) ? $_POST['package'] : (isset($_GET['package']) ? $_GET['package'] : '');
$minWaste = isset($_POST['minWaste']) ? $_POST['minWaste'] : (isset($_GET['minWaste']) ? $_GET['minWaste'] : '');
$maxWaste = isset($_POST['maxWaste']) ? $_POST['maxWaste'] : (isset($_GET['maxWaste']) ? $_GET['maxWaste'] : '');
$export = isset($_GET['export']) ? $_GET['export'] : ''; // Check if export is requested

// Base query to get all data
$query = "
    SELECT 
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
    WHERE 1=1
";

// Add filters to the query
if (!empty($user)) {
    $query .= " AND (u.id = '$user' OR u.name LIKE '%$user%')";
}
if (!empty($year)) {
    $query .= " AND mwc.year = '$year'";
}
if (!empty($month)) {
    $query .= " AND mwc.month = '$month'";
}
if (!empty($city)) {
    $query .= " AND u.city = '$city'"; // Assuming there's a city field in the users table
}
if (!empty($package)) {
    $query .= " AND cp.package_id = '$package'"; // Filter by package ID
}

// Group results and use HAVING for waste range
$query .= " GROUP BY u.id, mwc.month, mwc.year HAVING 1=1"; // Initialize HAVING clause
if (!empty($minWaste)) {
    $query .= " AND total_waste >= '$minWaste'"; // Minimum waste filter
}
if (!empty($maxWaste)) {
    $query .= " AND total_waste <= '$maxWaste'"; // Maximum waste filter
}

// Order the results
$query .= " ORDER BY u.name, mwc.year DESC";

// Fetch data from the database
$result = $conn->query($query);

// Check if there are results
if ($result->num_rows > 0) {
    if ($export === 'excel') {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header for the Excel file
        $sheet->setCellValue('A1', 'User Name');
        $sheet->setCellValue('B1', 'Package Name');
        $sheet->setCellValue('C1', 'Month');
        $sheet->setCellValue('D1', 'Year');
        $sheet->setCellValue('E1', 'Total Waste (kg)');
        $sheet->setCellValue('F1', 'Total Price (LKR)');

        $row = 2;

        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['user_name']);
            $sheet->setCellValue('B' . $row, $data['package_name']);
            $sheet->setCellValue('C' . $row, $data['month']);
            $sheet->setCellValue('D' . $row, $data['year']);
            $sheet->setCellValue('E' . $row, $data['total_waste']);
            $sheet->setCellValue('F' . $row, $data['total_price']);
            $row++;
        }

        // Save the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'waste_collection_data.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    } else {
        // Normal AJAX request, fetch data for the table
        $output = '<table class="table table-bordered">';
        $output .= '<thead><tr><th>User Name</th><th>Package Name</th><th>Month</th><th>Year</th><th>Total Waste (kg)</th><th>Total Price (LKR)</th></tr></thead>';
        $output .= '<tbody>';

        while ($row = $result->fetch_assoc()) {
            $output .= '<tr>';
            $output .= '<td>' . htmlspecialchars($row['user_name']) . '</td>';
            $output .= '<td>' . htmlspecialchars($row['package_name']) . '</td>';
            $output .= '<td>' . htmlspecialchars($row['month']) . '</td>';
            $output .= '<td>' . htmlspecialchars($row['year']) . '</td>';
            $output .= '<td>' . htmlspecialchars($row['total_waste']) . '</td>';
            $output .= '<td>' . htmlspecialchars($row['total_price']) . '</td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table>';
        echo $output; // Return the HTML to be displayed in the table
    }
} else {
    // If no records are found
    echo '<p class="alert alert-warning">No records found.</p>';
}

$conn->close(); // Close the database connection
?>
