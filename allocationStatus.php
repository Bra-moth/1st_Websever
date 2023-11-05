<?php

require_once "../private/autoload.php";
session_start();

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection code here

// Query to retrieve the allocation status for the logged-in use0r

$username = $_SESSION['username'];
$query = "SELECT st.ApplicationStatus, r.ResidenceName, ro.RoomNumber
FROM students s
JOIN applications a ON s.StudentID = a.StudentID
JOIN residences r ON a.ResidenceID = r.ResidenceID
LEFT JOIN rooms ro ON r.ResidenceID = ro.ResidenceID
JOIN users u ON u.username = s.username
LEFT JOIN allocations alo ON alo.ApplicationID = a.ApplicationID
LEFT JOIN Status st ON a.ApplicationID = st.ApplicationID
WHERE u.username = '$username'
";


$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Check if a row was found
// Existing code to fetch data
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $allocationStatus = $row['ApplicationStatus'];
    $residenceName = $row['ResidenceName'];
    $roomNumber = $row['RoomNumber'];
} else {
    $allocationStatus = "No allocation status available.";
    $residenceName = "N/A";
    $roomNumber = "N/A";
}


if ($allocationStatus === "Rejected") {
    $allocationStatus = "";
}

if ($allocationStatus === "Approved") {
    $roomNumberText = "Room Number: $roomNumber";
} else {
    $roomNumberText = "Room Number: N/A";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Allocation Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('1unsplash.jpg');
            /* Replace with your image URL */
            background-size: cover;
            /* Cover the entire viewport */
            background-repeat: no-repeat;
            /* Prevent image repetition */
            background-attachment: fixed;
            /* Fixed background */
            margin: 0;
            padding: 0;
        }

        #container {
            background-color: #fff;
            border-radius: 8px;
            margin: 20px auto;
            padding: 20px;
            max-width: 400px;
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
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Allocation Status</div>
        <h1>Allocation Status for <?php echo $_SESSION['username']; ?></h1>

        <div id="allocation-status">
            <p>Status: <?php echo $allocationStatus; ?></p>
            <p>Residence Name: <?php echo $residenceName; ?></p>
            <p><?php echo $roomNumberText; ?></p>

            <?php
            if ($allocationStatus === "accepted") {
                echo "<p>Room Number: $roomNumber</p>";
            }
            ?>
        </div>


        <p><a href="Student_dashbord.php">Back to Dashboard</a></p>
        <p><a href="Home.php">Logout</a></p>
    </div>
</body>

</html>