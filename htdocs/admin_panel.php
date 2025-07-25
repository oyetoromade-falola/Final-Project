<?php
// ✅ Enable error reporting (remove on production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db.php'; // Ensure this file connects successfully

// ✅ Security headers
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer-when-downgrade");

// ✅ Restrict access to admins only
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.html");
    exit();
}

// ✅ Fetch admin name (safe fallback)
$adminName = isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin';

// ✅ Total Users
$total_users = 0;
$user_sql = "SELECT COUNT(*) AS total_users FROM users";
if ($user_result = $conn->query($user_sql)) {
    $row = $user_result->fetch_assoc();
    $total_users = $row['total_users'];
}

// ✅ Total Courses
$total_courses = 0;
$course_sql = "SELECT COUNT(*) AS total_courses FROM courses";
if ($course_result = $conn->query($course_sql)) {
    $row = $course_result->fetch_assoc();
    $total_courses = $row['total_courses'];
}

// ✅ Placeholder for pending enrollments
$pending_orders = 12;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel - COURSEMART FCFMT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f1f4f7;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }
    main { flex: 1; }
    .admin-box {
      margin-top: 40px;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0,0,0,0.05);
    }
    .section-title {
      border-bottom: 2px solid #007bff;
      padding-bottom: 8px;
      margin-bottom: 20px;
      color: #333;
    }
    .card {
      border-radius: 10px;
      transition: 0.3s ease-in-out;
    }
    .card:hover {
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    footer {
      background-color: #212529;
    }
    .footer-highlight {
      color: #ffc107;
      font-weight: bold;
    }
    .footer-credit {
      color: #ffffffcc;
      font-style: italic;
    }
    .footer-link {
      color: #0dcaf0;
      font-weight: 600;
      text-decoration: none;
    }
    .footer-link:hover {
      color: #ffffff;
    }
    .nav-text {
      font-weight: 600;
      color: #f8f9fa;
    }
    .nav-link:hover .nav-text {
      color: #ffc107;
    }
  </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="img/coursemart-logo.png" alt="Logo" width="40" height="40" class="me-2" />
      <strong>COURSEMART FCFMT (Admin)</strong>
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="logout.php"><span class="nav-text">Logout</span></a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- ✅ Admin Dashboard Content -->
<main>
  <div class="container admin-box">
    <h3 class="text-center text-primary mb-3">Admin Control Panel</h3>
    <h6 class="text-end text-muted">Welcome, <?= $adminName; ?> 👋</h6>

    <!-- 🔹 Stats Overview -->
    <div class="row text-center g-4 mb-4">
      <div class="col-md-4">
        <div class="card p-4 bg-light">
          <h6>Total Users</h6>
          <h4 class="text-primary"><?= $total_users; ?></h4>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4 bg-light">
          <h6>Total Courses</h6>
          <h4 class="text-success"><?= $total_courses; ?></h4>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4 bg-light">
          <h6>Pending Enrollments</h6>
          <h4 class="text-warning"><?= $pending_orders; ?></h4>
        </div>
      </div>
    </div>

    <!-- 🔹 Admin Quick Actions -->
    <h5 class="section-title">Quick Admin Actions</h5>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="card p-3 text-center">
          <h6>Add New Course</h6>
          <a href="add_course_form.php" class="btn btn-outline-primary btn-sm mt-2">Go</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center">
          <h6>View All Users</h6>
          <a href="view_users.php" class="btn btn-outline-success btn-sm mt-2">Go</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center">
          <h6>Generate Reports</h6>
          <a href="report.php" class="btn btn-outline-dark btn-sm mt-2">Go</a>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- ✅ Footer -->
<footer class="text-center text-white py-3 mt-auto">
  <p>
    <span class="footer-highlight">&copy; 2025 COURSEMART FCFMT</span> |
    <span class="footer-credit">Designed by <strong>Falola Regina</strong></span>
  </p>
  <p>
    <a href="contact.html" class="footer-link">Contact</a> |
    <a href="about.html" class="footer-link">About</a>
  </p>
</footer>

<!-- ✅ Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
