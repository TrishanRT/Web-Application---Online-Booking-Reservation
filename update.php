<?php
require_once('connection.php');
session_start();

// Check if the user is logged in as an admin. If not, redirect them to the login page.
if (!isset($_SESSION['Email']) || $_SESSION['Email'] !== 'admin@gmail.com') {
    header('location: login.php');
    exit;
}

// If the user is logged in as an admin, they can access this page.

// Function to generate a unique package ID
function generatePackageID() {
    // You can customize this function to generate unique package IDs as needed.
    return uniqid('PKG');
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

// Check if the form is submitted for updating a package
if (isset($_POST["btnUpdatePackage"])) {
    $packageID = $_POST["package_id"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $imagePath = isset($_POST["image_path"]) ? $_POST["image_path"] : ''; // Existing image path

    // Handle image upload (optional)
    if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
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
                // Update the image path in the database
                $imagePath = $targetFile;
            } else {
                echo '<script>alert("Error uploading image.")</script>';
            }
        }
    }

    // Perform SQL query to update the package details in the database
    $sql = "UPDATE packages SET location = '$location', description = '$description', image_path = '$imagePath' WHERE package_id = '$packageID'";

    // Execute the query (assuming $conn is your database connection)
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Package updated successfully")</script>';
    } else {
        echo '<script>alert("Error updating package")</script>';
    }
}

// Fetch packages from the database
$sql = "SELECT * FROM packages";
$result = mysqli_query($conn, $sql);
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

    <!-- Package Listing -->
    <h2>Package List</h2>
    <table>
        <thead>
            <tr>
                <th>Package ID</th>
                <th>Location</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $packageID = $row['package_id'];
                    $location = $row['location'];
                    $description = $row['description'];
                    $imagePath = $row['image_path'];
                    ?>
                    <tr>
                        <td><?php echo $packageID; ?></td>
                        <td><?php echo $location; ?></td>
                        <td><?php echo $description; ?></td>
                        <td>
                            <form action="#" method="post">
                                <input type="hidden" name="package_id" value="<?php echo $packageID; ?>">
                                <input type="hidden" name="location" value="<?php echo $location; ?>">
                                <input type="hidden" name="description" value="<?php echo $description; ?>">
                                <input type="hidden" name="image_path" value="<?php echo $imagePath; ?>">
                                <input type="submit" class="btn btn-success" name="btnEditPackage" value="Edit">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="4">No packages available</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Edit Package Form -->
    <?php
    if (isset($_POST["btnEditPackage"])) {
        $editPackageID = $_POST["package_id"];
        $editLocation = $_POST["location"];
        $editDescription = $_POST["description"];
        $editImagePath = $_POST["image_path"];
        ?>
        <h2>Edit Package</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="package_id" value="<?php echo $editPackageID; ?>">
            <div>
                <label for="location">Location:</label>
                <input type="text" name="location" value="<?php echo $editLocation; ?>" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $editDescription; ?></textarea>
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" name="image" accept="image/*">
            </div>
            <input type="hidden" name="image_path" value="<?php echo $editImagePath; ?>">
            <input type="submit" class="btn btn-success" name="btnUpdatePackage" value="Update Package">
        </form>
        <?php
    }
    ?>
</body>
</html>
