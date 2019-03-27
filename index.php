<?php
require_once "conn.php";
require_once "login.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rowCount = table_login ('login', NULL, NULL);
    if ($rowCount == 1) {
        $rows_users = table_login ('select_for_session', $_REQUEST['Username'], $_REQUEST['Password']);
        foreach ($rows_users as $row_users) {
            // Setting up usersId in the session.
            $_SESSION['usersId'] = $row_users->Id;
            header("location: home.php");
        }
    }
    else {
        $error = "Wrong Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Welcome";
    include "includes/head.php";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <main>
                <div class="login">
                    <form action="#" method="post">
                        <ul>
                            <li class="bold">Please login</li>
                            <li>
                                <input type="text" name="Username" id="Username" placeholder="Username" required>
                            </li>
                            <li>
                                <input type="password" name="Password" id="Password" placeholder="Password" required>
                            </li>
                            <li class="error">
                                <?php if (!empty($error)) { echo $error; } ?>
                            </li>
                            <li>
                                <button type="submit" name="buttonSubmit" id="buttonLogin">Login</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </main>
        </div>
        <!-- end of content -->
        <?php include "includes/footer.html"; ?>
    </body>
</html>
