<?php
// Enable full error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Include database connection
include 'db.php';

$error = "";

// Handle login logic when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, full_name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password, $role);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['role'] = $role;
            $_SESSION['logged_in'] = true;

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: admin_panel.php");
                exit();
            } elseif ($role === 'student') {
                header("Location: dashboard.php"); // ✅ Fixed: removed leading slash
                exit();
            } else {
                $error = "⚠️ Unknown user role. Contact admin.";
            }
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ No user found with this email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - COURSEMART FCFMT</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
          <h4>Login</h4>
        </div>
        <div class="card-body">
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error); ?></div>
          <?php endif; ?>

          <form method="POST" action="login.php">
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <p class="mt-3 text-center">Don’t have an account? <a href="signup.html">Sign up here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
