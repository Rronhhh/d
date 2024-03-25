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
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/loginRegisterStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Login/Register Page</title>
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
      <li><a href="./loginRegister.php" class="loginregister">Login/Register</a></li>
    </div>
    <div class="search-icon">
      <span class="fas fa-search"></span>
    </div>
    <div class="cancel-icon">
      <span class="fas fa-times"></span>
    </div>
  </nav>

  <div class="container" id="loginContainer">
  <form action="login.php" method="post">
      <h2>Login</h2>
     
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required />

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required />

      <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="javascript:void(0);" onclick="toggleForms()">Register here</a></p>
  </div>

  <div class="container" id="registerContainer" style="display: none">
   <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="javascript:void(0);" onclick="toggleForms()">Login here</a></p>
  </div>

 
  <script>
    function toggleForms() {
      var loginContainer = document.getElementById("loginContainer");
      var registerContainer = document.getElementById("registerContainer");
      if (loginContainer.style.display === "none") {
        loginContainer.style.display = "block";
        registerContainer.style.display = "none";
      } else {
        loginContainer.style.display = "none";
        registerContainer.style.display = "block";
      }
    }
    const menuBtn = document.querySelector(".menu-icon span");
    const searchBtn = document.querySelector(".search-icon");
    const cancelBtn = document.querySelector(".cancel-icon");
    const items = document.querySelector(".nav-items");
    const form = document.querySelector("form");
    menuBtn.onclick = () => {
      items.classList.add("active");
      menuBtn.classList.add("hide");
      searchBtn.classList.add("hide");
      cancelBtn.classList.add("show");
    };
    cancelBtn.onclick = () => {
      items.classList.remove("active");
      menuBtn.classList.remove("hide");
      searchBtn.classList.remove("hide");
      cancelBtn.classList.remove("show");
      form.classList.remove("active");
      cancelBtn.style.color = "#ff3d00";
    };
    searchBtn.onclick = () => {
      form.classList.add("active");
      searchBtn.classList.add("hide");
      cancelBtn.classList.add("show");
    };
  </script>
</body>

</html>