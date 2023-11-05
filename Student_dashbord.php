<?php
session_start();

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


// Process form submissions for each option (apply for residence, move-in, move-out).
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['apply_for_residence'])) {
        // Handle the "Apply for Residence" form submission here.
        // You can redirect to an application form or process the application logic.
        header("Location: application.php");
        exit();
    } elseif (isset($_POST['move_out'])) {
        // Handle the "Move-Out" form submission here.
        // You can redirect to a move-out form or process the move-out logic.
        header("Location: move_out.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Dashboard</title>
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

        form {
            margin: 20px 0;
            text-align: center;
            /* Center the buttons */
        }

        button {
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

        button:hover {
            transform: scale(1.1);
        }

        h3 {
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


        #error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Student Dashboard</div>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <!-- Inside your form on student_dashboard.php -->
        <form method="post">
            <button><a href="application.php">Apply for Residence</a></button>

            
            <button type="submit" name="move_out">Move-Out</button>
            <!-- Add the "Update Information" button -->
            <button><a href="update_information.php">Update Information</a></button>
        </form>


        <h3>Check Allocation Status</h3>
        <p><a href="allocationStatus.php">Check Allocation Status</a></p>


        <p><a href="Home.php">Logout</a></p>
    </div>
</body>

</html>