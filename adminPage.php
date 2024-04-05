<?php
include('Session.php');

// Start the session if required
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: loginRegister.php');
    exit();
}

// Check if user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: home.php');
    exit();
}

// Redirect to the admin dashboard
header('Location: adminDashboard.php');
exit();
?>
