<?php
// db.php should contain your database connection
include 'db.php';

$username = $_POST['username'] ?? 'Guest';
$message = $_POST['message'] ?? '';

if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO chat_messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    echo "success";
} else {
    echo "empty message";
}
?>

