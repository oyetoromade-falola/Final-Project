<?php
session_start();
include 'db.php'; // Make sure this points correctly to your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and fetch inputs
    $name = trim(htmlspecialchars($_POST['name']));
    $department = trim(htmlspecialchars($_POST['department']));
    $message = trim(htmlspecialchars($_POST['message']));

    // Basic validation
    if (empty($name) || empty($department) || empty($message)) {
        echo "<script>alert('❌ All fields are required.'); window.history.back();</script>";
        exit();
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO testimonials (name, department, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $department, $message);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Thank you for your feedback, $name!'); window.location.href='faq_testimonials.html';</script>";
    } else {
        echo "<script>alert('❌ Failed to submit testimonial. Please try again later.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
