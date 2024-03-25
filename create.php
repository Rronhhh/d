<?php
// Include or require the config.php file
include('config.php');

// Check if a POST request is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both field and value for deletion are provided
    if (isset($_POST['field']) && isset($_POST['value'])) {
        // Get the field and value for deletion
        $field = $_POST['field'];
        $value = $_POST['value'];

        // SQL query to delete the product from the products table
        $sql = "DELETE FROM products WHERE $field = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("s", $value);

        if ($statement->execute()) {
            $message = "Product deleted successfully.";
        } else {
            $error = "Error deleting product: " . $conn->error;
        }

        // Close the prepared statement
        $statement->close();
    } else {
        // If not all necessary fields are provided, show an error message
        $error = "Error: Field and value for deletion are not provided correctly.";
    }

    // Close the database connection if it's set and valid
    if (isset($conn) && $conn instanceof mysqli) {
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 24px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    font-weight: bold;
    margin-bottom: 8px;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    height: 100px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 12px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <form method="post" action="">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            
            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url" required>
            
            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
