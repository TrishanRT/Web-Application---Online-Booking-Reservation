<?php
session_start();

require_once('connection.php'); // Include your database connection code

if (isset($_SESSION['Email'])) {
    $userEmail = $_SESSION['Email'];
} else {
    // Handle the case where the user is not logged in
    echo 'Please log in to book this package.';
    exit;
}

if (isset($_GET['package_id'])) {
    $packageID = $_GET['package_id'];
} else {
    // Handle the case where package_id is missing
    echo 'Package ID is missing.';
    exit;
}

if (isset($_POST["btnSubmit"])){
    // Collect and validate user input
    $name = $_POST['name'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $guestNumber = $_POST['guest_number'];
    $pickupLocation = $_POST['pickup_location'];

    // Validate the 'name' field to ensure it's not empty
    if (empty($name)) {
        echo 'Name field cannot be empty.';
        exit;
    }

    // Prepare the SQL statement to insert the booking
    // Prepare the SQL statement with the correct number of placeholders
    $sql = "INSERT INTO bookings (user_email, package_id, name, start_date, end_date, guest_number, pickup_location, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sisssss", $userEmail, $packageID, $name, $startDate, $endDate, $guestNumber, $pickupLocation);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Booking successful, display a success message
            echo '<script>alert("Booking successful! You will receive a confirmation email shortly.");</script>';
              header('Location: my_bookings.php');
    exit; 
        } else {
            // Handle the case where the booking failed
            echo 'Booking failed. Please try again later.';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle errors in preparing the statement
        echo 'Error in preparing the statement.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Package</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="stylelk.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-image: url('sigiriya.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <h1>Book Package</h1>
    <p>Welcome, <?php echo $userEmail; ?>!</p>

    <form action="booking.php?package_id=<?php echo $packageID; ?>" method="POST">
        <!-- Add a hidden input field for package_id -->
        <input type="hidden" name="package_id" value="<?php echo $packageID; ?>">
        
        <!-- Other input fields for booking details -->
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>
        <div>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>
        <div>
            <label for="guest_number">Number of Guests:</label>
            <input type="number" id="guest_number" name="guest_number" required>
        </div>
        <div>
            <label for="pickup_location">Pickup Location:</label>
            <input type="text" id="pickup_location" name="pickup_location" placeholder="Enter pickup location" required>
        </div>
        
        <div>
            <button type="submit" name="btnSubmit">Submit Booking</button>
        </div>
    </form>

    <p><a href="my_bookings.php">View My Bookings</a></p>
</body>
</html>
