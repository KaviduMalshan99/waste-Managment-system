<?php 
    $title='Dashboard';
    $subTitle = 'AI';
?>
<?php include './partials/layouts/layoutTop.php' ?>
<?php include '../server/db_connect.php';

// Fetch total users
$totalUsersQuery = "SELECT COUNT(id) as totalUsers FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['totalUsers'];

// Fetch total waste collected this year
$totalWasteYearQuery = "SELECT SUM(waste_collected) as totalWasteYear FROM monthly_waste_collection WHERE year = YEAR(CURDATE())";
$totalWasteYearResult = $conn->query($totalWasteYearQuery);
$totalWasteYear = $totalWasteYearResult->fetch_assoc()['totalWasteYear'];

// Fetch total waste collected last month
$totalWasteLastMonthQuery = "SELECT SUM(waste_collected) as totalWasteLastMonth FROM monthly_waste_collection WHERE month = MONTHNAME(CURDATE() - INTERVAL 1 MONTH) AND year = YEAR(CURDATE())";
$totalWasteLastMonthResult = $conn->query($totalWasteLastMonthQuery);
$totalWasteLastMonth = $totalWasteLastMonthResult->fetch_assoc()['totalWasteLastMonth'];

// Fetch total income this year
$totalIncomeYearQuery = "SELECT SUM(price_generated) as totalIncomeYear FROM monthly_waste_collection WHERE year = YEAR(CURDATE())";
$totalIncomeYearResult = $conn->query($totalIncomeYearQuery);
$totalIncomeYear = $totalIncomeYearResult->fetch_assoc()['totalIncomeYear'];

// Fetch total income last month
$totalIncomeLastMonthQuery = "SELECT SUM(price_generated) as totalIncomeLastMonth FROM monthly_waste_collection WHERE month = MONTHNAME(CURDATE() - INTERVAL 1 MONTH) AND year = YEAR(CURDATE())";
$totalIncomeLastMonthResult = $conn->query($totalIncomeLastMonthQuery);
$totalIncomeLastMonth = $totalIncomeLastMonthResult->fetch_assoc()['totalIncomeLastMonth'];

// Fetch monthly waste collection and income
$monthlyWasteQuery = "SELECT month, SUM(waste_collected) AS totalWaste, SUM(price_generated) AS totalIncome FROM monthly_waste_collection WHERE year = YEAR(CURDATE()) GROUP BY month ORDER BY FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')";
$monthlyWasteResult = $conn->query($monthlyWasteQuery);

$months = $totalWasteData = $totalIncomeData = [];
while ($row = $monthlyWasteResult->fetch_assoc()) {
    $months[] = $row['month'];
    $totalWasteData[] = $row['totalWaste'];
    $totalIncomeData[] = $row['totalIncome'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

</head>
<body>

<div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Users</p>
                        <h6 class="mb-0"><?= $totalUsers; ?></h6>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +5
                    </span>
                    Last 30 days users
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-2 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total waste collected this year</p>
                        <h6 class="mb-0">KG.<?= $totalWasteYear; ?></h6>
                    </div>
                    <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                        <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800
                    </span>
                    Last Year waste collection
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-3 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total waste collected last month</p>
                        <h6 class="mb-0">KG.<?= $totalWasteLastMonth; ?></h6>
                    </div>
                    <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +200
                    </span>
                    Last 30 days waste collection
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total income for the year</p>
                        <h6 class="mb-0">LKR.<?= $totalIncomeYear; ?></h6>
                    </div>
                    <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +LKR.10,000
                    </span>
                    Last Year income
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-5 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total income for the last month</p>
                        <h6 class="mb-0">KG.<?= $totalIncomeLastMonth; ?></h6>
                    </div>
                    <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +LKR.5000
                    </span>
                    Last 30 days Income
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row" style="margin-top:40px;">
        <div class="col-md-6">
            <h5>Monthly Waste Collection</h5>
            <canvas id="wasteChart"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Monthly Income</h5>
            <canvas id="incomeChart"></canvas>
        </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctxWaste = document.getElementById('wasteChart').getContext('2d');
    const ctxIncome = document.getElementById('incomeChart').getContext('2d');

    new Chart(ctxWaste, {
        type: 'line',
        data: {
            labels: <?= json_encode($months); ?>,
            datasets: [{
                label: 'Total Waste Collected (kg)',
                data: <?= json_encode($totalWasteData); ?>,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(ctxIncome, {
        type: 'line',
        data: {
            labels: <?= json_encode($months); ?>,
            datasets: [{
                label: 'Total Income (LKR)',
                data: <?= json_encode($totalIncomeData); ?>,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

<?php include './partials/layouts/layoutBottom.php' ?>
    
</body>
</html>


