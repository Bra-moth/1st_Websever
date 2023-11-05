<?php
// Include your database connection code here
require_once "../private/autoload.php";

$Error = "";
$studentsarr = []; // To store search results

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['Search'])) {
    // Retrieve the search term (StudentID) from the form
    $searchTerm = $_POST['StudentID'];


$query = "SELECT a.ResidenceName, c.AllocationDate, r.RoomNumber
          FROM applications a
          INNER JOIN residences b ON b.ResidenceID = a.ResidenceID
          INNER JOIN allocations c ON c.ApplicationID = a.ApplicationID
          LEFT JOIN rooms r ON r.RoomID = c.RoomID
          WHERE a.StudentID = '$searchTerm'
          ";
    // Execute the query
    $result = mysqli_query($connection, $query);

    if (!$result) {
        // Handle errors, e.g., display an error message or log the error
        $Error = "Error: " . mysqli_error($connection);
    } else {
        // Fetch and store the search results in the $students array
        while ($row = mysqli_fetch_assoc($result)) {
            $studentarr[] = $row;
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Show Status</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            /*background-image: url('Student4.jpg');
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
            text-align: center;
            cursor: pointer;
        }

        p {
            font-size: 18px;
        }

        .login-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .login-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .login-button:hover {
            transform: scale(1.1);
        }

        .room-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
        }

        .room-image {
            width: 200px;
            height: 200px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s ease;
            animation: slideshow 10s infinite;
            /* Add a slideshow animation */
        }

        .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .room-image:hover {
            transform: scale(2);
            /* Adjust the scale factor for the desired zoom level */
            cursor: pointer;
            animation: none;
            /* Disable animation on hover */
        }
    </style>
</head>

<body>
    <div id="container">

        <div id="error-message">
            <?php if ($Error != "") {
                echo '<div style="color: red;">' . $Error . '</div>';
            } ?>
        </div>


            <div id="search-results">
            <?php
            if (!empty($studentsarr)) {
                echo '<h2>Search Results:</h2>';
                echo '<table border="1">';
                echo '<tr><th>Student ID</th><th>Residence Name</th><th>Allocation Date</th><th>Room Number</th></tr>';
                foreach ($studentsarr as $student) {
                    echo '<tr>';
                    echo '<td>' . $searchTerm . '</td>';
                    echo '<td>' . $student['ResidenceName'] . '</td>';
                    echo '<td>' . $student['AllocationDate'] . '</td>';
                    echo '<td>' . $student['RoomNumber'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No results found.</p>';
            }
            ?>
        </div>
            <form method="POST" action="Status_check.php">
                <input type="text" name="StudentID" value="Search">
                <button type="submit" name="Search">Search</button>
            </form>
    </div>
</body>

</html>