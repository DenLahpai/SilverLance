<?php
require_once "functions.php";

//getting data from the table users
$rows_users = table_users ('select_one', $_SESSION['usersId'], NULL);
foreach ($rows_users as $row_users) {
    // code...
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Home.php";
    include "includes/head.php";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = "Welcome: ".$row_users->Fullname;
            include "includes/header.php";
            include "includes/nav.php";
            ?>
        
        </div>
        <!-- end of content -->
    </body>
</html>
