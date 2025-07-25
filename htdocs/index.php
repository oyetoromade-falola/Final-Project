<?php
session_start();
$username = $_SESSION['username'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>COURSEMART FCFMT - Home</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #5286ee;
    }
    .hero {
      background: url('img/hero-bg.jpg') center center/cover no-repeat;
      color: white;
      padding-top: 6rem;
      padding-bottom: 4rem;
    }
    .features .card { transition: transform 0.3s; }
    .features .card:hover { transform: scale(1.05); }
    .recommended img { height: 120px; object-fit: cover; }
    .footer-highlight { color: #ffc107; font-weight: bold; }
    .footer-credit { color: #ffffffcc; font-style: italic; }
    .footer-link { color: #0dcaf0; font-weight: 600; text-decoration: none; }
    .footer-link:hover { color: #ffffff; }
    .nav-text { font-weight: 600; color: #f8f9fa; }
    .nav-link:hover .nav-text { color: #ffc107; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/coursemart-logo.png" alt="Logo" width="40" height="40" />
     <b> COURSEMART FCFMT</b>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php"><span class="nav-text">Home</span></a></li>
          <!-- ✅ Show Admin link only if admin is logged in -->
    <li class="nav-item">
  <a class="nav-link" href="admin_panel.php">
    <span class="nav-text">Admin</span>
  </a>
</li>
     <li class="nav-item"><a class="nav-link" href="cart.html"><span class="nav-text">Cart</span></a></li>
        <li class="nav-item"><a class="nav-link" href="about.html"><span class="nav-text">About</span></a></li>
        <li class="nav-item"><a class="nav-link" href="courses.html"><span class="nav-text">Courses</span></a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html"><span class="nav-text">Contact</span></a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><span class="nav-text">Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="faq_testimonials.php"><span class="nav-text">FAQs</span></a></li>

     <li class="nav-item"><a class="nav-link" href="logout.php"><span class="nav-text">Logout</span></a></li>
      </ul>
    </div>
  </div>
</nav>



<!-- Hero -->
<section class="hero text-center">
  <div class="container">
    <h1 class="mb-3">Welcome to COURSEMART FCFMT</h1>
    <p class="mb-4">Your Smart Platform for Courses and Academic Resources</p>
    <!-- Marquee -->
<div class="bg-warning text-dark py-2">
  <marquee>🎉 Admissions Open | 📚 New Courses Added | 💸 50% Off on Academic Materials | 🏦 Wallet Payments Now Available | 🛠 Contact Admin for Support</marquee>
</div><br>
    <a href="signup.html" class="btn btn-light me-2">Get Started</a>
    <a href="courses.html" class="btn btn-outline-light">Browse Courses</a>
  </div>
</section>

<!-- Featured Courses with Modals -->
<section class="features py-5 bg-white" style="margin: 10px 0; border-radius:20px; box-shadow: 0 0 5px black;">
  <div class="container">
    <h3 class="text-center text-primary mb-4">Featured Courses</h3>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="img/data-analytics.webp" class="card-img-top" alt="Data Analytics">
          <div class="card-body">
            <h5 class="card-title">Data Analytics</h5>
            <p class="card-text">ICT Department</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">View Course</button>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="img/fish-tech.webp" class="card-img-top" alt="Fish Hatchery">
          <div class="card-body">
            <h5 class="card-title">Fish Hatchery Mgmt</h5>
            <p class="card-text">Fisheries Technology</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal2">View Course</button>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="img/networking.webp" class="card-img-top" alt="Networking">
          <div class="card-body">
            <h5 class="card-title">Networking Essentials</h5>
            <p class="card-text">ICT Department</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal3">View Course</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modals for Courses -->
<?php
$modals = [
  ["id" => "modal1", "title" => "Data Analytics", "desc" => "Turn data into decisions! Learn Excel, SQL, and Tableau to uncover trends, predict outcomes, and become a data-driven powerhouse.", "price" => "₦2500", "img" => "img/data-analytics.webp", "dept" => "ICT Department"],
  ["id" => "modal2", "title" => "Fish Hatchery Mgmt", "desc" => "Dive into the science of sustainable fish farming! Master breeding techniques, hatchery setup, and aquaculture practices for a thriving aquatic business.", "price" => "₦3000", "img" => "img/fish-tech.webp", "dept" => "Fisheries Technology"],
  ["id" => "modal3", "title" => "Networking Essentials", "desc" => "Get plugged into the digital world! Learn how networks connect the globe — from routers to real-time traffic, and set the foundation for your IT journey.", "price" => "₦2000", "img" => "img/networking.webp", "dept" => "ICT Department"],
];

foreach ($modals as $modal):
?>
<div class="modal fade" id="<?= $modal['id'] ?>" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><?= $modal['title'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="<?= $modal['img'] ?>" class="img-fluid rounded mb-3" />
        <p><strong>Department:</strong> <?= $modal['dept'] ?></p>
        <p><?= $modal['desc'] ?></p>
        <p><strong>Price:</strong> <?= $modal['price'] ?></p>
      </div>
     <div class="modal-footer">
  <!-- No Add to Cart button -->
  <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

    </div>
  </div>
</div>
<?php endforeach; ?>

<!-- About Section -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="mb-4 text-primary">What is COURSEMART FCFMT?</h2>
    <p class="lead">
      COURSEMART is a centralized academic shopping platform for the Federal College of Fisheries and Marine Technology. It offers intelligent product placement, cart analysis, and a smarter way to access college courses and student materials.
    </p>
  </div>
</section>

<!-- Footer -->
<footer class="text-center text-white bg-dark py-3">
  <p><span class="footer-highlight">&copy; 2025 COURSEMART FCFMT</span> | <span class="footer-credit">Designed by <strong>Falola Regina</strong></span></p>
  <p><a href="contact.html" class="footer-link">Contact</a> | <a href="about.html" class="footer-link">About</a></p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function addToCart(name, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let found = cart.find(item => item.name === name);
    if (found) {
      found.qty += 1;
    } else {
      cart.push({ name, price, qty: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(name + " added to cart!");
  }
</script>
</body>
</html>
