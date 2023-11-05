<?php
require "../private/autoload.php";
session_start();

$Error = "";

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get the submitted form data
    $applicationID = $_POST['ApplicationID'];

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Perform the following steps within a database transaction for data consistency
    mysqli_begin_transaction($connection);

    try {
        // Update the room status in the rooms table
        $updateRoomStatusQuery = "UPDATE rooms SET Occupied = 'No' WHERE RoomID = (
            SELECT RoomID FROM allocations WHERE ApplicationID = $applicationID
        )";

        if (mysqli_query($connection, $updateRoomStatusQuery)) {
            // Room status updated to 'No' successfully

            // Insert the current date and time into the AllocationDate column in the allocations table
            $insertAllocationDateQuery = "UPDATE allocations SET moveoutdate = NOW() WHERE ApplicationID = $applicationID";

            if (mysqli_query($connection, $insertAllocationDateQuery)) {
                // Allocation date updated successfully

                mysqli_commit($connection);
            } else {
                $Error = "Error updating allocation date: " . mysqli_error($connection);
                mysqli_rollback($connection);
            }
        } else {
            $Error = "Error updating room status: " . mysqli_error($connection);
            mysqli_rollback($connection);
        }
    } catch (Exception $e) {
        // If any error occurs, rollback the transaction and handle the error
        $Error = "Error: " . $e->getMessage();
        mysqli_rollback($connection);
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Move-Out</title>
    <style>
        /* Your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('Room1.jpg');
            /* Replace with your image URL */
            background-size: cover;
            /* Cover the entire viewport */
            background-repeat: no-repeat;
            /* Prevent image repetition */
            background-attachment: fixed;
            /* Fixed background */
            margin: 0;
            padding: 0;
            overflow-y: scroll;
        }

        /* Add your existing styles for headers, buttons, and forms here */

        #container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #title {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Move-Out</div>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <h3>Move-Out Form</h3>
        <form method="post">
            <label for="ApplicationID">Enter Application ID:</label>
            <input type="text" name="ApplicationID" required><br>
            <input type="submit" value="Submit">
        </form>

        <!-- Display success message or errors here if needed -->
        <?php if (!empty($Error)) : ?>
            <p>Error: <?php echo $Error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>
