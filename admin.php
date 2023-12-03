<?php
require_once('connection.php');
session_start();

// Check if the user is logged in as an admin. If not, redirect them to the login page.
if (!isset($_SESSION['Email']) || $_SESSION['Email'] !== 'admin@gmail.com') {
    header('location: login.php');
    exit;
}

// If the user is logged in as an admin, they can access this page.

// Define a function to generate a unique package ID
function generatePackageID() {
    // You can customize this function to generate unique package IDs as needed.
    return uniqid('PKG');
}

// Check if the form is submitted
if (isset($_POST["btnAddPackage"])) {
    $packageID = generatePackageID();
    $location = $_POST["location"];
    $description = $_POST["description"];

    // Handle image upload
    $targetDir = "upload/"; // Directory where images will be stored
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo '<script>alert("File is not an image.")</script>';
    } else {
        // Generate a unique filename for the image
        $uniqueFilename = generateUniqueFilename($targetDir, $imageFileType);
        $targetFile = $targetDir . $uniqueFilename;

        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Perform SQL query to insert the package details into the database
            // Include the image file path in the SQL query
            $sql = "INSERT INTO packages (package_id, location, description, image_path) VALUES ('$packageID', '$location', '$description', '$targetFile')";

            // Execute the query (assuming $conn is your database connection)
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Package added successfully")</script>';
            } else {
                echo '<script>alert("Error adding package")</script>';
            }
        } else {
            echo '<script>alert("Error uploading image.")</script>';
        }
    }
}

// Function to generate a unique filename to prevent overwriting existing images
function generateUniqueFilename($targetDir, $fileExtension) {
    $uniqueFilename = uniqid() . "." . $fileExtension;
    $targetFile = $targetDir . $uniqueFilename;

    // Check if the generated filename already exists; if it does, regenerate it
    while (file_exists($targetFile)) {
        $uniqueFilename = uniqid() . "." . $fileExtension;
        $targetFile = $targetDir . $uniqueFilename;
    }

    return $uniqueFilename;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="stylelk.css">
</head>
<body>
    <h1>Welcome to the Admin Page</h1>
        <section class="header">
        <a href="home.php" class="logo">Ceylon Travel.</a>

        <nav class="navbar">
            <a href="fetch_pending_bookings.php">Approve</a>
             <div class="welcome-login">
            <br><?php
                    if (isset($_SESSION['Email'])) {
                        echo '<span>Welcome, ' . $_SESSION['Email'] . '</span>';
                        echo '<a href="logout.php">Logout</a>';
                    } else {
                        echo '<a href="login.php">Login Here</a>';
                    }
                    ?>
                </div>
            <a href="delete.php">Delete</a>
            <a href="update.php">Update</a>
         

        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <!-- Package Data Entry Form -->
    <h2>Add Package</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" required></textarea>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        <input type="submit" class="btn btn-success" name="btnAddPackage" value="Add Package">
    </form>

    <a href="logout.php">Logout</a> <!-- Logout link -->
</body>
</html>
