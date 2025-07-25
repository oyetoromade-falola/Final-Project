<?php
header("Content-Type: application/json");
include 'db.php';

// Fetch all products (courses and materials)
$sql = "SELECT id, name, department, image, type FROM products ORDER BY department, name";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => $row["id"],
            "name" => $row["name"],
            "department" => $row["department"],
            "image" => $row["image"],
            "type" => $row["type"]
        ];
    }
}

// Return JSON
echo json_encode($data);

// Close connection
$conn->close();
?>
