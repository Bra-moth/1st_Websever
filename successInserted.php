<?php
session_start();
require_once "../private/autoload.php";

?>


<!DOCTYPE html>
<html>

<head>
    <title>Success</title>
    <style>
        /* Add CSS styles for the success page here */
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

        #success-message {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        #go-back-button {
            background-color: #00FF7F;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin: 0 auto;
            text-align: center;
        }

        #go-back-button:hover {
            background-color: #87CEFA;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Success</div>
        <div id="success-message">
            Your information has been successfully inserted.
        </div>
        <a href="Student_dashbord.php" id="go-back-button">Go Back to Student Dashboard</a>
    </div>
</body>

</html>