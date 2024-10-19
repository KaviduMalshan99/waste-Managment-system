// controllers/WastePickupController.php
<?php
include './server/db_connect1.php';
include './models/WastePickupModel.php';

class WastePickupController {
    private $model;

    public function __construct($conn) {
        $this->model = new WastePickupModel($conn);
    }

    public function handleRequest($pickupId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $weight = $_POST['weight'];

            // Verify the pickup details
            $result = $this->model->verifyPickup($latitude, $longitude, $pickupId);

            if ($result->num_rows > 0) {
                // Update the pickup
                $this->model->updatePickup($weight, $pickupId);

                // Success message and sound
                echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var successAudio = document.getElementById('successAudio');
                        successAudio.oncanplaythrough = function() {
                            successAudio.play();
                            setTimeout(function() {
                                if (confirm('Waste bin updated successfully! Click OK to return to the map.')) {
                                    window.location.href = 'collector_map.php';
                                }
                            }, 500);
                        };
                    });
                </script>";
            } else {
                // Error message
                echo "<script>alert('Error: Location coordinates or Pickup ID do not match. Please try again.');</script>";
            }
        }
    }
}
