<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <!-- Add your CSS styles or include CSS files here -->
    
    <!-- Your CSS styles go here -->
</head>
<body>
    <h1>Booking Confirmation</h1>
    
    <!-- Retrieve and display submitted data -->
    <h2>Entered Data</h2>
    <p>Name: <?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?></p>
    <p>Start Date: <?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?></p>
    <p>End Date: <?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?></p>
    <p>Number of Guests: <?php echo isset($_POST['guest_number']) ? $_POST['guest_number'] : ''; ?></p>
    <p>Pickup Location: <?php echo isset($_POST['pickup_location']) ? $_POST['pickup_location'] : ''; ?></p>
    <!-- You can display other submitted data here -->

    <p>Thank you for booking with us. We will review your booking request and send you a confirmation email shortly.</p>

    <p><a href="booking.php?package_id=<?php echo isset($_POST['package_id']) ? $_POST['package_id'] : ''; ?>">Back to Booking</a></p>
</body>
</html>
