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
if ($_SESSION['role'] != 1) {
    header('Location: userDashboard.php');
    exit();
}

// Përmbajtja e faqes së adminit
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/./styles.css">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .welcome-message {
            margin-bottom: 20px;
            text-align: center;
        }
        .admin-links {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        .admin-links li {
            display: inline-block;
            margin-right: 10px;
        }
        .admin-links li:last-child {
            margin-right: 0;
        }
        .admin-links a {
            color: #007bff;
            text-decoration: none;
        }
        .admin-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav>
    <div class="menu-icon">
      <span class="fas fa-bars"></span>
    </div>
    <div class="logo">CodingNepal</div>
    <div class="nav-items">
      <li><a href="./home.php">Home</a></li>
      <li><a href="./products.php">Products</a></li>
      <li><a href="./about.php">About</a></li>
      
     
      <li><a href="./contactUs.php">Contact</a></li>
      <!-- <li><a href="#">Feedback</a></li> -->
      <li>
        <a href="./loginRegister.php" class="loginregister">Login/Register</a>
      </li>
    </div>
    <div class="search-icon">
      <span class="fas fa-search"></span>
    </div>
    <div class="cancel-icon">
      <span class="fas fa-times"></span>
    </div>
  </nav>
    <div class="container">

        <h1>Welcome Admin, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>!</h1>
        <p class="welcome-message">You are logged in as an admin.</p>
        <!-- Admin Links -->
        <ul class="admin-links">
            <li><a href="./shto_produkte.php">Shto Produkte</a></li>
            <li><a href="delete.php">Fshij Produkte</a></li>
            <li><a href="view.php">Historiku</a></li>
        </ul>
    </div>
</body>
</html>