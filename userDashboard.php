<?php
include('config.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: loginRegister');
    exit();
}

// Check if user is not admin
if ($_SESSION['role'] != 'admin') {
    header('Location: userDashboard.php');
    exit();
}

// Page content for admin
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>User Dashboard</title>
    <!-- Styles -->
</head>
<body>
    <!-- Navigation -->
    <!-- Content -->
</body>
</html>
