<?php
require_once "conn.php";

//checking if user is logged in
if ($_SESSION['usersId'] == "" || $_SESSION['usersId'] == NULL || empty($_SESSION['usersId'])) {
    header("location: ./");
}

//function to use data from the table users
function table_users ($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'select_one':
            $query = "SELECT * FROM users WHERE Id = :Id ;";
            $database->query($query);
            $database->bind(':Id', $var1);
            return $r = $database->resultset();
            break;

        default:
            // code...
            break;
    }
}

?>
