<?php
session_start();

// Include your database connection code here
require_once "../private/autoload.php";

$Error = "";

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $RoomNumber = $_POST['RoomNumber'];
    $ResidenceName = $_POST['ResidenceName'];

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the ResidenceID based on the selected ResidenceName
    $sqlGetResidenceID = "SELECT ResidenceID FROM residences WHERE ResidenceName = '$ResidenceName'";
    $result = mysqli_query($connection, $sqlGetResidenceID);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ResidenceID = $row['ResidenceID'];

        // Insert the move-in data into the Rooms table
        $sqlRooms = "INSERT INTO rooms (RoomNumber, ResidenceID, Occupied)
            VALUES ('$RoomNumber', '$ResidenceID', 'No')";

        if (mysqli_query($connection, $sqlRooms)) {
            // Rooms data inserted successfully
            echo "Rooms data saved successfully.";
        } else {
            // Error in inserting Rooms data
            $Error = "Error in inserting Rooms data: " . mysqli_error($connection);
        }
    } else {
        // Handle the case where ResidenceName is not found in the residences table
        $Error = "ResidenceName not found in the database.";
    }

    mysqli_close($connection);
}
?>






<!DOCTYPE html>
<html>

<head>
    <title>Move-In</title>
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

        input[type="date"],
        select {
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
        <div id="title">Move In</div>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <h3>Create Room Form</h3>
        <form method="post">
            <label for="room_number">Room Number:</label>
            <input type="text" name="RoomNumber" required><br>

            <label for="residence_name">Residence Name:</label>
            <input type="text" name="ResidenceName" required><br> <!-- This line is added -->

            <input type="submit" value="Submit">
        </form>


        <!-- Display success message or errors here if needed -->
    </div>
</body>

</html>