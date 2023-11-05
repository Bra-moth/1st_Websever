<?php
session_start();
require_once "../private/autoload.php";

$sql = "SELECT applicationdeadline FROM systemconfig";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $applicationDeadline = $row['applicationdeadline'];
} else {
    $applicationDeadline = "Not specified";
}







?>


<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <style>
        /* Add your CSS styles for the homepage here */

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('Student4.jpg');
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

        @keyframes slideshow {
            0% {
                transform: scale(1.2);
            }

            20% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.5);
            }

            45% {
                transform: scale(1);
            }

            50% {
                transform: scale(1);
            }

            70% {
                transform: scale(1);
            }

            75% {
                transform: scale(1);
            }

            95% {
                transform: scale(1.5);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <h1>RESIDENCE PORTAL</h1>
    <div class="content">
        <p>Choose an option below:</p>
        <div class="login-buttons">
            <a href="manager_login.php" class="login-button">Manager Login</a>
            <a href="login.php" class="login-button">Student Login</a>
            <a href="signup.php" class="login-button">Student Signup</a>
            <a href="admin_portal.php" class="login-button">Admin Portal</a>
        </div>
        <p>Application Deadline: <?php echo $applicationDeadline; ?></p>
    </div>

    <script>
        // JavaScript to dynamically add room images
        const roomImages = document.getElementById('roomImages');
        const imageUrls = [
            'Student2.jpg',

            'Student4.jpg', // Replace with your image URL 1
            'Room2.jpg', // Replace with your image URL 2
            // Replace with your image URL 3
            // Replace with your image URL 4
            //'url5.jpg', // Replace with your image URL 5
        ]; // Change this to the number of room images you have

        imageUrls.forEach((imageUrl, index) => {
            const roomImage = document.createElement('div');
            roomImage.className = 'room-image';
            const img = document.createElement('img');
            img.src = imageUrl;
            roomImage.appendChild(img);
            roomImages.appendChild(roomImage);
        });
    </script>
</body>

</html>