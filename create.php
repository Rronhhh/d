<?php
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['image_url'])) {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];

        try {
            // Prepare SQL statement
            $sql = "INSERT INTO products (product_name, price, description, image_url) VALUES (?, ?, ?, ?)";
            $statement = $conn->prepare($sql);

            // Bind parameters
            $statement->bindParam(1, $product_name);
            $statement->bindParam(2, $price);
            $statement->bindParam(3, $description);
            $statement->bindParam(4, $image_url);

            // Execute statement
            if ($statement->execute()) {
                $message = "Product added successfully.";
            } else {
                $error = "Error adding product: " . $statement->errorInfo()[2];
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Error: All fields are required.";
    }

    if (isset($conn)) {
        $conn = null; // Close the connection
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
<?php
include('header.php');?>
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
