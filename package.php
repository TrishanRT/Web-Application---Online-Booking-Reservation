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
	<title>packages</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

<style>
    /* Style the navigation bar */
.navbar {
    background-color: #007BFF; /* Background color */
    padding: 10px 0; /* Add padding to the top and bottom */
    text-align: center; /* Center-align the links */
    position: relative; /* Make it relative for positioning */
}

/* Style the navigation bar links */
.navbar a {
    text-decoration: none; /* Remove underlines from links */
    color: #fff; /* Text color for links */
    margin: 0 20px; /* Add margin between links */
    font-weight: bold; /* Make the text bold */
    font-size: 18px; /* Set the font size */
    position: relative; /* Make it relative for positioning */
}

/* Style the welcome message */
.navbar span {
    color: #fff; /* Text color for the welcome message */
    margin-right: 10px; /* Add some space on the right side */
    font-weight: bold; /* Make the text bold */
}

/* Style the logout link */
.navbar a.logout {
    color: #dc3545; /* Text color for logout link */
    position: absolute; /* Position it absolutely */
    top: 50%; /* Center vertically */
    right: 20px; /* Adjust right margin */
    transform: translateY(-50%); /* Center vertically */
    font-weight: bold; /* Make the text bold */
}

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
			<a href="package.php">Package</a>
			<!--<a href="my_bookings.php">Book</a>-->
			<a href="my_bookings.php">My Booking</a>
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

	<div class="heading" style="background: url(packages.jpg) no-repeat;">
		<h1>Packages</h1>
	</div>
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
 echo '<a href="booking.php?package_id=' . $packageID . '" class="book-button">Book Now</a>';
    

echo '</div>';

    }
} else {
    echo 'No packages available.';
}

// Close the database connection
mysqli_close($conn);
?>






</body>
</html>