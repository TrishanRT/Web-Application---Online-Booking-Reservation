<?php
session_start(); // Start or resume the session

include 'connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $login_username = $_POST["username"];
    $login_password = $_POST["password"];

    // TODO: Validate and authenticate the user (check against database records)
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $login_username, $login_password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows == 1) {
            // Authentication successful
            $_SESSION['logged_in_username'] = $login_username; // Store the username in a session variable
            header("Location: dashboard.php"); // Redirect to a logged-in page
            exit();
        } else {
            // Authentication failed
            echo "Invalid username or password.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
