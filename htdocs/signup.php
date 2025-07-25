<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php'; // database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars(trim($_POST['full_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $role = 'student'; // default role

    // ✅ Validate empty fields
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm)) {
        echo "<script>alert('❌ All fields are required.'); window.history.back();</script>";
        exit();
    }

    // ✅ Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('⚠️ Invalid email format.'); window.history.back();</script>";
        exit();
    }

    // ✅ Password match check
    if ($password !== $confirm) {
        echo "<script>alert('❌ Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    // ✅ Password strength
    if (strlen($password) < 6) {
        echo "<script>alert('🔐 Password must be at least 6 characters.'); window.history.back();</script>";
        exit();
    }

    // ✅ Check if email exists
    $check_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('⚠️ Email already exists. Please login.'); window.location.href='login.php';</script>";
        exit();
    }

    // ✅ Hash the password and insert
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_sql = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssss", $fullname, $email, $hashed_password, $role);

    if ($insert_stmt->execute()) {
        echo "<script>alert('✅ Signup successful! Please log in.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('❌ Signup failed. Please try again.'); window.history.back();</script>";
    }

    $check_stmt->close();
    $insert_stmt->close();
    $conn->close();
}
?>
