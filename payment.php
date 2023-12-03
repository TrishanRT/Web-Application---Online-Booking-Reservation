<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="stylelk.css">
</head>
<body>
    <h1>Payment</h1>
    <?php
    // Retrieve the booking ID from the URL parameter
    $bookingID = $_GET['booking_id'];

    // Display booking details
    echo '<h2>Booking Details</h2>';
    echo '<p>Booking ID: ' . $bookingID . '</p>';
    // Display other booking details as needed
    ?>

    <h2>Select Payment Method</h2>
    <form action="#" method="post" id="paymentForm">
        <input type="hidden" name="booking_id" value="<?php echo $bookingID; ?>">

        <!-- Cash payment option -->
        <label for="cash"><input type="radio" id="cash" name="payment_method" value="cash"> Cash</label><br>

        <!-- Credit card payment option -->
        <label for="credit_card"><input type="radio" id="credit_card" name="payment_method" value="credit_card"> Credit Card</label><br>

        <!-- Submit button -->
        <input type="submit" value="Proceed to Payment">
    </form>

    <script>
        // Add event listener for form submission
        document.getElementById("paymentForm").addEventListener("submit", function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the selected payment method
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            // Check if the selected payment method is "Credit Card"
            if (paymentMethod === "credit_card") {
                // Redirect to the "process_payment.php" page
                window.location.href = "process_payment.php?booking_id=<?php echo $bookingID; ?>&payment_method=credit_card";
            }
        });
    </script>
</body>
</html>
