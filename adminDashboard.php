<?php
include('config.php');
include('RedirectService.php');

session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: adminPage.php');
    exit();
}

// Redirect based on user role
RedirectService::redirectToDashboard($_SESSION['role']);
?>
