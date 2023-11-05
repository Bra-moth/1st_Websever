<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Portal</title>
    <style>
        /* Add your CSS styles specific to the admin portal here */

        /* Style the background and body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('AdminBackground.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        /* Style the header */
        h1 {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* Style the content container */
        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Style admin functions links */
        .admin-functions {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .admin-button {
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

        .admin-button:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <h1>Welcome to the Admin Portal</h1>
    <div class="content">
        <p>Admin Functions:</p>
        <div class="admin-functions">
            <a href="manage_user.php" class="admin-button">Manage User Accounts</a>
            <a href="view_reports.php" class="admin-button">View Reports</a>
            <a href="system_config.php" class="admin-button">System Configuration</a>
            
        </div>
    </div>
</body>

</html>
