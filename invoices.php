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
            include "includes/sub-menu.php";
            ?>
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
                            foreach ($rows_invoices as $row_invoices) {
                                echo "<tr>";
                                echo "<td>".$row_invoices->Invoice_no."</td>";
                                echo "<td>".date("d-M-y", strtotime($row_invoices->Invoice_date))."</td>";
                                echo "<td>".$row_invoices->MMK."</td>";
                                echo "<td>".$row_invoices->USD."</td>";
                                echo "<td>".$row_invoices->Status."</td>";
                                echo "<td>".date("d-M-y",strtotime($row_invoices->Paid_date))."</td>";
                                echo "<td>".$row_invoices->Method."</td>";
                                echo "<td><a href=\"edit_invoice.php?Invoice_no=$row_invoices->Invoice_no\">View</a>&nbsp;";
                                echo "<a href=\"receipt.php?Invoice_no=$row_invoices->Invoice_no\">Receipt</a></td>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- end of report table -->
            </main>
        </div>
        <!-- end of content -->
        <?php include "includes/footer.html"; ?>
    </body>
</html>
