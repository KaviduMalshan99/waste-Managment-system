<?php 
    $title = 'Map of Registered Users';
    $subTitle = 'Components / Users Map';
?>

<?php include './partials/layouts/layoutTop.php'; ?>
<?php include '../server/db_connect.php'; ?>

<!-- Main Content -->
<div class="container my-5">
    

    <div class="row">
        <div class="col-md-6" style="margin-left:20%">
            <div class="card h-150 p-0">
                <div class="card-header border-bottom bg-base py-3 px-4">
                    <h6 class="text-lg fw-semibold mb-0 " style="text-align:center;">Donut Chart of Waste Types</h6>
                </div>
                <div class="card-body p-4 text-center d-flex flex-wrap align-items-start gap-5 justify-content-center">
                    <div class="position-relative">
                        <canvas id="basicDonutChart" class="w-auto d-inline-block"></canvas>
                        <div class="position-absolute start-50 top-50 translate-middle">
                            <span class="text-lg text-secondary-light fw-medium">Total Users</span>
                            <h4 id="totalWasteDisplay" class="mb-5">0</h4>
                        </div>
                    </div>

                    <div class="max-w-290-px w-100" id="wasteLabels">
                        <!-- Waste labels will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Fetch the count of users by package type
$sql = "
    SELECT
        cp.package_id,
        pt.package_name,
        COUNT(DISTINCT cp.user_id) AS user_count
    FROM
        customer_packages cp
    JOIN
        main_package_types pt ON cp.package_id = pt.id
    GROUP BY
        cp.package_id, pt.package_name;
";

$result = $conn->query($sql);

$wasteData = [];
$totalUsers = 0; // Variable to store total users across all packages

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $wasteData[] = $row;
        $totalUsers += $row['user_count']; // Calculate the total users for display
    }
} else {
    echo "<script>console.warn('No waste data found');</script>";
}

// Close the database connection
$conn->close();

// Pass the waste data and total users to JavaScript
echo "<script>var wasteData = " . json_encode($wasteData) . ";</script>";
echo "<script>var totalUsers = " . json_encode($totalUsers) . ";</script>";
?>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Prepare data for the donut chart
const labels = wasteData.map(item => item.package_name);
const dataValues = wasteData.map(item => item.user_count); // Use user count for chart data
const totalUsersValue = totalUsers; // Total users across all packages

document.getElementById('totalWasteDisplay').innerText = totalUsersValue; // Update the total display

// Create the donut chart
const ctx = document.getElementById('basicDonutChart').getContext('2d');
const myDonutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: dataValues,
            backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        const value = tooltipItem.raw;
                        const percentage = ((value / totalUsersValue) * 100).toFixed(2);
                        return `${tooltipItem.label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});

// Populate the waste labels
const wasteLabelsContainer = document.getElementById('wasteLabels');
wasteData.forEach((item, index) => {
    const percentage = ((item.user_count / totalUsersValue) * 100).toFixed(2);
    wasteLabelsContainer.innerHTML += `
        <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
            <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                <span class="w-12-px h-12-px" style="background-color: ${myDonutChart.data.datasets[0].backgroundColor[index]};" class="rounded-circle"></span> ${item.package_name}
            </span>
            <span class="text-primary-light fw-medium text-sm">${item.user_count}</span>
            <span class="text-primary-light fw-medium text-sm">${percentage}%</span>
        </div>`;
});
</script>

<?php include './partials/layouts/layoutBottom.php'; ?>
