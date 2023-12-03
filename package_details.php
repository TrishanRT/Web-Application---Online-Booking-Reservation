<?php 
session_start();

?>
<?php
require_once('connection.php'); // Include the database connection code

// Get the package ID from the URL
if (isset($_GET['id'])) {
    $packageID = $_GET['id'];

    // Fetch package details based on the package ID
    $sql = "SELECT * FROM packages WHERE package_id = '$packageID'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $location = $row['location'];
        $description = $row['description'];
        $imagePath = $row['image_path'];

        // Display package details
        echo '<h2>' . $location . '</h2>';
        echo '<img src="' . $imagePath . '" alt="' . $location . '">';
        echo '<p>' . $description . '</p>';
    } else {
        echo 'Package not found.';
    }
} else {
    echo 'Invalid package ID.';
}

// Close the database connection
mysqli_close($conn);
?>
