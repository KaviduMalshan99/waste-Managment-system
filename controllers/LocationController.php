<?php
class LocationController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Retrieve uncollected locations from the model
    public function getUncollectedLocations() {
        return $this->model->getUncollectedLocations();
    }

    // Retrieve collected locations from the model
    public function getCollectedLocations() {
        return $this->model->getCollectedLocations();
    }
}
?>
