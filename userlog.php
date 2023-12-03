

<?php
require_once('connection.php');
session_start();

if (isset($_POST["btnLogin"])) {
    $Email = $_POST["txtUserEmail"];
    $Password = $_POST["txtPassword"];

    if (empty($Email) || empty($Password)) {
        echo '<script>alert("Fields cannot be blank")</script>';
    } else {
        // Sanitize user input to prevent SQL injection (consider using prepared statements).
        $Email = mysqli_real_escape_string($conn, $Email);
        $Password = mysqli_real_escape_string($conn, $Password);

        // Hash the password for comparison with the stored hashed password.
        $hashedPassword = md5($Password);
         // You should use a stronger hashing algorithm like bcrypt.
        if ($Email === 'admin@gmail.com' && $Password === 'admininfo') {
            // Admin authentication successful.
            $_SESSION['Email'] = $Email;
            echo '<script>alert("Admin Login Successful")</script>';
            header('location: admin.php');
            exit; // Terminate the script after redirect.
        }
        else{

        // Perform SQL query to check if the user exists in the database.
        $sql = "SELECT * FROM users WHERE email='$Email' AND password='$Password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
        
            $_SESSION['Email'] = $Email;


            echo '<script>alert("Login Successful")</script>';
            header('location:package.php');
            exit; // Terminate the script after redirect.
        } else {
            // Invalid username and password combination.
            echo '<script>alert("Invalid Username and Password Combination")</script>';
        }
    }
}
}

// Close the database connection.
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.custom-login-button {
    background-color: #007BFF; /* Blue color used in Bootstrap */
    color: #fff; /* White text color */
    border: none; /* Remove the button border */
    padding: 10px 20px; /* Add padding for a comfortable size */
    border-radius: 5px; /* Add rounded corners for a modern look */
    cursor: pointer; /* Add pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition for background color change */

}

.custom-login-button:hover {
    background-color: #0056b3; /* Darker blue color on hover */
}

    .mt-5 {
    margin-bottom: 20px;
}
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
</style>
</head>
<body style="background-image: url(image.jpg);">

	<section class="header">
		<a href="home.php" class="logo">Ceylon Travel.</a>

		<nav class="navbar">
			<a href="home.php">Home</a>
			<a href="about.php">About</a>
			<a href="userlog.php">Package</a>
			
			<!--<a href="login.php">Login Here</a>-->
			  <?php
                    if (isset($_SESSION['Email'])) {
                        echo '<span>Welcome, ' . $_SESSION['Email'] . '</span>';
                        echo '<a href="logout.php">Logout</a>';
                    } else {
                        echo '<a href="login.php">Login Here</a>';
                    }
                    ?>
		</nav>

		<div id="menu-btn" class="fas fa-bars"></div>
	</section>
	<br>
    <div class="container-fluid">
        <div class="container">
            <h1>LOGIN</h1>
            <form action="#" method="post">
                <div class="mt-5">
                    <label for="UserEmail" class="form-label">UserEmail</label>
                    <input type="email" name="txtUserEmail" class="form-control" placeholder="UserEmail">
                    <label for="error-text" class="error-text"></label>
                </div>
                <div class="mt-5">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" name="txtPassword" class="form-control" placeholder="Password">
                    <label for="error-text" class="error-text"></label>
                </div>
                <input type="submit" class="btn btn-warning custom-login-button" name="btnLogin" id="btnSubmit" value="LOGIN">
               <br> <br> <a href="login.php">Don't  have an account? Register here</a>
            </form>
        </div>
    </div>
    <div>
    	<br>
	<section class="footer">
		<div class="box-container">
			<div class="box">
				<h3>Quick Links</h3>
				<a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
				<a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
				<a href="package.php"> <i class="fas fa-angle-right"></i> Package</a>
				<a href="login.php"> <i class="fas fa-angle-right"></i>Register</a>
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
</html>
