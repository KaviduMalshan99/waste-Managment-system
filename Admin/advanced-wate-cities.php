<?php 
    $title = 'High Waste Area Report ';
    $subTitle = 'Components / Waste Stats';
?>

<?php include './partials/layouts/layoutTop.php'; ?>
<?php include '../server/db_connect.php'; ?>

<!-- Main Content -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Monthly High Waste Areas</h5>
                </div>
                <div class="card-body" style="height:450px">
                    <canvas id="topCitiesChart"></canvas>
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
        mwc.month,
        mwc.year,
        SUM(mwc.waste_collected) as total_waste
    FROM 
        users u
    JOIN 
        monthly_waste_collection mwc ON u.id = mwc.user_id
    GROUP BY 
        u.city, mwc.month, mwc.year
    ORDER BY 
        mwc.year, mwc.month, total_waste DESC;
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
    const colors = ['#FF6384', '#36A2EB', '#FFCE56']; // Colors for the cities
    const monthLabels = [];
    const datasets = [];

    // Preparing data for each city as a separate dataset
    Object.keys(topCitiesData).forEach(year => {
        Object.keys(topCitiesData[year]).forEach(month => {
            const monthYearLabel = `${month} ${year}`;
            if (!monthLabels.includes(monthYearLabel)) {
                monthLabels.push(monthYearLabel); // Ensure unique month labels
            }

            topCitiesData[year][month].forEach((city, index) => {
                let dataset = datasets.find(d => d.label === city.city);
                if (!dataset) {
                    dataset = {
                        label: city.city,
                        data: new Array(monthLabels.length).fill(0), // Initialize with zeros
                        backgroundColor: colors[index % colors.length],
                        borderColor: colors[index % colors.length],
                        borderWidth: 1
                    };
                    datasets.push(dataset);
                }
                dataset.data[monthLabels.indexOf(monthYearLabel)] = city.total_waste;
            });
        });
    });

    // Creating the chart
    const topCitiesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    stacked: true, // Stack cities within each month
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Waste Collected (kg)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>

<?php include './partials/layouts/layoutBottom.php'; ?>
