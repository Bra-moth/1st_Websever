<?php
require "../private/autoload.php";

$Error = ""; // Initialize the error message
$email = "";
$studentID = "";
$username = "";
$name = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $Error = "Please enter a valid email";
    }

    $date = date("Y-m-d H:i:s");
    $url_address = get_random_string(60);


    $username = trim($_POST['username']);
    $password = esc($_POST['password']);
    $name = trim($_POST['name']);

    // Check if the provided username, email, or studentID already exists in the database
    $existingUserQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $existingUserResult = mysqli_query($connection, $existingUserQuery);

    if (mysqli_num_rows($existingUserResult) > 0) {
        $Error = "Username or email already exists. Please choose different ones.";
    } else {
        $query = "INSERT INTO users ( username, password, email) VALUES ( '$username', '$password', '$email')";

        mysqli_query($connection, $query);

        header("Location: successRegistered.php");
        exit(); // Exit to prevent further execution of the script
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
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

        #textbox {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        #login-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        #login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="title">Signup</div>
        <form method="post" action="signup.php">
            <div id="error-message">
                <?php
                if (isset($Error) && $Error != "") {
                    echo $Error;
                }
                ?>
            </div>
            <input id="textbox" type="text" name="username" value="<?= $username ?>" placeholder="Username" required><br>
            <input id="textbox" type="email" name="email" value="<?= $email ?>" placeholder="Email" required>
            <input id="textbox" type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Signup">
        </form>
        <!-- Add a "Login" button/link -->
        <a href="login.php" id="login-button">Login</a>
    </div>
</body>

</html>