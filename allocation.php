<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here

$Error = "";

// Check if a request was made to update the status
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['AllocateStudent'])) {
    $StudentID = $_POST['StudentID'];
    $SelectedStatus = $_POST['NewStatus'];
    $ApplicationID = $_POST['ApplicationID'];
    $RoomTypeID = $_POST['SelectedRoomID'];

    // Start a database transaction
    mysqli_begin_transaction($connection);

    try {
        // Check if the selected status is "Accepted" or "Rejected"
        if ($SelectedStatus === 'Accepted' || $SelectedStatus === 'Rejected') {
            // Update the status in the Application table
            $updateApplicationQuery = "UPDATE Applications SET Status = '$SelectedStatus' WHERE ApplicationID = $ApplicationID AND (Status IS NULL OR Status = '')";

            if (mysqli_query($connection, $updateApplicationQuery)) {
                // Query executed successfully
                if ($SelectedStatus === 'Accepted') {
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
                    } else {
                        // No available rooms found, handle this case as needed
                        $Error = "Error: No available rooms.";
                    }
                }
            } else {
                // Query execution failed, handle the error gracefully
                $Error = "Error updating Status: " . mysqli_error($connection);
            }
        } else {
            $Error = "Invalid status selection.";
        }

        mysqli_commit($connection);
    } catch (Exception $e) {
        // If any error occurs, rollback the transaction and handle the error
        mysqli_rollback($connection);
        $Error = "Error: " . $e->getMessage();
    }
}

// Retrieve the list of applications
$query = "
    SELECT
        Applications.ApplicationID,
        Applications.StudentID,
        Applications.RoomTypeID,
        RoomTypes.RoomType,
        Applications.ResidenceName,
        Applications.ApplicationDate,
        Applications.Status
    FROM Applications
    LEFT JOIN roomtypes ON applications.RoomTypeID = roomtypes.RoomTypeID";

$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Allocation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('5unsplash.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            overflow-y: scroll;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        #title {
            background-color: #0000cd;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .Status-form {
            margin-top: 20px;
        }

        select,
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        select {
            width: 100%;
            max-width: 300px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #error-message {
            margin-top: 20px;
            text-align: center;
            color: red;
        }
    </style>
</head
<body>
    <div class="container">
        <div id="title">Allocation</div>
        <table>
            <tr>
                <th>ApplicationID</th>
                <th>StudentID</th>
                <th>RoomType</th>
                <th>ResidenceName</th>
                <th>ApplicationDate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['ApplicationID'] . '</td>';
                echo '<td>' . $row['StudentID'] . '</td>';
                echo '<td>' . $row['RoomType'] . '</td>';
                echo '<td>' . $row['ResidenceName'] . '</td>';
                echo '<td>' . $row['ApplicationDate'] . '</td>';
                echo '<td>' . $row['Status'] . '</td>';
                echo '<td>';
                echo '<form class="Status-form" method="POST" action="allocation.php">';
                echo '<input type="hidden" name="StudentID" value="' . $row['StudentID'] . '">';
                echo '<input type="hidden" name="ApplicationID" value="' . $row['ApplicationID'] . '">';
                echo '<input type="hidden" name="SelectedRoomID" value="' . $row['RoomTypeID'] . '">';
                echo '<select name="NewStatus">';
                echo '<option value="Accepted">Accepted</option>';
                echo '<option value="Pending">Pending</option>';
                echo '<option value="Rejected">Rejected</option>';
                echo '</select>';
                echo '<button type="submit" name="AllocateStudent">Allocate</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <div id="error-message">
            <?php
            if ($Error != "") {
                echo $Error;
            }
            ?>
        </div>
    </div>
</body>
</html>
