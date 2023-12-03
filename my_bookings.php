<?php
session_start();

require_once('connection.php'); // Include your database connection code

if (isset($_SESSION['Email'])) {
    $userEmail = $_SESSION['Email'];
} else {
    // Handle the case where the user is not logged in
    echo 'Please log in to view your bookings.';
    exit;
}

// Fetch user's confirmed bookings from the database
$sqlConfirmed = "SELECT * FROM bookings WHERE user_email = ? AND status = 'confirmed'";
$stmtConfirmed = mysqli_prepare($conn, $sqlConfirmed);

if ($stmtConfirmed) {
    mysqli_stmt_bind_param($stmtConfirmed, "s", $userEmail);
    mysqli_stmt_execute($stmtConfirmed);

    // Fetch the results
    $resultConfirmed = mysqli_stmt_get_result($stmtConfirmed);

    mysqli_stmt_close($stmtConfirmed);
} else {
    // Handle errors in preparing the statement
    echo 'Error in preparing the statement for confirmed bookings.';
    exit;
}

// Fetch user's pending bookings from the database
$sqlPending = "SELECT * FROM bookings WHERE user_email = ? AND status = 'pending'";
$stmtPending = mysqli_prepare($conn, $sqlPending);

if ($stmtPending) {
    mysqli_stmt_bind_param($stmtPending, "s", $userEmail);
    mysqli_stmt_execute($stmtPending);

    // Fetch the results
    $resultPending = mysqli_stmt_get_result($stmtPending);

    mysqli_stmt_close($stmtPending);
} else {
    // Handle errors in preparing the statement
    echo 'Error in preparing the statement for pending bookings.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
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
    <h1>My Bookings</h1>
    <p>Welcome, <?php echo $userEmail; ?>!</p>

    <h2>Confirmed Bookings</h2>
    <?php
    if (isset($resultConfirmed) && mysqli_num_rows($resultConfirmed) > 0) {
        echo '<table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Pickup Location</th>
                        <th>Vehicle Status</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = mysqli_fetch_assoc($resultConfirmed)) {
            echo '<tr>';
            echo '<td>' . $row['booking_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['start_date'] . '</td>';
            echo '<td>' . $row['end_date'] . '</td>';
            echo '<td>' . $row['pickup_location'] . '</td>';
            echo '<td>' . $row['vehicle_status'] . '</td>';
            echo '<td>' . $row['cost'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td><a href="payment.php?booking_id=' . $row['booking_id'] . '">Pay Now</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo 'You have no confirmed bookings.';
    }
    ?>

    <h2>Pending Bookings</h2>
    <?php
    if (isset($resultPending) && mysqli_num_rows($resultPending) > 0) {
        echo '<table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Pickup Location</th>
                       
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>';
        while ($row = mysqli_fetch_assoc($resultPending)) {
            echo '<tr>';
            echo '<td>' . $row['booking_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['start_date'] . '</td>';
            echo '<td>' . $row['end_date'] . '</td>';
            echo '<td>' . $row['pickup_location'] . '</td>';
           // echo '<td>' . $row['vehicle_status'] . '</td>';
            //echo '<td>' . $row['cost'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
           // echo '<td><a href="payment.php?booking_id=' . $row['booking_id'] . '">Pay Now</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo 'You have no pending bookings.';
    }
    ?>

    <p><a href="Package.php">Book Another Package</a></p>
</body>
</html>
