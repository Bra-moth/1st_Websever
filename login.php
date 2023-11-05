<?php
session_start();
require "../private/autoload.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Assuming you have a database connection established
  //$connection = mysqli_connect("hostname", "username", "password", "database_name");

  if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_num_rows($result) == 1) {
    // Successful login
    $_SESSION['username'] = $username;
    header("Location: Student_dashbord.php"); // Redirect to a welcome page or dashboard
    exit();
  } else {
    $error = "Invalid username or password";
  }

  mysqli_close($connection);
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
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
  </style>
</head>

<body>
  <div id="container">
    <div id="title">Login</div>
    <form method="post" action="login.php">
      <div id="error-message">
        <?php if (isset($error) && $error != "") {
          echo $error;
        } ?>
      </div>
      <input id="textbox" type="text" name="username" placeholder="Username" required><br>
      <input id="textbox" type="password" name="password" placeholder="Password" required><br><br>
      <input type="submit" value="Login">
    </form>
  </div>
</body>

</html>