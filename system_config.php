<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here

// Check if the database connection is successful
$Error = '';
$applicationDeadline = ''; // Initialize a variable to store the application deadline

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the new value for the application deadline from the form field
    $newDeadline = $_POST["application_deadline"];

    // Update the system configuration settings (application deadline)
    $queryConfig = "UPDATE SystemConfig SET ApplicationDeadline='$newDeadline'";

    // Use a transaction to ensure the update succeeds or fails together
    mysqli_autocommit($connection, false);

    // Execute the query and check for errors
    if (!mysqli_query($connection, $queryConfig)) {
        $Error = "Error updating Application Deadline: " . mysqli_error($connection);
        mysqli_rollback($connection);
    } else {
        $applicationDeadline = $newDeadline; // Set the variable with the new deadline
        mysqli_commit($connection);
        echo "Application Deadline updated successfully";
    }

    mysqli_autocommit($connection, true);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>System Configuration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
        }

        h2 {
            font-size: 18px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            margin-top: 20px;
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <h1>System Configuration</h1>
    <div class="content">
        <h2>System Settings</h2>
        <form method="post" action="system_config.php">
            <label for="application_deadline">Enter Application Deadline (YYYY-MM-DD):</label>
            <input type="text" name="application_deadline" placeholder="YYYY-MM-DD" required>
            <br>
            <input type="submit" value="Save Application Deadline">
        </form>
        <div class="error-message">
            <?php
            if ($Error != "") {
                echo $Error;
            }
            ?>
        </div>
    </div>
    <?php
    if (!empty($applicationDeadline)) {
        echo "<p>Current Application Deadline: $applicationDeadline</p>";
    }
    ?>
</body>

</html>
