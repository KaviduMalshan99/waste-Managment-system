<?php 
    $title = 'Top Waste Collecting Cities';
    $subTitle = 'Components / Waste Stats';
?>

<?php include './partials/layouts/layoutTop.php'; ?>
<?php include '../server/db_connect.php'; ?>

<!-- Main Content -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6" style="margin-left:20%">
            <div class="card h-150 p-0">
                <div class="card-header border-bottom bg-base py-3 px-4">
                    <h6 class="text-lg fw-semibold mb-0" style="text-align:center;">Monthly Top Waste Collecting Cities</h6>
                </div>
                <div class="card-body p-4 text-center d-flex flex-wrap align-items-start gap-5 justify-content-center">
                    <canvas id="topCitiesChart" class="w-auto d-inline-block"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// SQL Query to fetch monthly waste data by city
$sql = "
    SELECT 
        u.city,
        MONTHNAME(mwc.collection_date) as month,
        YEAR(mwc.collection_date) as year,
        SUM(mwc.waste_collected) as total_waste
    FROM 
        users u
    JOIN 
        monthly_waste_collection mwc ON u.id = mwc.user_id
    GROUP BY 
        u.city, MONTH(mwc.collection_date), YEAR(mwc.collection_date)
    ORDER BY 
        total_waste DESC;
";

$result = $conn->query($sql);
$monthlyData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $monthlyData[$row['year']][$row['month']][] = $row;
    }
}

// Filter to get top 3 cities per month per year
$topCitiesData = [];
foreach ($monthlyData as $year => $months) {
    foreach ($months as $month => $data) {
        usort($data, function($a, $b) {
            return $b['total_waste'] - $a['total_waste'];
        });
        $topCitiesData[$year][$month] = array_slice($data, 0, 3);
    }
}

// Close database connection
$conn->close();

// Pass data to JavaScript
echo "<script>var topCitiesData = " . json_encode($topCitiesData) . ";</script>";
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('topCitiesChart').getContext('2d');
    const topCitiesChart = new Chart(ctx, {
        type: 'bar', // Using a bar chart to display top cities
        data: {
            labels: Object.keys(topCitiesData), // Assume you have a way to generate labels
            datasets: topCitiesData.map((data, index) => ({
                label: 'Top 3 Cities for ' + data.month + ' ' + data.year,
                data: data.map(city => city.total_waste),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }))
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
});
</script>

<?php include './partials/layouts/layoutBottom.php'; ?>
