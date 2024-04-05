<?php
// Include the configuration file
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class ProductManager {
    private $conn;

    // Constructor to establish the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to update product statistics
    public function updateProductStatistics($id, $action) {
        // Your update logic here
    }

    // Method to get top products
    public function getTopProducts($limit) {
        $sql = "SELECT * FROM products ORDER BY watch_count DESC LIMIT $limit";
        $result = $this->conn->query($sql);

        if (!$result) {
            echo "Error: " . $this->conn->error;
            return [];
        }

        $topProducts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $topProducts[] = $row;
        }

        return $topProducts;
    }

   
}
?>
