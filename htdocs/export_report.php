<?php
include 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=department_report.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Department', 'User Count']);

$query = "SELECT IFNULL(department, 'Unspecified') AS department, COUNT(*) as count FROM users GROUP BY department";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
  fputcsv($output, [$row['department'], $row['count']]);
}

fclose($output);
exit();
