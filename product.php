<?php
include('config.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];

  // Kërko produktin në bazën e të dhënave dhe merr informacionin e tij
  $sql = "SELECT * FROM products WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/./styles.css" />

  <title><?php echo $product['product_name']; ?></title>
 
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 36px;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }
    img {
      display: block;
      margin: 0 auto 20px;
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    p {
      font-size: 18px;
      color: #555;
      line-height: 1.6;
      margin-bottom: 15px;
    }
    form {
      text-align: center;
    }
    input[type="submit"] {
      padding: 15px 40px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 18px;
      transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    /* Responsive Styles */
    @media only screen and (max-width: 600px) {
      .container {
        padding: 10px;
      }
      h1 {
        font-size: 28px;
      }
      input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
      }
    }
  </style>
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
  <div class="container">
    <h1><?php echo $product['product_name']; ?></h1>
    <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>">
    <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
    <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
    
    <!-- Forma për porosinë -->
    <form action="order.php" method="post">
      <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
      <input type="submit" value="Order Now">
    </form>
  </div>
  <section class="FooterSection">
    <footer class="footer-distributed">
      <div class="footer-centered">
        <div class="footer-left">
          <h3>Mobile<span>Shop</span></h3>

          <p class="footer-links">
            <a href="#" class="link-1">Home</a>

            <a href="#">Blog</a>

            <a href="#">Pricing</a>

            <a href="./about.html">About</a>

            <a href="#">Faq</a>

            <a href="#">Contact</a>
          </p>

          <p class="footer-company-name">Company Name © 2015</p>
        </div>

        <div class="footer-center">
          <div>
            <i class="fa fa-map-marker"></i>
            <p><span>444 S. Cedros Ave</span> Solana Beach, California</p>
          </div>

          <div>
            <i class="fa fa-phone"></i>
            <p>+1.555.555.5555</p>
          </div>

          <div>
            <i class="fa fa-envelope"></i>
            <p>
              <a href="mailto:support@company.com">support@company.com</a>
            </p>
          </div>
        </div>

        <div class="footer-right">
          <p class="footer-company-about">
            <span>About the company</span>
            Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce
            euismod convallis velit, eu auctor lacus vehicula sit amet.
          </p>

          <div class="footer-icons">
            <!-- <a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a> -->
          </div>
        </div>
      </div>
    </footer>
  </section>
</body>
</html>


<?php
  } else {
    echo "Product not found.";
  }
} else {
  echo "Product ID not provided.";
}
$conn->close();
?>
