<?php

use PHPUnit\Framework\TestCase;

class OrderPageTest extends TestCase
{
    protected $db;

    // Setup mock DB connection
    protected function setUp(): void
    {
        $this->db = $this->createMock(mysqli::class);
    }

    // Test price calculation based on waste_type
    public function testPriceCalculation()
    {
        $weight = 50; // 50kg of waste

        // Waste type 1: 150/kg
        $wasteType1Price = $this->calculatePrice(1, $weight);
        $this->assertEquals(150 * $weight, $wasteType1Price);

        // Waste type 2: 300/kg
        $wasteType2Price = $this->calculatePrice(2, $weight);
        $this->assertEquals(300 * $weight, $wasteType2Price);

        // Waste type 3: 450/kg
        $wasteType3Price = $this->calculatePrice(3, $weight);
        $this->assertEquals(450 * $weight, $wasteType3Price);
    }

    // Helper method to calculate the price based on waste_type and weight
    private function calculatePrice($wasteType, $weight)
    {
        if ($wasteType == 1) return 150 * $weight;
        if ($wasteType == 2) return 300 * $weight;
        if ($wasteType == 3) return 450 * $weight;
        return 0;
    }

    // Test "Pay Now" functionality with valid card details
    public function testPayNowSuccess()
    {
        // Simulate form data for payment
        $_POST = [
            'action' => 'pay',
            'pickup_id' => 'pickup_123',
            'card_name' => 'Vihan Gamaka',
            'card_number' => '1234567812345678',
            'expiry_date' => '12/25',
            'cvv' => '123'
        ];
    
        // Mock the prepare() method to return a mock statement
        $mockStmt = $this->createMock(mysqli_stmt::class);
        
        // Ensure bind_param is called once
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with($this->equalTo('s'), $this->anything());
    
        // Ensure execute is called and returns true
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);
    
        // Mock the prepare() method to return the mocked statement
        $this->db->method('prepare')
                 ->willReturn($mockStmt);
    
        // Simulate the payment process
        $output = $this->simulatePayment();
    
        // Assert that the payment was successful
        $this->assertStringContainsString('Payment successful', $output);
    }
    

    // Test "Pay Now" functionality with invalid card details
    public function testPayNowInvalidDetails()
    {
        // Simulate form data with invalid card number (less than 16 digits)
        $_POST = [
            'action' => 'pay',
            'pickup_id' => 'pickup_123',
            'card_name' => 'Vihan Gamaka',
            'card_number' => '12345678',  // Invalid
            'expiry_date' => '12/25',
            'cvv' => '123'
        ];
    
        // Simulate the payment process
        $output = $this->simulatePayment();
    
        // Assert that the output contains the error message
        $this->assertStringContainsString('Invalid payment details', $output);
    }
    

    // Helper method to simulate the payment process
    private function simulatePayment()
    {
        // Simulate a POST request
        $_SERVER['REQUEST_METHOD'] = 'POST';
    
        // Start output buffering to capture the echo statements
        ob_start();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'pay') {
            $cardName = $_POST['card_name'];
            $cardNumber = $_POST['card_number'];
            $expiryDate = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];
    
            // Basic validation
            if (empty($cardName) || empty($cardNumber) || empty($expiryDate) || empty($cvv) || strlen($cardNumber) != 16 || strlen($cvv) != 3) {
                echo "Invalid payment details. Please try again.";
            } else {
                // Mock database update
                $pickupId = $_POST['pickup_id'];
                $update_sql = "UPDATE waste_pickups SET paid = 1 WHERE pickup_id = ?";
                $stmt = $this->db->prepare($update_sql);
    
                if ($stmt) {
                    $stmt->bind_param("s", $pickupId);
                    if ($stmt->execute()) {
                        echo "Payment successful!";
                    } else {
                        echo "Payment failed. Please try again.";
                    }
                }
            }
        }
    
        // Return the buffered output
        return ob_get_clean();
    }
    

    // Test reschedule functionality
    public function testRescheduleOrder()
    {
        // Simulate form data for rescheduling
        $_POST = [
            'action' => 'reschedule',
            'pickup_id' => 'pickup_123',
            'new_pickup_date' => '2024-11-01',
            'new_pickup_time' => '12:30'
        ];
    
        // Mock the prepare() method to return a mock statement
        $mockStmt = $this->createMock(mysqli_stmt::class);
    
        // Ensure bind_param is called once with correct values
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with($this->equalTo('sss'), $this->anything(), $this->anything(), $this->anything());
    
        // Ensure execute is called only once and returns true
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);
    
        // Mock the prepare() method to return the mocked statement
        $this->db->method('prepare')
                 ->willReturn($mockStmt);
    
        // Call simulateReschedule() to trigger the test
        $this->simulateReschedule();
    
        // No need to call execute() manually here; the helper method does it.
        // We just check that the mock expectations are met.
    }
    
    
    

    // Helper method to simulate reschedule process
    private function simulateReschedule()
    {
        // Simulate a POST request
        $_SERVER['REQUEST_METHOD'] = 'POST';
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'reschedule') {
            $pickupId = $_POST['pickup_id'];
            $newDate = $_POST['new_pickup_date'];
            $newTime = $_POST['new_pickup_time'];
    
            // Mock SQL update query
            $update_sql = "UPDATE waste_pickups SET pickup_date = ?, pickup_time = ? WHERE pickup_id = ?";
            $stmt = $this->db->prepare($update_sql);
    
            if ($stmt) {
                $stmt->bind_param("sss", $newDate, $newTime, $pickupId);
                $stmt->execute();  // This should only be called once
            }
        }
    }
    

}
