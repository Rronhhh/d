<?php
session_start();

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
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
<?php include('header.php'); ?>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>This is the admin dashboard. You can perform CRUD operations here.</p>

    <!-- Include your CRUD operation links here -->
    <ul>
        <li><a href="create.php">Create New Entry</a></li>
        <li><a href="view.php">View Entries</a></li>
        <li><a href="edit.php">Edit Entry</a></li>
        <li><a href="delete.php">Delete Entry</a></li>
    </ul>

  
</body>
</html>
