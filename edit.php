<?php
include('Session.php');
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Product {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProductById($id) {
        // Prepare SQL statement
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        // Bind parameter and execute statement
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Get result
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if product exists
        if (!$product) {
            return false; // Product not found
        }

        return $product;
    }
}

// Create a new instance of Product class
$product = new Product($conn);

// Check if a product ID is provided in the URL
if (!isset($_GET['id'])) {
    // If product ID is not provided, show an error message and stop execution
    echo "Error: Product ID is not provided.";
    exit();
}

$id = $_GET['id'];

// Retrieve product information from the database
$productDetails = $product->getProductById($id);

if (!$productDetails) {
    // If no product found with the provided ID, show an error message and stop execution
    echo "Error: Product not found.";
    exit();
}

// Fetch product details
$product_id = $productDetails['id']; // Fetch product ID
$product_name = $productDetails['name']; // Corrected column name
$price = $productDetails['price'];
$description = $productDetails['description'];
$image_url = $productDetails['image_url'];

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
<?php
include('header.php');?>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $product_id; ?>"> <!-- Include product ID as a hidden field -->
            
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product_name; ?>" required>
            
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
