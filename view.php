<?php
session_start();
include('session_manager.php');
class HistoryController {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Create database connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function displayHistory() {
        // SQL query to select actions from the history table
        $query = "SELECT * FROM historiku";
        $result = $this->conn->query($query);

        // Display actions from history on the page if there are results
        if ($result->num_rows > 0) {
            echo "<h2>Historiku i Veprimeve</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "Përdoruesi ID: " . $row['perdorues_id'] . " - Veprimi: " . $row['veprimi'] . " - Data: " . $row['data'];
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='no-results'>Nuk ka veprime të regjistruara në historik.</p>";
        }
    }

    public function closeConnection() {
        // Close the database connection
        $this->conn->close();
    }
}

// Check if session is not started and start one if not
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if session exists and if user is an administrator
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page if the user is not an administrator
    header("Location: loginRegister.php");
    exit; // Exit the script to prevent further code execution
}

// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Create HistoryController instance
$historyController = new HistoryController($servername, $username, $password, $dbname);

// Display history
$historyController->displayHistory();

// Close the database connection
$historyController->closeConnection();
?>
