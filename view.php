<?php

include('Session.php');

class HistoryController {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        try {
            // Create database connection using PDO
            $dsn = "mysql:host=$servername;dbname=$dbname";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // If connection fails, display error message and terminate script
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function displayHistory() {
        try {
            // SQL query to select actions from the history table
            $query = "SELECT * FROM historiku";
            $stmt = $this->conn->query($query);

            // Display actions from history on the page if there are results
            if ($stmt->rowCount() > 0) {
                echo "<h2>Historiku i Veprimeve</h2>";
                echo "<ul>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>";
                    echo "Përdoruesi ID: " . $row['perdorues_id'] . " - Veprimi: " . $row['veprimi'] . " - Data: " . $row['data'];
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='no-results'>Nuk ka veprime të regjistruara në historik.</p>";
            }
        } catch (PDOException $e) {
            // If query fails, display error message
            echo "Error: " . $e->getMessage();
        }
    }

    public function closeConnection() {
        // Close the database connection
        $this->conn = null;
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
