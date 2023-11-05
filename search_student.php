<?php
require "../private/autoload.php"; // Include your database connection and other necessary code
session_start();

$Error = "";
$result = null;

// Check if a request was made to retrieve data
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['retrieve_data'])) {
    // Establish a database connection (replace with your connection code)

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

   
    $query = "SELECT 
                a.StudentID AS StudentID,
                a.FirstName AS FirstName,
                a.LastName AS LastName,
                a.Gender AS Gender,
                a.AcademicProgram AS AcademicProgram,

                b.DisabilityCriteria AS DisabilityCriteria,
                b.YearOfStudy AS YearOfStudy,
                b.ResidenceName AS ResidenceName
            FROM Students AS a
            INNER JOIN applications AS b ON a.StudentID = b.StudentID;
            ";
              

    $result = mysqli_query($connection, $query);

    if (!$result) {
        // Handle any database errors here
        $Error = "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Retrieve Data</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('archive1.jpg');
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

        #container {
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
            /* Adjust the font size as needed */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 20px;
        }

        /* Table header styles */
        th {
            background-color: #007bff;
            /* Header background color */
            color: #fff;
            /* Header text color */
            font-weight: bold;
            padding: 10px;
            text-align: left;
        }

        /* Table row styles */
        tr:nth-child(odd) {
            background-color: #f2f2f2;
            /* Alternate row background color */
        }

        tr:nth-child(even) {
            background-color: #fff;
            /* Default row background color */
        }

        /* Table cell styles */
        td, th {
            border: 1px solid #ccc;
            /* Table cell borders */
            padding: 8px;
            text-align: left;
        }

        /* Hover effect on rows */
        tr:hover {
            background-color: #ddd;
            /* Hovered row background color */
        }

        .retrieve-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }

        .retrieve-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="title">Archive</div>
        <form id="retrieveForm" method="POST" action="search_student.php">
            <!-- Add a button to retrieve data -->
            <input type="submit" name="retrieve_data" value="Retrieve Data" class="retrieve-button">
        </form>

        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Academic Program</th>
                    
                    <th>Disability Criteria</th>
                    <th>Year of Study</th>
                    <th>Residence Name</th>
                  </tr>';
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['StudentID'] . '</td>';
                    echo '<td>' . $row['FirstName'] . '</td>';
                    echo '<td>' . $row['LastName'] . '</td>';
                    echo '<td>' . $row['Gender'] . '</td>';
                    echo '<td>' . $row['AcademicProgram'] . '</td>';                   
                    echo '<td>' . $row['DisabilityCriteria'] . '</td>';
                    echo '<td>' . $row['YearOfStudy'] . '</td>';
                    echo '<td>' . $row['ResidenceName'] . '</td>';
                    echo '</tr>';
                }
    
                echo '</table>';
            } else {
                echo '<p></p>';
            }
            ?>
            
    </div>

    <!-- Rest of your HTML content, including the search section -->
</body>
</html>
