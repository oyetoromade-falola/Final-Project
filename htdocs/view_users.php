<?php
session_start();
include 'db.php';

// ✅ Restrict access
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.html");
    exit();
}

// ✅ Delete user
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: view_users.php?deleted=1");
    exit();
}

// ✅ Handle search and filtering
$search = $_GET['search'] ?? '';
$department = $_GET['department'] ?? '';

$query = "SELECT id, full_name, email, department, role FROM users WHERE 1=1";

$params = [];
$types = '';

if (!empty($search)) {
    $query .= " AND (full_name LIKE ? OR email LIKE ?)";
    $searchTerm = "%$search%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= 'ss';
}

if (!empty($department)) {
    $query .= " AND department = ?";
    $params[] = $department;
    $types .= 's';
}

$query .= " ORDER BY id DESC";
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// ✅ Fetch departments for filter dropdown
$dept_result = $conn->query("SELECT DISTINCT department FROM users WHERE department IS NOT NULL");
$departments = [];
while ($row = $dept_result->fetch_assoc()) {
    $departments[] = $row['department'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Users - Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background-color: #f8f9fa; }
    .container { max-width: 960px; }
  </style>
</head>
<body>

<div class="container mt-5">
  <h3 class="mb-4 text-primary">📋 Registered Users</h3>

  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">✅ User deleted successfully!</div>
  <?php endif; ?>

  <!-- 🔍 Search and Filter Form -->
  <form class="row g-3 mb-4" method="GET" action="view_users.php">
    <div class="col-md-5">
      <input type="text" class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name or email">
    </div>
    <div class="col-md-4">
      <select name="department" class="form-select">
        <option value="">Filter by department</option>
        <?php foreach ($departments as $dept): ?>
          <option value="<?= htmlspecialchars($dept) ?>" <?= ($department === $dept) ? 'selected' : '' ?>>
            <?= htmlspecialchars($dept) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-primary">Apply</button>
      <a href="view_users.php" class="btn btn-secondary">Reset</a>
    </div>
  </form>

  <?php if (count($users) > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $i => $user): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= htmlspecialchars($user['full_name']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><?= htmlspecialchars($user['department']) ?></td>
              <td><?= ucfirst($user['role']) ?></td>
              <td>
                <?php if ($user['role'] !== 'admin'): ?>
                  <a href="?delete=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                <?php else: ?>
                  <span class="badge bg-secondary">Admin</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No users found.</div>
  <?php endif; ?>

  <a href="admin_panel.php" class="btn btn-secondary mt-3">⬅️ Back to Admin Panel</a>
</div>

</body>
</html>
