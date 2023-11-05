<?php
require "../private/autoload.php";
session_start();

// Check if the manager is not authenticated, redirect to the login page
if (!isset($_SESSION['manager_authenticated']) || $_SESSION['manager_authenticated'] !== true) {
    header("Location: manager_login.php");
    exit();
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Manager Dashboard</title>
    <style>
        /* Add CSS styles for the dashboard here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('unsplash.jpg');
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

        .dashboard {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
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

        label {
            margin-bottom: 10px;
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
    </style>
</head>

<body>
    <h1>Manager Dashboard</h1>
    <div class="dashboard">
        <h2>Welcome, Residence Manager!</h2>
        <p>You are now authenticated as a manager.</p>
        <a href="ViewApplication.php">Residence Applications</a>
        <a href="update_status.php">Admit Students into Residence</a>
        <a href="AllocateRoom.php">Room Allocation</a>
        <a href="track_student.php">Track Student Movement</a>

    </div>
    <div class="search-section">
        <h2>Search for Student Information</h2>
        <form method="POST" action="search_student.php">
            <label for="studentID">Enter Student ID:</label>
            <input type="text" id="studentID" name="studentID" required>
            <button type="submit">Search</button>
        </form>
        <!-- Display search results here -->
        <div class="search-results" id="searchResults">
            <!-- Search results will be displayed here -->
        </div>
    </div>
</body>

</html>