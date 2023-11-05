<?php
require "../private/autoload.php";
session_start();

$Error = "";
$successMessage = "";

// Check if the manager is not authenticated, redirect to the login page
if (!isset($_SESSION['manager_authenticated']) || $_SESSION['manager_authenticated'] !== true) {
    header("Location: manager_login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['AllocateStudent'])) {
    $ApplicationID = $_POST['ApplicationID'];

    // Check the ApplicationStatus using the entered ApplicationID
    $checkStatusQuery = "SELECT ApplicationStatus FROM Status WHERE ApplicationID = $ApplicationID";
    $statusResult = mysqli_query($connection, $checkStatusQuery);

    if ($statusResult && mysqli_num_rows($statusResult) > 0) {
        $row = mysqli_fetch_assoc($statusResult);
        $ApplicationStatus = $row['ApplicationStatus'];

        if ($ApplicationStatus === 'Approved') {
            // Find an available room (room with no allocation date)
            $findAvailableRoomQuery = "
                SELECT Rooms.RoomID
                FROM Rooms
                LEFT JOIN Allocations ON Rooms.RoomID = Allocations.RoomID
                WHERE Occupied = 'No'";

            $result = mysqli_query($connection, $findAvailableRoomQuery);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $RoomID = $row['RoomID'];

                // Insert a new allocation into the Allocations table with the same ApplicationID and the selected RoomID
                $insertAllocationQuery = "INSERT INTO Allocations (AllocationDate, ApplicationID, RoomID) VALUES (NOW(), $ApplicationID, $RoomID)";
                mysqli_query($connection, $insertAllocationQuery);

                // Update the "Occupied" status of the allocated room to 'Yes'
                $updateRoomOccupiedQuery = "UPDATE Rooms SET Occupied = 'Yes' WHERE RoomID = $RoomID";
                mysqli_query($connection, $updateRoomOccupiedQuery);
                $successMessage = "Room allocated successfully!";
            } else {
                $Error = "Error: No available rooms.";
            }
        } else {
            $Error = "Error: Student not accepted.";
        }
    } else {
        $Error = "Error: Application ID not found.";
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Allocate Room</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- Add your CSS styles here -->
</head>
<body>
    <h1>Allocate Room</h1>
    <div id="container">
        <form method="POST" action="allocateroom.php">
            <label for="ApplicationID">Application ID:</label>
            <input type="text" id="ApplicationID" name="ApplicationID" required>
            <button type="submit" name="AllocateStudent">Allocate Room</button>
        </form>
        <?php if (!empty($Error)) : ?>
            <div id="error-message"><?php echo $Error; ?></div>
        <?php endif; ?>
        <?php if (!empty($successMessage)) : ?>
            <p><?php echo $successMessage; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>



