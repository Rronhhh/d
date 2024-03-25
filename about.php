<?php
include('session_manager.php');?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/aboutStyle.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>About Us - CodingNepal</title>

</head>

<body>
<?php include('header.php'); ?>
  

  <!-- About Section -->
  <section class="about-section">
    <h2>About MobileShop</h2>
    <img class="team-photo" src="./assets/team.webp" alt="" srcset="" />
    <div class="about-text">
      <p>
        Welcome to MobileShop, your ultimate destination for all things tech
        and innovation.
      </p>
      <p>
        Established with a vision to redefine the mobile shopping experience,
        MobileShop is not just a store; it's a journey into the world of
        cutting-edge technology and style. Our mission is to bring you the
        latest smartphones, accessories, and gadgets that seamlessly blend
        into your dynamic lifestyle.
      </p>
      <p>
        At MobileShop, we believe in the power of innovation and the impact it
        can have on our lives. That's why we carefully curate our collection
        to feature products that embody the perfect synergy of form and
        function. Each item in our inventory is selected to elevate your
        mobile experience and keep you ahead of the technological curve.
      </p>
      <p>
        Our passionate team at MobileShop consists of tech enthusiasts,
        trendsetters, and customer service professionals who are dedicated to
        providing you with an unparalleled shopping experience. From answering
        your queries to ensuring swift deliveries, we're here to make your
        journey with MobileShop seamless and enjoyable.
      </p>
      <p>
        As we embark on this exciting adventure, we invite you to explore our
        vast array of products, discover the latest trends, and be a part of
        the MobileShop community. Thank you for choosing MobileShop—where
        technology meets style, and innovation knows no bounds!
      </p>
    </div>
  </section>

  <!-- Reviews Section -->
  <section class="reviews-section">
    <h2>What our customers say</h2>
    <div class="review-container">
      <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
      <a class="next" onclick="changeSlide(1)">&#10095;</a>
      <div class="review-card slide">
        <h3>John Doe</h3>
        <p>
          "Great products and excellent customer service! I highly recommend
          MobileShop."
        </p>
      </div>
      <div class="review-card slide">
        <h3>Jane Smith</h3>
        <p>
          "The quality of their accessories is impressive. Fast shipping too!"
        </p>
      </div>
      <div class="review-card slide">
        <h3>Bob Johnson</h3>
        <p>
          "I purchased a smartphone, and it exceeded my expectations. Will buy
          again."
        </p>
      </div>
      <div class="review-card slide">
        <h3>Alice Williams</h3>
        <p>
          "Fashionable Smartwatch is a game-changer. Love the design and
          features."
        </p>
      </div>
      <div class="review-card slide">
        <h3>Charlie Brown</h3>
        <p>
          "MobileShop offers a fantastic range of products. Great value for
          money!"
        </p>
      </div>
    </div>

    <!-- Add slideshow controls inside review-container -->
  </section>

  <!-- Footer Section -->
  <?php include('footer.php'); ?>

  <!-- Slideshow Script -->
  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slide");
    showSlide(currentSlide);

    function showSlide(index) {
      slides.forEach((slide) => (slide.style.display = "none"));
      slides[index].style.display = "block";
    }

    function changeSlide(n) {
      currentSlide += n;
      if (currentSlide < 0) {
        currentSlide = slides.length - 1;
      } else if (currentSlide >= slides.length) {
        currentSlide = 0;
      }
      showSlide(currentSlide);
    }

    // Add event listeners for slideshow controls
    document
      .querySelector(".review-container")
      .addEventListener("click", (event) => {
        if (event.target.classList.contains("prev")) {
          changeSlide(-1);
        } else if (event.target.classList.contains("next")) {
          changeSlide(1);
        }
      });
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