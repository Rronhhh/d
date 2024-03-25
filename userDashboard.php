<?php
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kontrollo sesionin nëse përdoruesi nuk është i kyçur, ridrejto në faqen e kyçjes
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Kontrollo nëse përdoruesi është admin
if ($_SESSION['role'] == 1) {
    header('Location: adminDashboard.php');
    exit();
}

// Ridrejto përdoruesin në faqen kryesore (home.php)
header('Location: home.php');
exit();
?>