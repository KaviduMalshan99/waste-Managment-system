<?php
// Include the necessary files
include './controllers/UserOrderController.php';
include './controllers/LocationController.php';

// Get the page parameter from the URL to determine which page to route to
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define the routes
switch ($page) {
    case 'locations':
        // Call LocationController to handle locations logic
        $locationController = new LocationController();
        $locationController->index();
        break;

    case 'user_orders':
        // Call UserOrderController to handle user orders
        $userOrderController = new UserOrderController();
        $userOrderController->index();
        break;

    default:
        // Default route can redirect to home page or a 404 page
        echo "Page not found!";
        break;
}
