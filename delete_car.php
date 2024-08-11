<?php
session_start(); // Start the session

// Check if the user is logged in and is an admin
if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $car_id = $_GET['id'];

    // Validate and sanitize the input
    if (filter_var($car_id, FILTER_VALIDATE_INT) === false) {
        die("Invalid ID parameter.");
    }

    include "connection.php"; // Include your database connection file

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM car_info WHERE id = ?");
    $stmt->bind_param("i", $car_id);

    if ($stmt->execute()) {
        // Redirect to List.php on success
        header("Location: List.php");
        exit();
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    die("ID parameter is missing.");
}
?>
