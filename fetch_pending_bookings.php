<?php
session_start();

require_once('connection.php'); // Include your database connection code

// Check if the user is logged in as an admin. If not, redirect them to the login page.
if (!isset($_SESSION['Email']) || $_SESSION['Email'] !== 'admin@gmail.com') {
    header('location: login.php');
    exit;
}

// Check if the form is submitted to change the status and send vehicle status and cost
if (isset($_POST['btnConfirmBooking'])) {
    $bookingID = $_POST['booking_id'];
    $vehicleStatus = $_POST['vehicle_status'];
    $cost = $_POST['cost'];

    // Update the booking status, vehicle status, and cost in the database
    $updateStatusQuery = "UPDATE bookings SET status = 'confirmed', vehicle_status = ?, cost = ? WHERE booking_id = ?";
    $stmt = mysqli_prepare($conn, $updateStatusQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $vehicleStatus, $cost, $bookingID);
        if (mysqli_stmt_execute($stmt)) {
            // Booking status, vehicle status, and cost updated successfully
            // You can now send this information to the user if needed
            echo '<script>alert("Booking confirmed and updated successfully.")</script>';
        } else {
            echo '<script>alert("Error updating booking status.")</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error preparing statement.")</script>';
    }
}

// Fetch all user bookings from the database
$sql = "SELECT * FROM bookings WHERE status = 'pending'"; // Change 'pending' to the appropriate status
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="stylelk.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-image: url('booknow.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <h1>Admin Bookings</h1>
    <p>Welcome, Admin!</p>

    <h2>User Bookings</h2>
    <?php
    if (isset($result) && mysqli_num_rows($result) > 0) {
        echo '<table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User Email</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>pickup_location</th>
                        <th>Status</th>
                        <th>Vehicle Status</th>
                        <th>Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['booking_id'] . '</td>';
            echo '<td>' . $row['user_email'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['start_date'] . '</td>';
            echo '<td>' . $row['end_date'] . '</td>';
             echo '<td>' . $row['pickup_location'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td>' . $row['vehicle_status'] . '</td>';
            echo '<td>' . $row['cost'] . '</td>';
            echo '<td>
                    <form method="post" action="#">
                        <input type="hidden" name="booking_id" value="' . $row['booking_id'] . '">
                        <input type="text" name="vehicle_status" placeholder="Vehicle Status">
                        <input type="text" name="cost" placeholder="Cost">
                        <button type="submit" name="btnConfirmBooking">Confirm</button>
                    </form>
                  </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo 'No user bookings available.';
    }
    ?>

    <p><a href="admin.php">Back to Admin Page</a></p>
</body>
</html>
