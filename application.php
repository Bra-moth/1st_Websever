<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here

$Error = "";

$disabilityCriteriaOptions = ['Yes', 'No'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get values from the form
    $StudentID = $_POST['StudentID']; // Assuming you have a student ID in the session
    $selectedRoomType = $_POST['RoomType'];
    $selectedDisabilityCriteria = $_POST['disability_criteria'];
    $selectedYearOfStudy = $_POST['YearOfStudy'];
    $selectedResidenceName = $_POST['ResidenceName'];

    

    // Initialize variables
    $ResidenceName = ''; // Initialize ResidenceName
    $ApplicationDate = date("Y-m-d H:i:s"); // Current date and time
    $ResidenceID = null; // Initialize ResidenceID
    $RoomTypeID = null; // Initialize RoomTypeID

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Check if the StudentID exists in the Students table
    $checkQuery = "SELECT COUNT(*) AS studentCount FROM students WHERE StudentID = '$StudentID'";
    $result = mysqli_query($connection, $checkQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $studentCount = $row['studentCount'];

        if ($studentCount == 1) {
            // Get the ResidenceID based on the selected Residence Name
            $getResidenceIDQuery = "SELECT ResidenceID FROM Residences WHERE ResidenceName = '$selectedResidenceName'";
            $residenceResult = mysqli_query($connection, $getResidenceIDQuery);

            if ($residenceResult && mysqli_num_rows($residenceResult) > 0) {
                $residenceRow = mysqli_fetch_assoc($residenceResult);
                $ResidenceID = $residenceRow['ResidenceID'];

                // Get the RoomTypeID based on the selected RoomType
                $getRoomTypeIDQuery = "SELECT RoomTypeID FROM RoomTypes WHERE RoomType = '$selectedRoomType'";
                $roomTypeResult = mysqli_query($connection, $getRoomTypeIDQuery);

                if ($roomTypeResult && mysqli_num_rows($roomTypeResult) > 0) {
                    $roomTypeRow = mysqli_fetch_assoc($roomTypeResult);
                    $RoomTypeID = $roomTypeRow['RoomTypeID'];

                    // StudentID exists in the Students table, proceed with the application insertion
                    $query = "INSERT INTO Applications (StudentID, RoomTypeID, ResidenceName, DisabilityCriteria, YearOfStudy, ApplicationDate, ResidenceID)
                          VALUES ('$StudentID', '$RoomTypeID', '$selectedResidenceName', '$selectedDisabilityCriteria', '$selectedYearOfStudy', '$ApplicationDate', '$ResidenceID')";

                    if (mysqli_query($connection, $query)) {
                        // Application data was successfully inserted
                        header("Location: successApplied.php");
                        exit();
                    } else {
                        // Handle errors for the application insertion, if necessary
                        $Error = "Error: " . mysqli_error($connection);
                    }
                } else {
                    // Handle the case where the selected Room Type is not found
                    $Error = "Error: Selected Room Type not found in the RoomTypes table";
                }
            } else {
                // Handle the case where the selected Residence Name is not found
                $Error = "Error: Selected Residence Name not found in the Residences table";
            }
        } else {
            // StudentID doesn't exist in the Students table
            $Error = "Error: Invalid StudentID, Please update Information";
        }
    } else {
        // Handle errors for the SELECT query, if necessary
        $Error = "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Student Residence Application</title>
    <style>
        /* Add CSS styles for the form here */
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8FF;
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
            max-width: 600px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #title {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        form {
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #00FF7F;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #87CEFA;
        }

        .room-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Student Residence Application</div>
        <form method="POST" action="application.php">
            <!-- ... Student information fields ... -->
            <label for="StudentID">Student ID:</label>
            <input type="text" id="StudentID" name="StudentID" required>

            <label for="RoomType">Room Type:</label>
            <select id="RoomType" name="RoomType" required>
                <option value="" disabled selected>Select Room Type</option>
                <?php
                // Populate the dropdown with room types from the RoomTypes table
                $query = "SELECT RoomTypeID, RoomType FROM RoomTypes";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $RoomTypeID = $row['RoomTypeID'];
                    $RoomType = $row['RoomType'];
                    echo '<option value="' . $RoomType . '">' . $RoomType . '</option>';
                }
                ?>
            </select>

            <label for="ResidenceName">Residence Name:</label>
            <select id="ResidenceName" name="ResidenceName" required>
                <option value="" disabled selected>Select Residence Name</option>
                <?php
                // Populate the dropdown with residence names from the Residences table
                $query = "SELECT ResidenceName FROM Residences";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $residenceName = $row['ResidenceName'];
                    echo '<option value="' . $residenceName . '">' . $residenceName . '</option>';
                }
                ?>
            </select>


            <label for="disability_criteria">Disability Criteria:</label>
            <select id="disability_criteria" name="disability_criteria" required>
                <option value="" disabled selected>Select Disability Criteria</option>
                <?php
                foreach ($disabilityCriteriaOptions as $criteria) {
                    echo '<option value="' . $criteria . '">' . $criteria . '</option>';
                }
                ?>
            </select>

            <label for="YearOfStudy">Year of Study:</label>
            <select id="YearOfStudy" name="YearOfStudy" required>
                <option value="" disabled selected>Select Year of Study</option>
                <?php
                // Generate options for years 1 to 4
                for ($year = 1; $year <= 4; $year++) {
                    echo '<option value="' . $year . '">' . $year . '</option>';
                }
                ?>
            </select>



            <input type="submit" value="Submit Application">
        </form>

        <!-- Placeholder images of student accommodations -->

    </div>
</body>

</html>