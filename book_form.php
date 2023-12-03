<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>book</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<section class="header">
		<a href="home.php" class="logo">Ceylon Travel.</a>

		<nav class="navbar">
			<a href="home.php">Home</a>
			<a href="about.php">About</a>
			<a href="package.php">Package</a>
			<a href="book.php">Book</a>
			<a href="logout.php">Logout</a>
		</nav>

		<div id="menu-btn" class="fas fa-bars"></div>
	</section>

	<div class="heading" style="background: url(booknow.jpg) no-repeat;">
		<h1>Your Booking details</h1>
	</div>


<?php
if (isset($_POST["send"])) 
{

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$location = $_POST["location"];
$guests = $_POST["guests"];
$arrivals = $_POST["arrivals"];
$leaving = $_POST["leaving"];


$con = mysqli_connect("localhost", "root", "");


mysqli_select_db($con,"travel");

$sql = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES ('$name','$email','$phone','$address','$location','$guests','$arrivals','$leaving')";

$ret= mysqli_query($con,$sql);
//header('location:book.php');

echo "<center><h1>Name: $name</h1> </center><br>";
echo "<center><h1>Email: $email </h1></center><br>";
echo "<center><h1>Phone Number: $phone </h1></center><br>";
echo "<center><h1>Address: $address </h1></center><br>";
echo "<center><h1>Location: $location </h1></center><br>";
echo "<center><h1>Number of Guests: $guests </h1></center><br>";
echo "<center><h1>From: $arrivals</h1></center>";
echo "<center><h1>      To: $leaving </h1><br></center>";

mysqli_close($con);
}
?>


	<section class="footer">
		<div class="box-container">
			<div class="box">
				<h3>Quick Links</h3>
				<a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
				<a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
				<a href="package.php"> <i class="fas fa-angle-right"></i> Package</a>
				<a href="book.php"> <i class="fas fa-angle-right"></i> Book</a>
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
		<div class="credit"> Created by <span>Dinal, Maduka, Thanushka, Tashmi & Tharindu</span> | all rights reserved! </div>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
	<script src="script.js"></script>
</body>
</html>

