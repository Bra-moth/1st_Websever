<?php
// Include your database connection code here
session_start();
require_once "../private/autoload.php"; // Include your database connection code here

// Initialize variables
$Error = "";


// Check if the connection to the database is successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Report 1: Total Number of Students
$report1Query = "SELECT COUNT(*) AS total_students FROM students";
$result1 = mysqli_query($connection, $report1Query);
$row1 = mysqli_fetch_assoc($result1);

// Report 2: Total Number of Residences
$report2Query = "SELECT COUNT(*) AS total_residences FROM residences";
$result2 = mysqli_query($connection, $report2Query);
$row2 = mysqli_fetch_assoc($result2);

// Report 3: Average Room Occupancy
$report3Query = "SELECT COUNT(RoomID) AS avg_occupancy FROM rooms";
$result3 = mysqli_query($connection, $report3Query);
$row3 = mysqli_fetch_assoc($result3);

$report5Query = "SELECT COUNT(ApplicationID) AS applied FROM applications";
$result5 = mysqli_query($connection, $report5Query);
$row5 = mysqli_fetch_assoc($result5);

$report6Query = "SELECT COUNT(AllocationID) AS allocated FROM allocations";
$result6 = mysqli_query($connection, $report6Query);
$row6 = mysqli_fetch_assoc($result6);

// Report 4: List of Residences
$report4Query = "SELECT ResidenceName, Capacity FROM Residences";
$result4 = mysqli_query($connection, $report4Query);



?>

<!DOCTYPE html>
<html>

<head>
    <title>View Reports</title>
    <style>
        /* Add your CSS styles specific to the View Reports page here */
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

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>

<body>
    <h1>View Reports</h1>
    <div class="content">
        <!-- Display Reports -->
        <h2>Reports</h2>
        <p>Total Number of Students: <?php echo $row1["total_students"]; ?></p>
        <p>Total Number of Residences: <?php echo $row2["total_residences"]; ?></p>
        <p>Average Room Occupancy: <?php echo $row3["avg_occupancy"]; ?></p>
        <p>Number Of Students Applied: <?php echo $row5["applied"]; ?></p>
        <p>Number Of Students Allocated: <?php echo $row6["allocated"]; ?></p>

        <h2>List of Residences</h2>
        <table>
            <tr>
                <th>Residence Name</th>
                <th>Capacity</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result4)) {
                echo "<tr>";
                echo "<td>" . $row["ResidenceName"] . "</td>";
                echo "<td>" . $row["Capacity"] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
mysqli_close($connection);
?>