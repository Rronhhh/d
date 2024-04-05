<?php
include('Session.php'); // Include Session class
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('product_manager.php'); // Include ProductManager class

// Ensure $conn is defined and initialized
if (!isset($conn)) {
    die("Connection is not established.");
}

$product_manager = new ProductManager($conn); // Pass $conn to the ProductManager class constructor

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Here, you can perform actions with the form data, like saving to a database.

    // Send a response back to the frontend
    $response = ['status' => 'success', 'message' => 'Form submitted successfully'];
    echo json_encode($response);
    exit;
}

if (isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $role = true;
} else {
    $role = false;
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Document</title>
</head>

<body>
<?php include('header.php'); ?>
  <section class="FirstSection">
    <div class="BannerContainer">
      <div class="Banner-first-div">
        <h1>MobileShop</h1>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste
          voluptatum doloribus suscipit itaque, recusandae consectetur. Ipsam
          et reiciendis nihil fugit.
        </p>
      </div>
      <div class="Banner-second-div"><img src="assets/iphone13.avif" /></div>
    </div>
  </section>
  <!-- <section class="ProductsSection">
    <h1>Our on <span>sale</span> products</h1>
    <div class="products">
    <div class="products">
   
     
    </div>

      
      </div>
   
    <button class="show-all-button" onclick="window.location.href='display_products.php'">
      Show All Products
    </button>
  </section> -->
  <section class="TeamSection">
    <div class="team">
      <img src="assets/team.webp" />
      <div>
        <p>About us</p>
        <h1>MobileShop STORY</h1>
        <p>
          Mollyjogger™ is an authentic American heritage brand, based in the
          <br />
          Ozark Mountains, celebrating the region’s unique history of outdoor
          <br />
          recreation, sporting and folklore.
        </p>
      </div>
    </div>
  </section>
  <section class="SecondSection">
    <div class="HomeCards">
      <a href="#">
        <div>
          <!-- <img src="assets/pexels-photo-404280.webp" /> -->
          <h1>Shop Phones.</h1>
          <p>Discover cutting-edge smartphones for every lifestyle.</p>
        </div>
      </a>

      <a href="#">
        <div>
          <!-- <img src="assets/mobilecase.jpeg" /> -->
          <h1>Shop Cases.</h1>
          <p>Protect your device with stylish and durable phone cases.</p>
        </div>
      </a>
      <a href="#">
        <div>
          <!-- <img src="assets/headphones.webp" /> -->
          <h1>Shop Headphones.</h1>
          <p>
            Immerse yourself in premium audio experiences with our headphones.
          </p>
        </div>
      </a>
      <a href="#">
        <div>
          <!-- <img src="assets/smartwatch.webp" /> -->
          <h1>Shop SmartWatches.</h1>
          <p>Stay connected and stylish with our range of smartwatches.</p>
        </div>
      </a>
      <a href="#">
        <div>
          <!-- <img src="assets/charger.jpeg" /> -->
          <h1>Shop Chargers.</h1>
          <p>Power up your devices with our reliable and fast chargers.</p>
        </div>
      </a>
      <a href="#">
        <div>
          <!-- <img src="assets/phoneaccesories.jpeg" /> -->
          <h1>Shop Accesories.</h1>
          <p>Elevate your mobile experience with stylish accessories.</p>
        </div>
      </a>
    </div>
  </section>

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