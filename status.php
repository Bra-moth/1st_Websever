<?php
require "../private/autoload.php";
session_start();

// Check if the manager is not authenticated, redirect to the login page
if (!isset($_SESSION['manager_authenticated']) || $_SESSION['manager_authenticated'] !== true) {
    header("Location: manager_login.php");
    exit();
}

$Error = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['InsertStatus'])) {
    $ApplicationID = $_POST['ApplicationID'];
    $SelectedStatus = $_POST['NewStatus'];

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the new status into the Status table
    $ApplicationID = mysqli_real_escape_string($connection, $ApplicationID);
    $SelectedStatus = mysqli_real_escape_string($connection, $SelectedStatus);
    
    // Assuming "Status" and "StatusDatetime" are columns in the "Status" table
    $insertStatusQuery = "INSERT INTO Status (ApplicationID, Status, StatusDatetime) 
                          VALUES ('$ApplicationID', '$SelectedStatus', NOW())";
    // NOW() is a MySQL function to insert the current date and time

    if (mysqli_query($connection, $insertStatusQuery)) {
        // Status inserted successfully
        $successMessage = "Status inserted successfully!";
    } else {
        // Error inserting status
        $Error = "Error inserting status: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Manager Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('work2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        #container {
            background-color: #fff;
            border-radius: 8px;
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #title {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }

        a {
            display: block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }

        #allocation-status {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        #error-message {
            color: red;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<<body>
<div id="container">
        <div id="title">Manager Status Update</div>
        
        <?php if (!empty($Error)) : ?>
            <div id="error-message"><?php echo $Error; ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <p><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <!-- Include the form here -->
        <form method="POST" action="status.php">
            <label for="ApplicationID">Application ID:</label>
            <input type="text" name="ApplicationID" required>
            
            <label for="NewStatus">New Status:</label>
            <input type="text" name="NewStatus" required>

            <button type="submit" name="InsertStatus">Update Status</button>
        </form>

        <!-- Display status history as a table (if needed) -->
        <!-- ... -->
    </div>
</body>

</html>