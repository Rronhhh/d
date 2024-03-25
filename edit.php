<?php
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if a product ID is provided
if (!isset($_GET['id'])) {
    // If product ID is not provided, show an error message and stop execution
    echo "Error: Product ID is not provided.";
    exit();
}

$product_id = $_GET['id'];

// Retrieve product information from the database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // If no product found with the provided ID, show an error message and stop execution
    echo "Error: Product not found.";
    exit();
}

// Fetch product details
$row = $result->fetch_assoc();
$product_name = $row['product_name'];
$price = $row['price'];
$description = $row['description'];
$image_url = $row['image_url'];

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"> <!-- Include product ID as a hidden field -->
            
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" required>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $price; ?>" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $description; ?></textarea>
            
            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url" value="<?php echo $image_url; ?>" required>
            
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
