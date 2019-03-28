<?php
require_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currency = $_REQUEST['currency'];
    $Invoice_no = table_invoices ('generate_invoice_no', NULL, NULL);
    //inserting invoice_head
    table_invoice_heads ('insert', $Invoice_no, NULL);
    //inserting invoice_details
    table_invoice_details ('insert', $Invoice_no, $currency);
    //getting the sum
    $sum = table_invoice_details ('get_sum', $Invoice_no, $currency);
    //inserting Invoices
    table_invoices ('insert', $Invoice_no, $sum);


}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "New Invoice";
    include "includes/head.php";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = "New Invoice";
            include "includes/nav.php";
            include "includes/header.php";
            // include "includes/sub-menu.php";
            ?>
            <main>
                <!-- invoice form -->
                <div class="invoice form">
                    <form action="#" method="post">
                        <!-- invoice_head -->
                        <div class="invoice_head">
                            <table>
                                <thead>
                                    <tr>
                                        <td>
                                            Bill To:
                                            <input type="text" name="Bill_to" id="Bill_to" placeholder="Bill To" required>
                                        </td>
                                        <td>
                                            Invoice Date:
                                            <input type="date" name="Invoice_date" id="Invoice_date" value="<? echo date("Y-m-d");?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Address:
                                            <textarea name="Address" id="Address"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            City:
                                            <input type="text" name="City" id="City" placeholder="City" value="Yangon">
                                        </td>
                                        <td>
                                            Country:
                                            <input type="text" name="Country" id="Country" placeholder="Country" value="Myanmar">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Attn:
                                            <input type="text" name="Attn" id="Attn" placeholder="Attention">
                                        </td>
                                        <td>
                                            Clients Reference:
                                            <input type="text" name="Clients_ref" id="Clients_ref" placeholder="Client's Reference">
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- end of invoice_head -->
                        <!-- invoice_details -->
                        <div class="invoice_details">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th colspan="2">Description</th>
                                        <th>Amount in </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($i <= 20) {
                                        include "includes/invoice_details.php";
                                        $i++;
                                    }
                                    ?>
                                    <tr>
                                        <th colspan="4">
                                            <select id="currency" name="currency">
                                                <option value="">Select One</option>
                                                <option value="MMK">MMK</option>
                                                <option value="USD">USD</option>
                                            </select>
                                            <button type="button" id="buttonSubmit" name="buttonSubmit" onclick="checkThreeFields('Bill_to', 'Invoice_date', 'currency');">Submit</button>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end of invoice_details -->
                    </form>
                </div>
                <!-- end of invoice form -->
            </main>
        </div>
        <!-- end of content -->
    </body>
    <script type="text/javascript" src="scripts/scripts.js"></script>
</html>
