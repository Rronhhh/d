<?php
include('session_manager.php');
class FormHandler {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        // Create a connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function handleFormSubmission() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from the form
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
            $message = isset($_POST['message']) ? $_POST['message'] : '';

            // Prepare and execute a query to insert data into the database
            $stmt = $this->conn->prepare("INSERT INTO form (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            $stmt->execute();
            $stmt->close();
            
            // Notify the user of successful form submission
            $success_message = "Form submitted successfully";
        }
    }

    public function closeConnection() {
        // Close the database connection
        $this->conn->close();
    }
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Instantiate the FormHandler object with database credentials
$formHandler = new FormHandler($servername, $username, $password, $dbname);
// Handle the form submission
$formHandler->handleFormSubmission();
// Close the database connection
$formHandler->closeConnection();
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

  <?php include('header.php'); ?>
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
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5868.717118853663!2d21.14406556355892!3d42.65375654962044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549ef3f69baacb%3A0xf864a269cc75e908!2s
        Dukagjini%20Residence!5e0!3m2!1sen!2s!4v1701978448506!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>

  <?php include('footer.php'); ?>

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
