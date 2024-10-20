<?php
// Include the database connection
require_once '../../server/db_connect.php'; // Adjust the path as necessary

// Fetch data from the database
$sql = "SELECT * FROM qr_code_data ORDER BY id";
$result = $conn->query($sql);

// Close the database connection if you're done with it (optional, since you're reusing it)
$conn->close(); // You may want to remove this if you plan to use $conn later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Feedback Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <h1>Location Feedback Data</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location Name</th>
                    <th>Address</th>
                    <th>Waste Weight</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['location_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['location_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['waste_weight']); ?></td>
                        <td><?php echo htmlspecialchars($row['latitude']); ?></td>
                        <td><?php echo htmlspecialchars($row['longitude']); ?></td>
                        <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No data available.</p>
    <?php endif; ?>
</body>
</html>
