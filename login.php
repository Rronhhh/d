<?php
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (loginUser($username, $password)) {
        if ($_SESSION['role'] == 1) {
            header("Location: adminDashboard.php");
        } else {
            header("Location: userDashboard.php");
        }
        exit();
    } else {
        echo "Incorrect username or password.";
    }
}
?>