<?php
include('config.php');

if(isset($_POST['id']) && !empty($_POST['id'])) {
  $id = $_POST['id'];

  // Here you would typically process the order, save it to the database, etc.

  // For demonstration purposes, let's assume the order is processed successfully
  $message = "Thank you for your order! Order ID: " . $id;
} else {
  // If product ID is not provided, show an error message
  $message = "Error: Product ID not provided.";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/./styles.css">
  <title>Order Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    h2 {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      color: #555;
      line-height: 1.6;
      margin-bottom: 20px;
    }
    .back-link {
      color: #007bff;
      text-decoration: none;
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
        <!-- <li><a href="#">Blogs</a></li> -->
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
    <h2>Order Confirmation</h2>
    <p><?php echo $message; ?></p>
    <a href="javascript:history.go(-1)" class="back-link">Go back</a>
  </div>
 
</body>
</html>