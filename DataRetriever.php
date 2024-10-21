<?php

class DataRetriever
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetchWasteData()
    {
        $sql = "SELECT cp.package_id, pt.package_name, COUNT(DISTINCT cp.user_id) AS user_count
                FROM customer_packages cp
                JOIN main_package_types pt ON cp.package_id = pt.id
                GROUP BY cp.package_id, pt.package_name;";

        $result = $this->conn->query($sql);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
