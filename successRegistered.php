<?php
session_start();
require "../private/autoload.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Successful</title>
</head>

<body style="font-family: sans-serif;">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #title {
            background-color: rgb(40, 40, 208);
            padding: .5em;
            text-align: center;
            color: white;
        }

        .success-message {
            margin: 50px auto;
            max-width: 400px;
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .login-button {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        h2 {
            color: #007bff;
        }

        p {
            font-size: 18px;
        }

        .login-button a {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .login-button a:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
    </style>
    <div id="title">Registration Successful</div>
    <div class="success-message">
        <h2>Your registration was successful!</h2>
        <p>Thank you for signing up.</p>
        <p>You can now proceed to log in using your credentials.</p>
    </div>
    <div class="login-button">
        <a href="login.php">Login</a>
    </div>
</body>

</html>