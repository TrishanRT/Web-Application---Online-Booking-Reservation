
<?php
session_start(); // Start or resume the session

// Check if a success message is in the session
if (isset($_SESSION['success_message'])) {
    echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';
    unset($_SESSION['success_message']); // Remove the success message from the session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission using AJAX
            $("form").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission
                
                // Send form data to registration.php using AJAX
                $.ajax({
                    type: "POST",
                    url: "registration.php",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.errors) {
                            // Display error messages as pop-up notifications
                            alert("Registration failed. Errors:\n" + response.errors.join("\n"));
                        } else if (response.success) {
                            // Registration was successful, show a success message
                            alert("Registration successful!");
                            // Redirect to the desired page
                            window.location.href = "login.php"; // Replace with the actual login page URL
                        }
                    },
                    error: function() {
                        alert("An error occurred while processing your request.");
                    }
                });
            });
        });
    </script>
<style>/* styles.css */

body {
	font-family: Arial, sans-serif;
    background-image: url('image.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center center; /* Center the background image */
    background-color: #f5f5f5;
}
.success-message {
    color: green; /* Change the text color to green or your preferred color */
    font-weight: bold;
    text-align: center;
    margin-top: 10px; /* Adjust as needed */
}

.button-container {
    text-align: center; /* Center the button horizontally */
}

.button-container button[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
}

.container {
     max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha (A) value for transparency */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    border-radius: 5px;
}

h2 {
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="tel"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
    <section class="header">
        <a href="home.php" class="logo">Ceylon Travel.</a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="userlog.php">Package</a>
            
            <a href="login.php">Login Here</a>
        </nav>
   </section>
   <br><br>
  

   <div class="container">
        <h2>User Registration</h2>
        <form action="registration.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
          <div class="button-container">
    <button type="submit">Register</button>
    <br> <a href="userlog.php">Already have an account? Log in</a>
</div>

        </form>

    </div><br><br>
<div>
	<section class="footer">
		<div class="box-container">
			<div class="box">
				<h3>Quick Links</h3>
				<a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
				<a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
				<a href="package.php"> <i class="fas fa-angle-right"></i> Package</a>
				<a href="login.php"> <i class="fas fa-angle-right"></i> Registration</a>
			</div>

			<div class="box">
				<h3>Extra Links</h3>
				<a href="#"> <i class="fas fa-angle-right"></i> Ask Questions</a>
				<a href="#"> <i class="fas fa-angle-right"></i> About us</a>
				<a href="#"> <i class="fas fa-angle-right"></i> Privacy Policy</a>
				<a href="#"> <i class="fas fa-angle-right"></i> Terms of use</a>
			</div>

			<div class="box">
				<h3>Contact info</h3>
				<a href="#"> <i class="fas fa-phone"></i> +94-772642987</a>
				<a href="#"> <i class="fas fa-phone"></i> +94-912258629</a>
				<a href="#"> <i class="fas fa-envelope"></i> ceylontravel5@gmail.com</a>
				<a href="#"> <i class="fas fa-map"></i> Ambalangoda, Sri Lanka.</a>
			</div>

			<div class="box">
				<h3>Follow us</h3>
				<a href="#"> <i class="fab fa-facebook-f"></i> Facebook  </a>
				<a href="#"> <i class="fab fa-twitter"></i> Twitter  </a>
				<a href="#"> <i class="fab fa-instagram"></i> Instagram  </a>
				<a href="#"> <i class="fab fa-linkedin"></i> Linkedin  </a>
			</div>
		</div>
		<div class="credit"> Created by <span>trishantrx</span> | all rights reserved! </div>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
	<script src="script.js"></script>
</div>
</body>