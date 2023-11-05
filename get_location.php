<?php
// Include your database connection code here

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['accommodation'])) {
    $selectedAccommodation = $_POST['accommodation'];

    // Query the AccommodationLocation table to get the location based on the selected accommodation
    $query = "SELECT Location FROM AccommodationLocation WHERE AccommodationName = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $selectedAccommodation);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $location);

    if (mysqli_stmt_fetch($stmt)) {
        echo $location;
    } else {
        echo "Location not found"; // Handle the case where no location is found
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request";
}
