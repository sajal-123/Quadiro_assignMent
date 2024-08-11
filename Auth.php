<?php
include('connection.php'); // Include the database connection
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the POST data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Sanitize inputs
    $fname = $conn->real_escape_string($fname);
    $lname = $conn->real_escape_string($lname);
    $password = $conn->real_escape_string($password);
    $email = $conn->real_escape_string($email);

    // Create the SQL query using prepared statements
    $sql = "SELECT * FROM auth WHERE fName = ? AND lName = ? AND email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fname, $lname, $email, $password);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result) {
        $count = $result->num_rows;
        if ($count == 1) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();

            // Store user details in session
            $_SESSION['logged_in'] = true;
            $_SESSION['fname'] = $fname;
            $_SESSION['role'] = $row['role']; // Store the role in the session

            // Redirect to welcome page
            header("Location: List.php");
            exit();
        } else {
            // Display error message and redirect to login page if login fails
            echo '
            <script>
            alert("Login failed: Invalid Username or Password!");
            window.location.href = "index.php";
            </script>
            ';
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>
