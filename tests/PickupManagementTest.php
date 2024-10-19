<?php

use PHPUnit\Framework\TestCase;

class PickupManagementTest extends TestCase
{
    protected $db;

    // Setup method to mock the database connection
    protected function setUp(): void
    {
        $this->db = $this->createMock(mysqli::class);
    }

    // Test fetching uncollected locations
    public function testFetchUncollectedLocations()
    {
        // Mock the result set with some test data
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturn(
            [
                'pickup_id' => 'pickup_123',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'address' => '123 Main St',
                'latitude' => '6.9271',
                'longitude' => '79.8612',
                'collected' => 0
            ]
        );

        // Mock the query method to return the mocked result
        $this->db->method('query')->willReturn($mockResult);

        // Simulate the SQL query for uncollected locations
        $sql = "SELECT * FROM waste_pickups WHERE collected = 0";
        $result = $this->db->query($sql);

        // Assert that the fetched result matches the mock data
        $this->assertEquals('pickup_123', $result->fetch_assoc()['pickup_id']);
        $this->assertEquals(0, $result->fetch_assoc()['collected']);
    }

    // Test fetching collected locations
    public function testFetchCollectedLocations()
    {
        // Mock the result set with some test data
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturn(
            [
                'pickup_id' => 'pickup_456',
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'address' => '456 Elm St',
                'latitude' => '6.9271',
                'longitude' => '79.8612',
                'collected' => 1
            ]
        );

        // Mock the query method to return the mocked result
        $this->db->method('query')->willReturn($mockResult);

        // Simulate the SQL query for collected locations
        $sql = "SELECT * FROM waste_pickups WHERE collected = 1";
        $result = $this->db->query($sql);

        // Assert that the fetched result matches the mock data
        $this->assertEquals('pickup_456', $result->fetch_assoc()['pickup_id']);
        $this->assertEquals(1, $result->fetch_assoc()['collected']);
    }

    // Test marking a location as collected
    public function testMarkAsCollected()
    {
        // Mock the mysqli_stmt object
        $mockStmt = $this->createMock(mysqli_stmt::class);
    
        // Expect the bind_param() method to be called on the mock statement
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with($this->equalTo('ds'), $this->anything(), $this->anything());
    
        // Expect the execute() method to return true
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);
    
        // Mock the prepare() method to return the mocked statement
        $this->db->expects($this->once())
                 ->method('prepare')
                 ->willReturn($mockStmt);
    
        // Simulate form data for marking as collected
        $pickupId = 'pickup_123';
        $latitude = '6.9271';
        $longitude = '79.8612';
        $weight = '50.00';
    
        // Perform the SQL query and execute the statement
        $sql = "UPDATE waste_pickups SET weight = ?, collected = 1 WHERE pickup_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ds', $weight, $pickupId);
    
        // Assert that the execute() method was called successfully
        $this->assertTrue($stmt->execute());
    }
    

    // Test QR code validation and collection update
    public function testQrCodeValidation()
    {
        // Mock the mysqli_stmt object
        $mockStmt = $this->createMock(mysqli_stmt::class);
    
        // Expect the bind_param() method to be called on the mock statement
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with($this->equalTo('dds'), $this->anything(), $this->anything(), $this->anything());
    
        // Expect the execute() method to return true
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);
    
        // Mock the get_result() to return a mock mysqli_result object
        $mockResult = $this->createMock(mysqli_result::class);
    
        // Mock fetch_assoc() method to return data
        $mockResult->method('fetch_assoc')->willReturn([
            'pickup_id' => 'pickup_123',
            'latitude' => '6.9271',
            'longitude' => '79.8612'
        ]);
    
        // Mock the get_result() method to return the mocked result
        $mockStmt->method('get_result')->willReturn($mockResult);
    
        // Mock the prepare() method to return the mocked statement
        $this->db->expects($this->once())
                 ->method('prepare')
                 ->willReturn($mockStmt);
    
        // Simulate form data for scanning the QR code
        $latitude = '6.9271';
        $longitude = '79.8612';
        $pickupId = 'pickup_123';
    
        // Perform the SQL query and execute the statement
        $sql = "SELECT * FROM waste_pickups WHERE latitude = ? AND longitude = ? AND pickup_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('dds', $latitude, $longitude, $pickupId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Assert that fetch_assoc() returned the correct data
        $this->assertEquals('pickup_123', $result->fetch_assoc()['pickup_id']);
    }
    
}
