<?php
require_once "conn.php";

//function to use data from the table users
function table_login ($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'login':
            // getting data from the form
            $Username = trim($_REQUEST['Username']);
            $Password = trim($_REQUEST['Password']);
            $query = "SELECT * FROM users
                WHERE BINARY Username = :Username
                AND BINARY Password = :Password
            ;";
            $database->query($query);
            $database->bind(':Username', $Username);
            $database->bind(':Password', $Password);
            return $r = $database->rowCount();
            break;

        case 'select_for_session':
            $query = "SELECT * FROM users
                WHERE BINARY Username = :Username
                AND BINARY Password = :Password
            ;";
            $database->query($query);
            $database->bind(':Username', $var1);
            $database->bind(':Password', $var2);
            return $r = $database->resultset();
            break;

        default:
            // code...
            break;
    }
}

?>
