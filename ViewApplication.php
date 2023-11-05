<?php
require "../private/autoload.php";
session_start();

$Error = "";
$resultData = null;

// Check if a request was made to retrieve data
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['retrieve_data'])) {
    // Retrieve data by joining the Applications and Status tables using ApplicationID
    $query = "SELECT A.ApplicationID, A.StudentID, A.DisabilityCriteria, A.ResidenceName, S.ApplicationStatus
              FROM Applications A
              LEFT JOIN Status S ON A.ApplicationID = S.ApplicationID";
    
    $resultData = mysqli_query($connection, $query);

    if (!$resultData) {
        // Handle any database errors here
        $Error = "Error: " . mysqli_error($connection);
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Retrieve Data</title>
    <style>
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

        #title {
            background-color: #0000cd;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 24px;
            /* Adjust the font size as needed */
        }

        /* Add CSS styles for the label and input container here */
        .input-container {
            position: relative;
        }

        label {
            position: absolute;
            top: 10px;
            left: 10px;
            pointer-events: none;
            transition: 0.2s ease all;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        input:focus+label,
        input:not(:placeholder-shown)+label {
            top: -10px;
            font-size: 12px;
            background-color: #fff;
            padding: 0 5px;
        }


        .retrieve-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .retrieve-button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
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
        td,
        th {
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

        .search-section {
            margin-top: 20px;
            text-align: center;
        }


        h2 {
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
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

        /* Add styles for search results if needed */
        .search-results {
            margin-top: 20px;
        }
        .merged-table {
            margin-top: 20px;
        }

        /* Add styles for the table header in the merged table */
        .merged-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Archive</div>
        <form method="POST" action="ViewApplication.php">
            <!-- Add a button to retrieve data -->
            <input type="submit" name="retrieve_data" value="Retrieve Data" class="retrieve-button">
        </form>

        <!-- Display the retrieved data as a table -->
  <!-- Display the retrieved data from Applications table as a table -->
  <?php
        if ($resultData && mysqli_num_rows($resultData) > 0) {
            echo '<table class="merged-table">';
            echo '<tr><th>ApplicationID</th><th>StudentID</th><th>DisabilityCriteria</th><th>ResidenceName</th><th>Status</th></tr>';

            while ($row = mysqli_fetch_assoc($resultData)) {
                echo '<tr>';
                echo '<td>' . $row['ApplicationID'] . '</td>';
                echo '<td>' . $row['StudentID'] . '</td>';
                echo '<td>' . $row['DisabilityCriteria'] . '</td>';
                echo '<td>' . $row['ResidenceName'] . '</td>';
                echo '<td>' . $row['ApplicationStatus'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>Select Retrieve to display data.</p>';
        }
        ?>


    </div>
    <div class="search-section">
        <h2>Search for Student Information</h2>
        <form method="POST" action="search_student.php">

        
            <button type="submit">Search</button>
        </form>
        <!-- Display search results here -->
        <div class="search-results" id="searchResults">
</body>

</html>