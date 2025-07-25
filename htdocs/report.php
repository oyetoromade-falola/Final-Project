<?php
session_start();
include 'db.php';

// ✅ Enable error reporting temporarily for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.html");
  exit();
}

// Fetch totals
$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalAdmins = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='admin'")->fetch_assoc()['total'];
$totalCourses = $conn->query("SELECT COUNT(*) as total FROM courses")->fetch_assoc()['total']; // FIXED
$totalCartItems = $conn->query("SELECT COUNT(*) as total FROM cart")->fetch_assoc()['total'];

// Grouped by Department
$departmentStats = [];
$result = $conn->query("SELECT IFNULL(department, 'Unspecified') AS department, COUNT(*) as count FROM users GROUP BY department");
while ($row = $result->fetch_assoc()) {
  $departmentStats[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reports - Admin</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-5">
  <h3 class="text-primary mb-4">📊 Admin Reports & Summary</h3>

  <div class="row g-4 mb-4 text-center">
    <div class="col-md-3">
      <div class="card p-3 shadow-sm">
        <h6>Total Users</h6>
        <h4 class="text-primary"><?= $totalUsers ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm">
        <h6>Total Admins</h6>
        <h4 class="text-success"><?= $totalAdmins ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm">
        <h6>Courses Available</h6>
        <h4 class="text-info"><?= $totalCourses ?></h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm">
        <h6>Items in All Carts</h6>
        <h4 class="text-warning"><?= $totalCartItems ?></h4>
      </div>
    </div>
  </div>

  <!-- 📊 Chart Section -->
  <div class="mb-4">
    <h5>📌 Users by Department</h5>
    <canvas id="deptChart" height="100"></canvas>
  </div>

  <!-- 📄 Department List -->
  <ul class="list-group mb-4">
    <?php foreach ($departmentStats as $dept): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= htmlspecialchars($dept['department']) ?>
        <span class="badge bg-primary rounded-pill"><?= $dept['count'] ?></span>
      </li>
    <?php endforeach; ?>
  </ul>

  <a href="admin_panel.php" class="btn btn-secondary">⬅ Back to Admin Panel</a>
  <a href="export_report.php" class="btn btn-outline-success ms-2">📥 Export to CSV</a>
</div>

<!-- 📊 Chart Script -->
<script>
  const ctx = document.getElementById('deptChart').getContext('2d');
  const deptChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?= json_encode(array_column($departmentStats, 'department')) ?>,
      datasets: [{
        label: 'Users by Department',
        data: <?= json_encode(array_column($departmentStats, 'count')) ?>,
        backgroundColor: [
          '#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997'
        ],
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        title: { display: false }
      }
    }
  });
</script>
</body>
</html>
