<?php
// Include the configuration file
include('config.php');
include('session_manager.php');
class ProductManager {
    private $conn;

    // Constructor to establish the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to update product statistics
    public function updateProductStatistics($id, $action) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row[$action] + 1;

            $updateSql = "UPDATE products SET $action = ? WHERE id = ?";
            $stmt = $this->conn->prepare($updateSql);
            $stmt->bind_param("ii", $count, $id);
            $stmt->execute();
        } else {
            echo "Product not found.";
        }
    }

    // Method to display products
    public function displayProducts($products, $category) {
        echo "<h2>Top $category products</h2>";

        if (!empty($products)) {
            echo "<div class='products'>";
            foreach ($products as $product) {
                $imageSrc = $product['image_url'];
                echo "<div class='product-card'>";
                echo "<img class='product-image' src='$imageSrc' alt='{$product['product_name']}'>";
                echo "<div class='product-details'>";
                echo "<h3 class='product-title'>{$product['product_name']}</h3>";
                echo "<p class='product-price'>$ {$product['price']}</p>";
                echo "<button class='buy-button' onclick='redirectToProduct(" . $product['id'] . ")'>Buy Now</button>";
                echo "</div></div>";
            }
            echo "</div>";
        } else {
            echo "<p>No $category products found.</p>";
        }
    }

    // Method to get top products
    public function getTopProducts() {
        $sql = "SELECT * FROM products ORDER BY watch_count DESC LIMIT 5";
        $result = $this->conn->query($sql);

        if (!$result) {
            echo "Error: " . $this->conn->error;
            return [];
        }

        $topProducts = [];
        while ($row = $result->fetch_assoc()) {
            $topProducts[] = $row;
        }

        return $topProducts;
    }

    // Method to close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    $errorInfo = $conn->errorInfo(); // Fetch error info
    die("Connection failed: " . $errorInfo[2]); // Display error message
}
// Create an instance of the ProductManager class
$productManager = new ProductManager($conn);

// Get the most watched products
$mostWatchedProducts = $productManager->getTopProducts();

// Get the most bought products
$mostBoughtProducts = $productManager->getTopProducts();

// Get the most liked products
$mostLikedProducts = $productManager->getTopProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="./css/products.css" />
    <link rel="stylesheet" href="./css/styles.css" />
    <title>Products</title>
</head>

<body>

    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Products Section -->
    <section class="ProductsSection">
        <h1>Our products</h1>
        <div class="products">
            <?php $productManager->displayProducts($mostWatchedProducts, 'most watched'); ?>
            <?php $productManager->displayProducts($mostBoughtProducts, 'most bought'); ?>
            <?php $productManager->displayProducts($mostLikedProducts, 'most liked'); ?>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include('footer.php'); ?>

    <script>
        function redirectToProduct(productId) {
            var newURL = 'http://localhost/d/product.php?id=' + productId;
            window.location.href = newURL;
        }
    </script>
</body>

</html>

<?php
// Close the database connection
$productManager->closeConnection();
?>
