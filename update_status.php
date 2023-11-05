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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['InsertStatus'])) {
    // Get the input data
    $ApplicationID = $_POST['ApplicationID'];
    $SelectedStatus = $_POST['NewStatus'];

    // Escape the input data to prevent SQL injection
    $ApplicationID = mysqli_real_escape_string($connection, $ApplicationID);
    $SelectedStatus = mysqli_real_escape_string($connection, $SelectedStatus);

    // Check if a record with the same ApplicationID exists in the Status table
    $checkExistingQuery = "SELECT ApplicationID FROM Applications WHERE ApplicationID = '$ApplicationID'";
    $result = mysqli_query($connection, $checkExistingQuery);

    if (mysqli_num_rows($result) > 0) {
        // Update the existing record
        $insertStatusQuery = "INSERT INTO Status (ApplicationID, ApplicationStatus, Date) VALUES ('$ApplicationID', '$SelectedStatus', NOW())";
        if (mysqli_query($connection, $insertStatusQuery)) {
            // Status updated successfully
            $successMessage = "Status updated successfully!";
        } else {
            $Error = "Error updating status: " . mysqli_error($connection);
        }
    } else {
        $Error = "ApplicationID does not exist in the Status table.";
    }

    // Close the database connection
    mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Manager Status</title>
    <style>
        .error-message-floating {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: red;
            color: white;
            text-align: center;
            padding: 10px;
            z-index: 9999;
        }

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

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
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

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
    <script>
        // Check if PHP has set the error message
        var errorMessage = "<?php echo $Error; ?>";

        // Check if the error message is not empty
        if (errorMessage.trim() !== "") {
            // Create a floating error message element
            var errorDiv = document.createElement("div");
            errorDiv.className = "error-message-floating";
            errorDiv.textContent = errorMessage;

            // Append the error message to the body
            document.body.appendChild(errorDiv);

            // Set a timeout to remove the error message and reload the page
            setTimeout(function() {
                errorDiv.style.display = "none";
                location.reload(); // Reload the page
            }, 5000); // Adjust the timeout (5 seconds in this example)
        }
    </script>

</head>

<body>
    <div id="container">
        <div id="title">Manager Status Update</div>

        <?php if (!empty($Error)) : ?>
            <div id="error-message"><?php echo $Error; ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <p><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <form method="POST" action="update_status.php">
            <label for="ApplicationID">Application ID:</label>
            <input type="text" name="ApplicationID" required>

            <label for="NewStatus">New Status:</label>
            <select name="NewStatus" required>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>

            <button type="submit" name="InsertStatus">Update Status</button>
        </form>
    </div>
</body>

</html>