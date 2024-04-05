<?php
include('server_config.php');
// Check if the REQUEST_METHOD variable is set
if (!isset($_SERVER["REQUEST_METHOD"])) {
    die("The server is not providing the necessary server variables, such as \$_SERVER[\"REQUEST_METHOD\"], which are typically populated by the server environment.");
}

// Check if the dbConnect class is already defined
if (!class_exists('dbConnect')) {
    class dbConnect {
        private $conn = null;
        private $host = 'localhost';
        private $dbname = 'web'; // Update with your actual database name
        private $username = 'root'; // Update with your actual database username
        private $password = ''; // Update with your actual database password

        // Constructor
        public function __construct() {
            try {
                // Create a connection when the object is created
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $pdoe) {
                // Stop the application if it fails to connect to the database
                die("Could not connect to the database {$this->dbname}: " . $pdoe->getMessage());
            }
        }

        // Method to connect to the database
        public function connectDB() {
            return $this->conn;
        }
    }
}

// Create a new instance of dbConnect to establish a database connection
$dbConnection = new dbConnect();

// Get the database connection
$conn = $dbConnection->connectDB();
?>
