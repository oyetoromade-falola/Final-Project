<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.html");
  exit();
}

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $department = trim($_POST['department']);
  $type = $_POST['type'];
  $price = floatval($_POST['price']);
  $image = 'default.jpg';

  // Handle file upload securely
  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
    if (in_array($ext, $allowed_ext)) {
      $filename = uniqid('course_', true) . '.' . $ext;
      $destination = '../img/' . $filename;
      if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        $image = $filename;
      }
    }
  }

  // Insert into database
  $stmt = $conn->prepare("INSERT INTO products (name, department, type, image, price) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssd", $name, $department, $type, $image, $price);

  if ($stmt->execute()) {
    header("Location: add_course_form.php?success=1");
    exit();
  } else {
    $message = "❌ Failed to add course. Please try again.";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Course - Admin</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="text-primary mb-4">📚 Add New Course / Material</h3>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">✅ Course added successfully!</div>
  <?php elseif (!empty($message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="shadow p-4 bg-white rounded">
    <div class="mb-3">
      <label for="name" class="form-label">Course Name</label>
      <input type="text" name="name" id="name" required class="form-control">
    </div>
    <div class="mb-3">
      <label for="department" class="form-label">Department</label>
      <input type="text" name="department" id="department" required class="form-control">
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select name="type" id="type" class="form-select" required>
        <option value="course">Course</option>
        <option value="material">Material</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Price (₦)</label>
      <input type="number" name="price" id="price" step="0.01" required class="form-control">
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Upload Image</label>
      <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp" class="form-control">
      <small class="text-muted">Only JPG, PNG, or WEBP images allowed.</small>
    </div>
    <div class="d-flex">
      <button type="submit" class="btn btn-primary">Add Course</button>
      <a href="../admin_panel.php" class="btn btn-secondary ms-3">Back to Admin Panel</a>
    </div>
  </form>
</div>
</body>
</html>
