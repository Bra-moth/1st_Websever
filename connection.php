<?php
require_once "../private/autoload.php"; // Include your database connection code here

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    echo "Database connection successful.";
}
