<?php
// include('config.php'); // Include database connection
include('AuthService.php');// Include AuthService class
include('User.php'); // Include User class
include('functions.php');
// include('Session.php');

var_dump($_POST);

// Initialize AuthService with database connection
AuthService::init($conn);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If the form is for registration
    if (isset($_POST['register'])) {
        $username = sanitizeInput($_POST['username']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);
        $role = $_POST['role']; // Should be validated further

        // Register the user
        if (AuthService::registerUser(new User($username, $password, $email, $role))) {
            echo "Registration successful.";
            // Redirect to admin page if user is an admin
            if ($role === 'admin') {
                header("Location: adminPage.php");
            } else {
                // Redirect to home page or any other page
                header("Location: home.php");
            }
            exit();
        } else {
            echo "Registration failed.";
        }
    }
    // If the form is for login
    elseif (isset($_POST['login'])) {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        // Attempt to login the user
        if (AuthService::loginUser($username, $password)) {
            // Redirect to admin page if user is an admin
            $user = AuthService::getUserByUsername($username);
            if ($user && $user['role'] === 'admin') {
                header("Location: adminPage.php");
            } else {
                // Login successful, redirect to home page or dashboard
                header("Location: userDashboard.php");
            }
            exit();
        } else {
            // Login failed, display error message
            echo "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register Page</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/loginRegisterStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav>
        <div class="menu-icon">
            <span class="fas fa-bars"></span>
        </div>
        <div class="logo">MobilShop Titani</div>
        <div class="nav-items">
            <li><a href="./home.php">Home</a></li>
            <li><a href="./display_products.php">Products</a></li>
            <li><a href="./about.php">About Us</a></li>
            <li><a href="./contactUs.php">Contact US</a></li>
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
        <div class="login-form" id="loginContainer">
            <h2>Login</h2>
            <?php if (isset($login_error)) { ?>
                <p style="color: red;"><?php echo $login_error; ?></p>
            <?php } ?>
            <form action="loginRegister.php" method="post" onsubmit="return validateLogin()">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required />
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required />
                <button type="submit" name="login">Login</button>
            </form>
            <p>Don't have an account? <a href="javascript:void(0);" onclick="toggleForms()">Register here</a></p>
        </div>

        <div class="register-form" id="registerContainer" style="display: none">
            <h2>Register</h2>
            <form action="loginRegister.php" method="post" onsubmit="return validateRegister()">
                <label for="username">Username:</label>
                <input type="text" id="regUsername" name="username" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="regEmail" name="email" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="regPassword" name="password" required><br><br>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select><br><br>
                <button type="submit" name="register">Register</button>
            </form>
            <p>Already have an account? <a href="javascript:void(0);" onclick="toggleForms()">Login here</a></p>
        </div>
    </div>

    <script src="./js/registerLogin.js"></script>
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
    </script>
</body>

</html>
