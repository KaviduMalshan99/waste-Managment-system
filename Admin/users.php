<?php 
// Page Titles
$title = 'Users List';
$subTitle = 'Users List';

// Include your layout or header
include './partials/layouts/layoutTop.php'; 

include '../server/db_connect.php';

// Pagination setup
$limit = 10; // Number of users to show per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Prepare the SQL query using prepared statements
$stmt = $conn->prepare("
    SELECT id, name, email, CONCAT(street_address, ', ', city, ', ', postal_code, ', ', state_province, ', ', country) AS full_address, created_at 
    FROM users 
    LIMIT ? OFFSET ?
");
$stmt->bind_param("ii", $limit, $offset); // Binding limit and offset
$stmt->execute();
$result = $stmt->get_result(); // Fetch the result

// Total users count for pagination
$totalUsersQuery = "SELECT COUNT(*) AS total FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsersRow = $totalUsersResult->fetch_assoc();
$totalUsers = $totalUsersRow['total'];
$totalPages = ceil($totalUsers / $limit);
?>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>10</option>
                <!-- Add more options as needed -->
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
        </div>
        <a href="add-user.php" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl"></iconify-icon>
            Add New User
        </a>
    </div>
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">S.L</th>
                        <th scope="col" style="width:150px">Name</th>
                        <th scope="col" style="width:150px">Email</th>
                        <th scope="col" style="width:200px">Full Address</th>
                        <th scope="col" style="width:150px">Join Date</th>
                        <th scope="col" style="width:150px">Waste Level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result->num_rows > 0) {
                        $sl = $offset + 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_address']); ?></td>
                                <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" onclick="showWasteLevel(<?= $row['id']; ?>)">
                                            <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center">No users found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
            <span>Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $totalUsers); ?> of <?php echo $totalUsers; ?> entries</span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <?php if ($page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="?page=<?php echo $page - 1; ?>">
                            <iconify-icon icon="ep:d-arrow-left"></iconify-icon>
                        </a>
                    </li>
                <?php } ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item">
                        <a class="page-link text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md <?php if ($i == $page) echo 'bg-primary-600 text-white'; ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <?php if ($page < $totalPages) { ?>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="?page=<?php echo $page + 1; ?>">
                            <iconify-icon icon="ep:d-arrow-right"></iconify-icon>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal for Waste Level Indicator -->
<div class="modal fade" id="wasteLevelModal" tabindex="-1" aria-labelledby="wasteLevelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wasteLevelModalLabel">Waste Level Indicator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Filled by AJAX -->
            </div>
        </div>
    </div>
</div>

<script>
    function showWasteLevel(userId) {
        $.post('fetch_waste_level2.php', { user_id: userId }, function(data) {
            $('#wasteLevelModal .modal-body').html(data);
            $('#wasteLevelModal').modal('show');
        });
    }
</script>

<?php 
// Close the connection
$stmt->close();
$conn->close();

// Include your footer
include './partials/layouts/layoutBottom.php'; 
?>
