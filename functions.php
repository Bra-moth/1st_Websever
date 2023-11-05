<?php

function get_random_string($length)
{
    $numeric = range('0', '9');
    $lowercase = range('a', 'z');
    $uppercase = range('A', 'Z');

    $allPossibleCharacters = array_merge($numeric, $lowercase, $uppercase);
    $text = "";

    $length = rand(4,$length);

    for($i=0;$i<$length;$i++){
        $random = rand(0,61);

        $text .= $allPossibleCharacters[$random];
    }

    return $text;

    

}

function esc($word)
{
    return addslashes($word);

}

function check_login($connection)
{
    if (isset($_SESSION['url_address'])) {
        $arr['url_address'] = $_SESSION['url_address'];

        $query = "SELECT * FROM users WHERE url_address = :url_address";
        $stm = $connection->prepare($query);
        $stm->execute($arr);

        $data = $stm->fetchAll(PDO::FETCH_OBJ);

        if (is_array($data) && count($data) > 0) {
            return $data[0];
        }
    }

    // Redirect and exit
    header("Location: login.php");
    exit;
}



//queries

function getStudentsWithDisabilities() {
    global $connection; // Access the database connection from the global scope

    $query = "SELECT * FROM students WHERE disability = 'Yes'";
    $result = mysqli_query($connection, $query);

    return $result;
}

// Function to retrieve students applied to single rooms
function getStudentsAppliedToSingleRooms() {
    global $connection; // Access the database connection from the global scope

    $query = "SELECT * FROM students WHERE roomType = 'Single'";
    $result = mysqli_query($connection, $query);

    return $result;
}

// Function to retrieve students doing their first year
function getStudentsDoingFirstYear() {
    global $connection; // Access the database connection from the global scope

    $query = "SELECT * FROM students WHERE year = '1st'";
    $result = mysqli_query($connection, $query);

    return $result;

}
