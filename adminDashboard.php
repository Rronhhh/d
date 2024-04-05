<?php
include('Session.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if $_SESSION['id'] is set and not null
if (!isset($_SESSION['id'])) {
    // Redirect to login page or perform other actions
    header('Location: loginRegister.php');
    exit();
}

// Check if $_SESSION['username'] is set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your CSS links here -->
    <style>
       ul.crud-links {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        ul.crud-links li {
            margin: 10px;
        }

        ul.crud-links a {
            display: block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        ul.crud-links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>This is the admin dashboard. You can perform CRUD operations here.</p>

    <!-- Include your CRUD operation links here -->
    <ul class="crud-links">
        <li><a href="create.php">Create New Entry</a></li>
        <li><a href="view.php">View Entries</a></li>
        <li><a href="edit.php">Edit Entry</a></li>
        <li><a href="delete.php">Delete Entry</a></li>
    </ul>
</body>
</html>
