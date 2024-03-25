<?php
include('config.php');

// Kontrolloni nëse forma është dorëzuar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Merren të dhënat nga forma
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Krijoni një lidhje me bazën e të dhënave
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kontrolloni lidhjen
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Përgatisni dhe ekzekutoni query-n për të futur të dhënat në bazën e të dhënave
    $stmt = $conn->prepare("INSERT INTO form (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    $stmt->execute();
    $stmt->close();
    
    // Njofto përdoruesin për suksesin e dërgimit të mesazhit
    $success_message = "Form submitted successfully";

    // Mbyll lidhjen me bazën e të dhënave
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Add the Font Awesome CDN -->
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/contactUsStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-e3a2Xl8ZlSjo/UMZbBMArK5sdzO+4fCI5zOBE3zKU/yJe3DB5Vv6PVPQE5esSc3f" crossorigin="anonymous">
 
  <title>Contact Us</title>
</head>

<body>

  <header>
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
        <li><a href="./loginRegister.php" class="loginregister">Login/Register</a></li>
      </div>
      <div class="search-icon">
        <span class="fas fa-search"></span>
      </div>
      <div class="cancel-icon">
        <span class="fas fa-times"></span>
      </div>

  </header>
        <div class="Titulli"><H1>Contact Form</H1></div>
  
      <div class="container">
    <form id="contactForm" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" maxlength="255" required></textarea>

        <button type="submit" onclick="showPopup()">Send Message</button>
    </form>
    <div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <p>Form submitted successfully!</p>
    </div>
</div>
    <!-- <div class="success-message" id="successMessage" style="display: none;">Form submitted successfully</div> -->
    <div class="contact-info">
      <p>Info</p>
      <p><i class="fas fa-phone"></i> +123456789</p>
      <p><i class="fas fa-envelope"></i> info@example.com</p>
      <p><i class="fas fa-globe"></i> www.example.com</p>
    </div>
  </div>

  <div class="map-box">
    <!-- Embed your map here, using an iframe or other method -->
    <div class="map">
      <!-- Replace the following iframe with your actual map embed code -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5868.717118853663!2d21.14406556355892!3d42.65375654962044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549ef3f69baacb%3A0xf864a269cc75e908!2sDukagjini%20Residence!5e0!3m2!1sen!2s!4v1701978448506!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>

  <section class="FooterSection">
    <footer class="footer-distributed">
      <div class="footer-centered">
        <div class="footer-left">

          <h3>Mobile<span>Shop</span></h3>

          <p class="footer-links">
            <a href="./home.html" class="link-1">Home</a>

            <a href="#">Blog</a>

            <a href="#">Pricing</a>

            <a href="./about.html">About</a>

            <a href="#">Faq</a>

            <a href="./contactUs.html">Contact</a>
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
            <p><a href="mailto:support@company.com">support@company.com</a></p>
          </div>

        </div>

        <div class="footer-right">

          <p class="footer-company-about">
            <span>About the company</span>
            Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
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

  <!-- Add the Font Awesome script -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha384-GLhlTQ8iNl7t3S3zgnLjWPp0GT+POeL+U/LvH1+qHY5AZLZ5PqVvN7p+aL6dzGg" crossorigin="anonymous"></script>

  <script>
    function validateForm() {
      // Simple email validation using a regular expression
      var emailInput = document.getElementById('email');
      var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

      if (!emailRegex.test(emailInput.value)) {
        alert('Please enter a valid email address.');
        return false;
      }

      // Additional validation logic can be added here

      return true;
    }
    function showPopup() {
    console.log("Popup is shown!");
    var popup = document.getElementById('popup');
    popup.style.display = 'block';
}

function closePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}
    function showSuccessMessage() {
      var successMessage = document.getElementById('successMessage');
      successMessage.style.display = 'block';

      setTimeout(function() {
        successMessage.style.display = 'none';
      }, 300000); // Hide the message after 10 seconds (10000 milliseconds)
    }

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
  </script>

</body>

</html>
