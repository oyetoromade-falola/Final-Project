<?php
$host = "sql207.infinityfree.com";
$dbname = "if0_39288139_coursemart";
$user = "if0_39288139";
$pass = "tuleGQM6INJ6j";

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    error_log("Database connection error: " . $conn->connect_error);
    die("We're experiencing technical issues. Please try again later.");
}
?>
