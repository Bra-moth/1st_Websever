<?php
require "../private/autoload.php";
session_start();

// Check if the manager is not authenticated, redirect to the login page
if (!isset($_SESSION['manager_authenticated']) || $_SESSION['manager_authenticated'] !== true) {
    header("Location: manager_login.php");
    exit();
}

$studentInfoHTML = ''; // Initialize student information HTML

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['StudentID'])) {
    // Sanitize and retrieve the student ID from the POST data
    $studentID = mysqli_real_escape_string($connection, $_POST['StudentID']);

    // Query to retrieve student allocation information by student ID
    // ... (previous code)

    // Use a prepared statement
    $query = "SELECT Students.*, Applications.*, Residences.ResidenceName, Allocations.AllocationDate, Allocations.MoveOutDate, Rooms.RoomNumber
    FROM Students
    INNER JOIN Applications ON Students.StudentID = Applications.StudentID
    INNER JOIN Allocations ON Applications.ApplicationID = Allocations.ApplicationID
    INNER JOIN Residences ON Applications.ResidenceID = Residences.ResidenceID
    INNER JOIN Rooms ON Allocations.RoomID = Rooms.RoomID
    WHERE Students.StudentID = ?
    ORDER BY Allocations.AllocationDate DESC
    LIMIT 1";

    // Create a prepared statement
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Bind the studentID parameter
        mysqli_stmt_bind_param($stmt, "s", $studentID); // "s" indicates the parameter is a string

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $studentInfoHTML = "<h1>Student Information</h1>
            <div class='dashboard'>
                <p><strong>Student Number:</strong> " . $row['StudentID'] . "</p>
                <p><strong>Name:</strong> " . $row['FirstName'] . " " . $row['LastName'] . "</p>
                <p><strong>Email:</strong> " . $row['Email'] . "</p>
                <p><strong>Allocation Date:</strong> " . $row['AllocationDate'] . "</p>
                <p><strong>Residence Name:</strong> " . $row['ResidenceName'] . "</p>
                <p><strong>Room Number:</strong> " . $row['RoomNumber'] . "</p>";

            if ($row['MoveOutDate'] !== null) {
                $studentInfoHTML .= "<p><strong>Move Out Date:</strong> " . $row['MoveOutDate'] . "</p>";
            }

            $studentInfoHTML .= "</div>";
        } else {
            $studentInfoHTML = "<p>No student found with the provided Student ID.</p>";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Track Student Movement</title>
    <style>
        /* Include the same CSS styles from manager_dashboard.php here */

        /* Add styles for the track student page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .dashboard {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Additional styles for the track student page */
    </style>
</head>

<body>
    <h1>Track Student Movement</h1>
    <div class="dashboard">
        <form method="POST" action="track_student.php">
            <label for="studentID">Enter Student ID:</label>
            <input type="text" id="studentID" name="StudentID" required>
            <button type="submit" name="Submit">Search</button>
        </form>
        <?php echo $studentInfoHTML; ?>
    </div>
</body>

</html>
