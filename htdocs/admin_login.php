<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start();
include 'db.php'; // Ensure this connects correctly



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: admin_login.html?error=" . urlencode("Email and password are required."));
        exit();
    }

    // Prepare query
    $stmt = $conn->prepare("SELECT id, full_name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $full_name, $user_email, $hashed_password, $role);
        $stmt->fetch();

        if ($role === 'admin' && password_verify($password, $hashed_password)) {
            // Set session
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $full_name;
            $_SESSION['admin_email'] = $user_email;
            $_SESSION['role'] = 'admin';
            $_SESSION['logged_in'] = true;

            header("Location: admin_panel.php");
            exit();
        } else {
            header("Location: admin_login.html?error=" . urlencode("❌ Invalid admin credentials."));
            exit();
        }
    } else {
        header("Location: admin_login.html?error=" . urlencode("❌ No user found with this email."));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
