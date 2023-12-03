<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>about</title>

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
			<a href="userlog.php">Package</a>
			
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

	<div class="heading" style="background: url(coconut.jpg) no-repeat;">
		<h1>About Us</h1>
	</div>

	<section class="about">
		<div class="image">
			<img src="sigiriya.jpg">
		</div>
		<div class="content">
			<h3>Why Choose us?</h3>
			<p>Ceylon Travels offers exciting and affordable Sri Lanka tour packages, Our  Sri Lanka Tour Packages Includes Family Tours & Budget Tour. Through this website, we invite you to take a glimpse of Sri Lanka, which is not only the lustrous Pearl of the Indian Ocean but one of the most exciting locations for your next tour or vacation. You will be enticed by the rich diversity of sights and sensations that this little island has to offer. Step onto the island and discover it. This is your one-stop travel shop to find and book the best travel packages Sri Lanka has to offer. Choose a tour package or create one of your own and leave the rest to us. Our Tour Packages include accommodation in 3 to 5 star hotels, meals (breakfast & dinner), entrances for sightseeing, wild life safaris; elephant back rides; and whale and dolphin watching. Contact us now and get one step closer to your dream Sri Lanka tour today. Our aim is to surpass your expectations in all ways by providing a unique, unforgettable travel experience that reflects the traveler’s true desires and interests and performing this service with professionalism, creativity, and knowledge. We want our clients to experience the real Sri Lanka, rather than see it.</p>
			<div class="icons-container">
				<div class="icons">
					<i class="fas fa-map"></i>
					<span>Top Destinations</span>
				</div>
				<div class="icons">
					<i class="fas fa-hand-holding-usd"></i>
					<span>Affordable price</span>
				</div>
				<div class="icons">
					<i class="fas fa-headset"></i>
					<span>24/7 guide service</span>
				</div>
			</div>
		</div>
	</section>

	<!--<section class="reviews">
		<div class="reviews-slider">
			<div class="w">
				<div class="slide">
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					</div>
					<p>Thank so much for our wonderful holiday
You did outstanding job of putting this package together I'll be looking out for more amazing deals thank you Kirsty Nixon</p>
					<h3>John Deo</h3>
					<span>Traveler</span>
					<img src="">
				</div>
			</div>
		</div>
	</section>-->

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