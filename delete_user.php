<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here

if (isset($_GET['id'])) {
    $usernameToDelete = $_GET['id'];

    // Define and execute the SQL query to delete the user and associated student details
    $sql = "DELETE users, students
            FROM users
            LEFT JOIN students ON users.username = students.username
            WHERE users.username = '$usernameToDelete'";

    if (mysqli_query($connection, $sql)) {
        // Deletion was successful, you can display a success message and a "Go Back" button.
        echo "User and associated student details have been successfully deleted.<br>";
        echo '<a href="manage_user.php">Go Back to User Management</a>';
    } else {
        // Error handling: Display an error message or handle the error as needed.
        echo "Error: " . mysqli_error($connection);
    }
} else {
    // Handle the case where the 'id' parameter is missing or invalid.
    echo "Invalid request. User not found.";
}

mysqli_close($connection);
