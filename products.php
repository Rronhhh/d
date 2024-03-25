<?php
include('config.php');

function updateProductStatistics($conn, $id, $action)
{
  $sql = "SELECT * FROM products WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row[$action] + 1;

    $updateSql = "UPDATE products SET $action = $count WHERE id = $id";
    $conn->query($updateSql);
  } else {
    // Handle the case where the product doesn't exist
  }
}
function displayProducts($products, $category)
{
  echo "<h2>Top $category products</h2>";

  if (!empty($products)) {
    echo "<div class='products'>";
    foreach ($products as $product) {
      $imageSrc = $product['image_url']; // Use the image URL from the database
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
function getTopProducts($conn, $category)
{
  $columnName = "`$category`";  // Enclose the category in backticks
  $sql = "SELECT * FROM products ORDER BY $columnName DESC LIMIT 5";
  $result = $conn->query($sql);

  if (!$result) {
    // Query failed, display error details
    echo "Error: " . $conn->error;
    return [];
  }

  $topProducts = [];
  while ($row = $result->fetch_assoc()) {
    $topProducts[] = $row;
  }

  return $topProducts;
}

$mostWatchedProducts = getTopProducts($conn, 'watch_count');
$mostBoughtProducts = getTopProducts($conn, 'buy_count');
$mostLikedProducts = getTopProducts($conn, 'like_count');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="./css/products.css" />
  <link rel="stylesheet" href="./css/./styles.css" />

  <title>Document</title>
</head>

<body>
 
    <nav>
      <div class="menu-icon">
        <span class="fas fa-bars"></span>
      </div>
      <div class="logo">CodingNepal</div>
      <div class="nav-items">
        <li><a href="./home.php">Home</a></li>
        <li><a href="./products.php">Products</a></li>
        <li><a href="./about.php">About</a></li>
        <!-- <li><a href="#">Blogs</a></li> -->
        <li><a href="./contactUs.php">Contact</a></li>
        <!-- <li><a href="#">Feedback</a></li> -->
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
 

  <section class="ProductsSection">
    <h1>Our products</h1>

    <div class="products">
      <?php displayProducts($mostWatchedProducts, 'most watched'); ?>
      <?php displayProducts($mostBoughtProducts, 'most bought'); ?>
      <?php displayProducts($mostLikedProducts, 'most liked'); ?>
    </div>
  </section>

  <section class="FooterSection">
    <!-- Your existing footer code -->
  </section>

  <script>
    const menuBtn = document.querySelector(".menu-icon span");
    const searchBtn = document.querySelector(".search-icon");
    const cancelBtn = document.querySelector(".cancel-icon");
    const items = document.querySelector(".nav-items");
    const form = document.querySelector("form");
    menuBtn.onclick = () => {
      items.classList.add("active");
      menuBtn.classList.add("hide");
      searchBtn.classList.add("hide");
      cancelBtn.classList.add("show");
    };
    cancelBtn.onclick = () => {
      items.classList.remove("active");
      menuBtn.classList.remove("hide");
      searchBtn.classList.remove("hide");
      cancelBtn.classList.remove("show");
      form.classList.remove("active");
      cancelBtn.style.color = "#ff3d00";
    };
    searchBtn.onclick = () => {
      form.classList.add("active");
      searchBtn.classList.add("hide");
      cancelBtn.classList.add("show");
    };
    function redirectToProduct(productId) {
    var newURL = 'http://localhost/dizajniwebit/product.php?id=' + productId;
    window.location.href = newURL;
  }
  </script>
</body>

</html>

<?php
$conn->close();
?>