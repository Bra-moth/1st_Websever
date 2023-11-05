<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here


$Error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Get values from the form
  $StudentID = $_POST['StudentID'];
  $firstName = $_POST['FirstName'];
  $lastName = $_POST['LastName'];
  $gender = $_POST['Gender'];
  $dateOfBirth = $_POST['DateOfBirth'];
  $email = $_POST['Email'];
  $phone = $_POST['Phone'];
  $nationalID = $_POST['NationalID'];
  $emergencyContact = $_POST['EmergencyContact'];
  $currentAddress = $_POST['CurrentAddress'];
  $academicProgram = $_POST['AcademicProgram'];
  $username = $_SESSION['username'];


  if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  if (!validateDateOfBirth($dateOfBirth, $nationalID)) {
    $Error = "Error: Date of birth does not match the provided ID.";
  } elseif (date('Y', strtotime($dateOfBirth)) == date('Y')) {
    $Error = "Error: Invalid date of birth (current year).";
  }


  // Insert the student's information into the Students table
  if ($Error === "") {
    // Insert the student's information into the database
    $query = "INSERT INTO students (StudentID, FirstName, LastName, Gender, DateOfBirth, Email, Phone, NationalID, EmergencyContact, CurrentAddress, AcademicProgram, username)
              VALUES ('$StudentID', '$firstName', '$lastName', '$gender', '$dateOfBirth', '$email', '$phone', '$nationalID', '$emergencyContact', '$currentAddress', '$academicProgram', '$username')";

    if (mysqli_query($connection, $query)) {
      // Information was successfully inserted
      header("Location: successInserted.php");
      exit();
    } else {
      // Handle errors for the insertion operation, if necessary
      $Error = "Error: " . mysqli_error($connection);
    }
  }

  // Close the database connection
  mysqli_close($connection);
}
// Function to validate date of birth against national ID
function validateDateOfBirth($dateOfBirth, $nationalID) {
  // Extract the year part from the national ID
  $nationalIDYear = substr($nationalID, 0, 2);

  // Extract the year part from the date of birth
  $dobYear = date('y', strtotime($dateOfBirth));

  // Check if the years match
  return $nationalIDYear == $dobYear;
}



?>


<!DOCTYPE html>
<html>

<head>
  <title>Student Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

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

    form {
      margin: 20px 0;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    #textbox {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    #error-message {
      color: red;
      text-align: center;
    }

    #next-page-link {
      position: absolute;
      top: 10px;
      right: 10px;
      text-decoration: none;
      background-color: #007bff;
      color: #fff;
      padding: 5px 10px;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div id="container">
    <div id="title">Student Information</div>
    <form method="POST" action="update_information.php">
      <div id="error-message">
        <?php if (isset($Error) && $Error != "") {
          echo '<div style="color: red;">' . $Error . '</div>';
        } ?>
      </div>
      <label for="FirstName">First Name:</label>
      <input id="textbox" type="text" name="FirstName" required><br>

      <label for="LastName">Last Name:</label>
      <input id="textbox" type="text" name="LastName" required><br>

      <label for="Gender">Gender:</label>
      <select id="Gender" name="Gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select><br>

      <label for="StudentID">Student ID:</label>
      <input id="textbox" type="text" name="StudentID">

      <label for="DateOfBirth">Date of Birth:</label>
      <input id="textbox" type="date" name="DateOfBirth" required><br>

      <label for="Email">Email:</label>
      <input id="textbox" type="email" name="Email" required><br>

      <label for="Phone">Phone:</label>
      <input id="textbox" type="text" name="Phone"><br>

      <label for="NationalID">National ID/Passport:</label>
      <input id="textbox" type="text" name="NationalID"><br>

      <label for="EmergencyContact">Emergency Contact:</label>
      <input id="textbox" type="text" name="EmergencyContact"><br>

      <label for="CurrentAddress">Current Address:</label>
      <textarea id="textbox" name="CurrentAddress" rows="3"></textarea><br>

      <label for="AcademicProgram">Academic Program/Department:</label>
      <input id="textbox" type="text" name="AcademicProgram"><br>


      <input type="submit" value="Submit">
    </form>
  </div>

</body>

</html>