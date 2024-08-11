<?php
$servername = "localhost"; // or your server address
$username = "root";        // your MySQL username
$password = "SYOUR_PASSWORD";            // your MySQL password (leave empty if none)
$database = "quadiro_assignment"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
