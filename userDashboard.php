<?php
include('Session.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: loginRegister');
    exit();
}

// Check if user is not admin
if ($_SESSION['role'] != 'admin') {
    header('Location: home.php');
    exit();
}

if ($_SESSION['role'] == 'admin') {
    header('Location: adminDashboard.php');
    exit();
}
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
