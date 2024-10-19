<?php
include './server/db_connect1.php';
include './models/UserOrderModel.php';

class UserOrderController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new UserOrderModel($dbConnection);
    }

    public function getOrders($email) {
        return $this->model->getOrdersByEmail($email);
    }

    public function processPayment($postData) {
        if (!empty($postData['card_name']) && !empty($postData['card_number']) && 
            !empty($postData['expiry_date']) && !empty($postData['cvv']) && 
            is_numeric($postData['card_number']) && strlen($postData['cvv']) == 3) {
            return $this->model->updatePaymentStatus($postData['pickup_id']);
        } else {
            return false;
        }
    }

    public function reschedulePickup($postData) {
        return $this->model->reschedulePickup($postData['pickup_id'], $postData['new_pickup_date'], $postData['new_pickup_time']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new UserOrderController($conn);
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'pay') {
            if ($controller->processPayment($_POST)) {
                echo "<script>alert('Payment successful!'); window.location.href = 'user_orders.php';</script>";
            } else {
                echo "<script>alert('Invalid payment details. Please try again.');</script>";
            }
        } elseif ($_POST['action'] == 'reschedule') {
            $controller->reschedulePickup($_POST);
            echo "<script>alert('Pickup rescheduled successfully.'); window.location.href = 'user_orders.php';</script>";
        }
    }
}
?>
