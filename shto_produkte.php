<?php
// Krijimi i lidhjes me bazën e të dhënave
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kontrolloni nëse është dorëzuar forma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Merrni vlerat e dhëna nga forma
    $product_name = $_POST['product_name'];
    $product_price = $_POST['price'];
    $description = $_POST['description'];
    $image_url=$_POST['image_url'];

    // Shto produktin në bazën e të dhënave
    $sql = "INSERT INTO products (product_name, price, description, image_url) 
            VALUES ('$product_name', '$product_price', '$description','$image_url')";

    if (mysqli_query($conn, $sql)) {
        echo "Produkti u shtua me sukses.";
        // Ridrejto tek faqja products.php
        header("Location: products.php");
        exit(); // Siguro që skripti të ndalet pasi të kryhet ridrejtimi
    } else {
        echo "Gabim gjatë shtimit të produktit: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
