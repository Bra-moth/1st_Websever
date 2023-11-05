<?php
// Include your database connection code here
session_start();
require_once "../private/autoload.php";

?>


<!DOCTYPE html>
<html>

<head>
    <title>Success</title>


<body style="font-family: sans-serif;">
    <style type="text/css">
        #title {
            background-color: rgb(40, 40, 208);
            padding: .5em;
            text-align: center;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            /* background-color: #001f3f; /* Dark blue color */
            margin: 0;
            padding: 0;
        }

        .success-message {
            margin: auto;
            max-width: 400px;
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-button {
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .firework {
            position: absolute;
            width: 20px;
            height: 20px;
            background: #f00;
            /* You can customize the firework color here */
            border-radius: 50%;
            transform-origin: center;
            animation: explode 1s ease-out forwards;
        }

        .firework.red {
            background: #ff0000;
        }

        .firework.blue {
            background: #0000ff;
        }

        .firework.green {
            background: #00ff00;
        }

        @keyframes explode {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(3);
                /* Increased final scale */
                opacity: 0;
            }
        }
    </style>
    </head>

    <body style="font-family: sans-serif;">
        <style type="text/css">
            /* Your existing styles here */

            /* Firework container styles */
            #firework-container {
                position: relative;
                width: 100%;
                height: 100vh;
                overflow: hidden;
            }
        </style>
        <div id="title">Success</div>
        <div class="success-message">
            <h2>Your student information has been successfully submitted!</h2>
            <p>Thank you for providing your information.</p>
            <div class="action-buttons">
                <a class="action-button" href="application.php">Apply for Residences</a>
                <a class="action-button" href="Home.php">Logout</a>
            </div>
        </div>

        <!-- Fireworks container -->
        <div id="firework-container"></div>

        <script>
            // JavaScript for creating fireworks animation
            function createFirework() {
                const firework = document.createElement('div');
                firework.classList.add('firework');

                // Assign a random color to each firework
                const colors = ['red', 'blue', 'green'];
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                firework.classList.add(randomColor);

                firework.style.left = `${Math.random() * 100}%`;
                firework.style.top = `${Math.random() * 100}%`;
                const size = Math.random() * 40 + 10; // Random size between 10 and 50 pixels (increased size)
                firework.style.width = `${size}px`;
                firework.style.height = `${size}px`;
                document.getElementById('firework-container').appendChild(firework);

                setTimeout(() => {
                    firework.remove();
                }, 1000); // Adjust the duration as needed
            }

            // Create fireworks at random intervals
            setInterval(createFirework, 300);
        </script>
    </body>

</html>