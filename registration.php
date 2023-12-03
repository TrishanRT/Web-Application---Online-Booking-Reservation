<?php
session_start(); // Start or resume the session

include 'connection.php'; // Include the database connection file

$errors = []; // Initialize an array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Perform validation

    // Validate username (should be non-empty)
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    // Validate email (should be a valid email format)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password (minimum length of 8 characters)
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    // Validate address (should be non-empty)
    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    // Validate phone number (you can add specific format requirements)
    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = "Invalid phone number format (10 digits required).";
    }

    // If there are validation errors, send them to the client-side JavaScript
    if (!empty($errors)) {
        echo json_encode(["errors" => $errors]); // Send errors as JSON
        exit(); // Stop further processing
    } else {
        // Insert user data into the database (securely using prepared statements)
        $sql = "INSERT INTO users (username, email, password, address, phone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssss", $username, $email, $password, $address, $phone);
            $stmt->execute();
            $stmt->close();

            // Set a success message in the session
            $_SESSION['success_message'] = 'Registration successful!';

            // Close the database connection
            $conn->close();

            echo json_encode(["success" => true]); // Send success as JSON
            exit(); // Stop further processing
        } else {
            echo json_encode(["errors" => ["Error: " . $conn->error]]); // Send database error as JSON
            exit(); // Stop further processing
        }
    }
}

// Close the database connection
$conn->close();
?>
