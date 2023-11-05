<?php
session_start();
require_once "../private/autoload.php"; // Include your database connection code here

// Initialize $result to an empty array
$result = [];

// List Users
$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage User Accounts</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .Status-form {
            margin-top: 20px;
        }

        select,
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        select {
            width: 100%;
            max-width: 300px;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Add your CSS styles specific to buttons here */
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff; /* Button background color */
            color: #fff; /* Button text color */
            font-weight: bold;
            transition: background-color 0.3s; /* Add a smooth hover effect */
        }

        button:hover {
            background-color: #0056b3; /* Button background color on hover */
        }

        /* Add your CSS styles specific to the Manage User Accounts page here */
    </style>
</head>

<body>
    <h1>Manage User Accounts</h1>
    <div class="content">
        <!-- List Users -->
        <h2>User List</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td><a href='delete_user.php?id=" . $row["username"] . "' class='button'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
mysqli_close($connection);
?>
