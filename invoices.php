<?php
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Invoices";
    include "includes/head.php";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = "Invoices";
            include "includes/nav.php";
            include "includes/header.php";
            ?>
            <!-- sub-menu -->
            <div class="sub-menu">
                <form action="#" method="post">
                    <ul>
                        <li>
                            <button type="button" name="button" onclick="location.href='new_invoice.php';">Create New</button>
                        </li>
                        <li>
                            <input type="text" name="search" id="search" placeholder="Search">
                        </li>
                        <li>
                            <button type="button" name="buttonSearch" id="buttonSearch">Search</button>
                        </li>
                    </ul>
                </form>
            </div>
            <!-- end of sub-menu -->
            <main>
                <!-- report table -->
                <div class="report table">
                    <table>
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Invoice Date</th>
                                <th>MMK</th>
                                <th>USD</th>
                                <th>Status</th>
                                <th>Paid Date</th>
                                <th>Method</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows_invoices = table_invoices('select_all', NULL, NULL);
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- end of report table -->
            </main>
        </div>
        <!-- end of content -->
    </body>
</html>
