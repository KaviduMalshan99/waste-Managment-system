<?php

use PHPUnit\Framework\TestCase;

class PickupRequestTest extends TestCase
{
    protected $db;

    protected function setUp(): void
    {
        // to mock database connection 
        // For example:
        $this->db = $this->createMock(mysqli::class);
    }

    // Test for email validation
    public function testEmailValidation()
    {
        // Positive case: valid email
        $validEmail = 'test@example.com';
        $this->assertTrue($this->isValidEmail($validEmail));

        // Negative case: invalid email
        $invalidEmail = 'invalid-email';
        $this->assertFalse($this->isValidEmail($invalidEmail));
    }

    // Helper function to check if email is valid
    private function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Test for required fields
    public function testRequiredFields()
    {
        // Positive case: All required fields are filled
        $formData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St',
            'post_code' => '12345',
            'email' => 'test@example.com'
        ];
        $this->assertTrue($this->checkRequiredFields($formData));

        // Negative case: missing required field (first_name)
        $formData['first_name'] = '';
        $this->assertFalse($this->checkRequiredFields($formData));
    }

    // Helper function to check if all required fields are filled
    private function checkRequiredFields($data)
    {
        return !empty($data['first_name']) && !empty($data['last_name']) && 
               !empty($data['address']) && !empty($data['post_code']) && 
               !empty($data['email']);
    }

    // Test for date and time availability in the database
    public function testDateAndTimeAvailability()
    {
        // Case 1: Date is already booked (so the query returns a result)
        $mockResult = $this->createMock(mysqli_result::class); // Create a mock result set
        
        // Expect the query to be called twice with different return values
        $this->db->expects($this->exactly(2)) // Expect query to be called exactly twice
                 ->method('query')
                 ->willReturnOnConsecutiveCalls($mockResult, false); // First call returns a result (booked), second returns false (available)
    
        $date = '2024-10-25';
        $time = '14:00';
    
        // Test when the date is booked
        $this->assertFalse($this->isDateAvailable($date, $time)); // Should return false because date is booked
    
        // Test when the date is available
        $this->assertTrue($this->isDateAvailable($date, $time)); // Should return true because date is available
    }
    
    

    // Helper function to check date availability
    private function isDateAvailable($date, $time)
    {
        // Check if date/time is booked using the mocked database
        $query = "SELECT * FROM waste_pickups WHERE pickup_date = '$date' AND pickup_time = '$time'";
        $result = $this->db->query($query); // This will use the mock
    
        return $result ? false : true; // If result is true (date booked), return false, otherwise true
    }
    
}

