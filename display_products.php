<?php
include('config.php');
include('Session.php');
include('product_manager.php');
include('header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title> 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .ProductsSection {
            max-width: 1500px;
            padding: 20px;
        }

        .products {
            margin-top: 100px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .product {
            width: 25%;
            height: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* overflow: hidden; */
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            padding: 20px;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .product img {
            margin-bottom: 15px;
            width: 300px;
            height: 300px;
            object-fit: cover;
            object-position: center;
        }

        .product-details {
            padding: 16px;
            text-align: center;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 8px 0;
        }

        .product-price {
            color: #e44d26;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .buy-button {
            background-color: #e44d26;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            width: 100%;
            font-size: 1rem;
            transition: background-color 0.3s ease-in-out;
        }

        .buy-button:hover {
            background-color: #c5371d;
        }
    </style>
</head>
<body>
    
<?php
// Create a new instance of dbConnect to establish a database connection
$dbConnection = new dbConnect();
$conn = $dbConnection->connectDB();

// Check if the connection is successful
if (!$conn) {
    // Handle connection error
    die("Connection failed: Unable to connect to the database");
}

// Create an instance of the ProductManager class
$productManager = new ProductManager($conn);

// Display products
$products = $productManager->getTopProducts(10); // Change the limit as needed
if (!empty($products)) {
    echo "<div class='products'>";
    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<img src='" . $product['image_url'] . "' alt='" . $product['name'] . "' />";
        echo "<h3>" . $product['name'] . "</h3>";
        echo "<p>Price: $" . $product['price'] . "</p>";
        echo "<p>Description: " . $product['description'] . "</p>";
        
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>No products found.</p>";
}

// Close the database connection
$conn = null
?>
</body>
</html>
