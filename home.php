<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['Email'])) {
    // User is already logged in, no need to display the login option
    $welcomeMessage = 'Welcome, ' . $_SESSION['Email'];
} else {
    // User is not logged in, display the login option
    $welcomeMessage = '<a href="login.php">Login Here</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>home</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	.package-box {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    width: 300px;
    display: inline-block;
}

.package-box img {
    max-width: 100%;
    height: auto;
}
.book-button {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.book-button:hover {
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
			<!--<a href="login.php">Book</a>-->
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

	<section class="home">
		<div class="swiper mySwiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide" style="background: url(train.jpg) no-repeat;">
					<div class="content">
						<span>Explore, Discover, Travel</span>
						<h3>Travel around the World</h3>
						<a href="package.php" class="btn">Discover more</a>
					</div>
				</div>

				<div class="swiper-slide" style="background: url(leopard.jpg) no-repeat;">
					<div class="content">
						<span>Explore, Discover, Travel</span>
						<h3>Discover the new Places</h3>
						<a href="package.php" class="btn">Discover more</a>
					</div>
				</div>

				<div class="swiper-slide" style="background: url(bali.jpg) no-repeat;">
					<div class="content">
						<span>Explore, Discover, Travel</span>
						<h3>Make your tour worthwhile</h3>
						<a href="package.php" class="btn">Discover more</a>
					</div>
				</div>
			</div>
			<div class="swiper-button-next"></div>
      		<div class="swiper-button-prev"></div>
		</div>
	</section>

	<section class="services">
		<h1 class="heading-title"> Our Services</h1>
		<div class="box-container">
			<div class="box">
				<img src="icon 1.png" width="100%">
				<h3>Adventure</h3>
			</div>

			<div class="box">
				<img src="icon 2.png" width="100%">
				<h3>Tour Guide</h3>
			</div>

			<div class="box">
				<img src="icon 3.png" width="100%">
				<h3>Trekking</h3>
			</div>

			<div class="box">
				<img src="icon 4.png" width="100%">
				<h3>Camp Fire</h3>
			</div>

			<div class="box">
				<img src="icon 5.png" width="100%">
				<h3>Off Road</h3>
			</div>

			<div class="box">
				<img src="icon 6.png" width="100%">
				<h3>Camping</h3>
			</div>
		</div>
	</section>

	<section class="home-about">
		<div class="image">
			<img src="sigiriya.jpg">
		</div>
		<div class="content">
			<h3>About Us</h3>
			<p>Ceylon Travels offers exciting and affordable Sri Lanka tour packages, Our  Sri Lanka Tour Packages Includes Family Tours & Budget Tour. Through this website, we invite you to take a glimpse of Sri Lanka, which is not only the lustrous Pearl of the Indian Ocean but one of the most exciting locations for your next tour or vacation. You will be enticed by the rich diversity of sights and sensations that this little island has to offer.</p>
			<a href="about.php" class="btn">Read more..</a>
		</div>
	</section>

	<section class="home-packages">
		<h1 class="heading-title">Our Packages</h1>
<?php
require_once('connection.php'); // Include the database connection code

// Fetch packages from the database
$sql = "SELECT * FROM packages";
$result = mysqli_query($conn, $sql);

// Check if there are packages to display
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $packageID = $row['package_id'];
        $location = $row['location'];
        $description = $row['description'];
        $imagePath = $row['image_path'];

        // Display each package as a box or card
       // Display each package as a box or card
echo '<div class="package-box">';
echo '<img src="' . $imagePath . '" alt="' . $location . '">';
echo '<h3>' . $location . '</h3>';
echo '<p>' . $description . '</p>';
//echo '<a href="booking.php?package_id=' . $packageID . '" class="book-button">Book Now</a>'; // Link to booking page
echo '</div>';

    }
} else {
    echo 'No packages available.';
}

// Close the database connection
mysqli_close($conn);
?>





		
	</section>

	<section class="home-offer">
		<div class="content">
			<h3>Upto 50% off</h3>
			<p>Have fun and enjoy your life by travelling and exploring the world. Book now from us and get upto 50% for your adventures and tours.</p>
			<a href="userlog.php" class="btn">Book Now</a>
		</div>
	</section>

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
		<div class="credit"> Created by <span>trishantrx</span> | all rights reserved! </div>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
	<script src="script.js"></script>
	</body>
</html>