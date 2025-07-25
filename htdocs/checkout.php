<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$cart = $data['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(['status' => 'error', 'message' => 'Cart is empty']);
    exit;
}

$user_id = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");

foreach ($cart as $item) {
    $product_id = $item['id'] ?? 0;
    $quantity = $item['quantity'] ?? 1;
    $price = $item['price'] ?? 0;

    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, price, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiids", $user_id, $product_id, $quantity, $price, $date);
    $stmt->execute();

    // Optional: update stats in product table
    $conn->query("UPDATE products SET times_ordered = times_ordered + $quantity WHERE id = $product_id");
}

echo json_encode(['status' => 'success', 'message' => 'Order recorded']);
$conn->close();
?>
