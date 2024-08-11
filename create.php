<?php
session_start(); // Start the session
if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}else if($_SESSION['role'] !== 'admin'){
    header("Location: List.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connection.php"; // Include your database connection file

    // Retrieve form data
    $car_name = $_POST['car_name'];
    $manufacturing_year = $_POST['manufacturing_year'];
    $price = $_POST['price'];

    // Validate form data
    if (empty($car_name) || empty($manufacturing_year) || empty($price)) {
        echo "<p class='text-danger'>All fields are required.</p>";
    } else {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO car_info (car_name, manufacturing_year, price) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $car_name, $manufacturing_year, $price);

        if ($stmt->execute()) {
            // Redirect to List.php on success
            header("Location: List.php");
            exit();
        } else {
            echo "<p class='text-danger'>Error adding car. Please try again.</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Car</h1>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="car_name">Car Name:</label>
                <input type="text" class="form-control" id="car_name" name="car_name" required>
            </div>
            <div class="form-group">
                <label for="manufacturing_year">Manufacturing Year:</label>
                <input type="number" class="form-control" id="manufacturing_year" name="manufacturing_year" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Car</button>
            <a href="List.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
