<?php
session_start(); // Start the session
if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

// // Debug: Output session data
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

// Handle logout
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    // Redirect to the login page
    header("Location: index.php");
    exit();
}

// Check if the user is an admin
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car_Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .table-container {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 20px;
            margin: 20px auto;
            max-width: 90%; /* Adjust based on your design */
            background-color: #f8f9fa;
        }
        .table-container table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-container th, .table-container td {
            border: 1px solid #dee2e6;
        }
        .table-container th {
            background-color: #343a40;
            color: #ffffff;
        }
        .table-container td {
            background-color: #ffffff;
        }
        .admin-buttons {
            margin: 20px 0;
        }
        .action-buttons {
            display: flex;
            justify-content: center; /* Center horizontally */
            gap: 10px; /* Space between buttons */
        }
        .action-buttons a {
            display: inline-block;
        }
        .But{
            display:flex;
            justify-content: space-evenly;
            align-items:center
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logout Form -->
       <div class="But">
       <form method="post" action="">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>

        <!-- Admin Buttons -->
        <?php if ($is_admin): ?>
            <div class="admin-buttons">
                <a href="create.php" class="btn btn-success" onclick="window.location.href='create.php';">Add Car</a>
            </div>
        <?php endif; ?>
       </div>


        <!-- Car Info Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped table-hover">
                <caption>List of Cars</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Car Name</th>
                        <th scope="col">Manufacturing Year</th>
                        <th scope="col">Price</th>
                        <?php if ($is_admin): ?>
                            <th scope="col">Delete</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "connection.php";
                    $sql = "SELECT * FROM car_info";
                    $result = $conn->query($sql);
                    if(!$result){
                        die("Invalid query!");
                    }
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                            <th>{$row['id']}</th>
                            <td>{$row['car_name']}</td>
                            <td>{$row['manufacturing_year']}</td>
                            <td>{$row['price']}</td>";
                            if ($is_admin) {
                                echo "
                                <td>
                                    <a href='delete_car.php?id={$row['id']}' class='btn flex item-center justify-center btn-sm'>
                                        <img src='./Images/delete.png' alt='Delete' height='32'>
                                    </a>
                                </td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
