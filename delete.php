<?php
require_once('connection.php');
session_start();

// Check if the user is logged in as an admin. If not, redirect them to the login page.
if (!isset($_SESSION['Email']) || $_SESSION['Email'] !== 'admin@gmail.com') {
    header('location: login.php');
    exit;
}

// If the user is logged in as an admin, they can access this page.

// Check if the form is submitted to delete a package
if (isset($_POST['btnDeletePackage'])) {
    $packageID = $_POST['package_id'];

    // Delete associated booking records first
    $deleteBookingsQuery = "DELETE FROM bookings WHERE package_id = '$packageID'";
    if (mysqli_query($conn, $deleteBookingsQuery)) {
        // Once associated bookings are deleted, delete the package
        $deletePackageQuery = "DELETE FROM packages WHERE package_id = '$packageID'";
        if (mysqli_query($conn, $deletePackageQuery)) {
            echo '<script>alert("Package and associated bookings deleted successfully.")</script>';
        } else {
            echo '<script>alert("Error deleting package.")</script>';
        }
    } else {
        echo '<script>alert("Error deleting associated bookings.")</script>';
    }
}

// Query to fetch packages from the database
$query = "SELECT * FROM packages";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Packages</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="stylelk.css">
</head>
<body>
    <h1>Delete Packages</h1>
    <section class="header">
        <a href="home.php" class="logo">Ceylon Travel.</a>
        <nav class="navbar">
            <a href="fetch_pending_bookings.php">Approve</a>
            <div class="welcome-login">
                <br>
                <?php
                if (isset($_SESSION['Email'])) {
                    echo '<span>Welcome, ' . $_SESSION['Email'] . '</span>';
                    echo '<a href="logout.php">Logout</a>';
                } else {
                    echo '<a href="login.php">Login Here</a>';
                }
                ?>
            </div>
            <a href="delete.php">Delete Packages</a>
            <a href="admin.php">Add Package</a>
            <a href="update.php">update</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <!-- List of Packages with Delete Button -->
    <h2>List of Packages</h2>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Package ID</th>';
        echo '<th>Location</th>';
        echo '<th>Description</th>';
        echo '<th>Image</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['package_id'] . '</td>';
            echo '<td>' . $row['location'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td><img src="' . $row['image_path'] . '" alt="Package Image" style="max-width: 100px;"></td>';
            echo '<td>
                    <form method="post" action="#">
                        <input type="hidden" name="package_id" value="' . $row['package_id'] . '">
                        <button type="submit" name="btnDeletePackage">Delete</button>
                    </form>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No packages available.';
    }
    ?>
    
    <a href="admin.php">Back to Admin Page</a>

</body>
</html>
