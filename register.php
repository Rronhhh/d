<?php
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $role = $_POST['role']; // Tani duhet të validohet në formë më të rreptë

    if ($role != 'admin') {
        $role = 'user';
    }

    if (registerUser($username, $password, $email, $role)) {
        echo "Registration successful.";
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
?>