<?php
require '../vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Include database connection
include '../server/db_connect.php';

// Get filter values (you might want to fetch from your previous script)
$user = isset($_POST['user']) ? $_POST['user'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
$month = isset($_POST['month']) ? $_POST['month'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$package = isset($_POST['package']) ? $_POST['package'] : '';
$minWaste = isset($_POST['minWaste']) ? $_POST['minWaste'] : '';
$maxWaste = isset($_POST['maxWaste']) ? $_POST['maxWaste'] : '';

// Your previous query logic here
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

// Add filters to the query (similar to your previous code)
// ...

$query .= " GROUP BY u.id, mwc.month, mwc.year ORDER BY u.name, mwc.year DESC";

// Execute query
$result = $conn->query($query);

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the header row
$sheet->setCellValue('A1', 'User Name')
      ->setCellValue('B1', 'Package Name')
      ->setCellValue('C1', 'Month')
      ->setCellValue('D1', 'Year')
      ->setCellValue('E1', 'Total Waste (kg)')
      ->setCellValue('F1', 'Total Price ($)');

// Add data
$row = 2;
while ($data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, htmlspecialchars($data['user_name']))
          ->setCellValue('B' . $row, htmlspecialchars($data['package_name']))
          ->setCellValue('C' . $row, htmlspecialchars($data['month']))
          ->setCellValue('D' . $row, htmlspecialchars($data['year']))
          ->setCellValue('E' . $row, htmlspecialchars($data['total_waste']))
          ->setCellValue('F' . $row, htmlspecialchars($data['total_price']));
    $row++;
}

// Write and save the Excel file
$writer = new Xlsx($spreadsheet);
$filename = 'Waste_Collection_Report.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output'); // Output to browser

$conn->close();
?>
