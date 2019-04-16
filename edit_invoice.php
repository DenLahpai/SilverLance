<?php
require_once "functions.php";

// getting Invoice_no
$Invoice_no = trim($_REQUEST['Invoice_no']);

//getting date from the table invoice_heads
$rows_invoice_heads = table_invoice_heads ('select_one', $Invoice_no, NULL);
foreach ($rows_invoice_heads as $row_invoice_heads) {
    // code...
}

//getting data from the table_invoices
$rows_invoices = table_invoices ('select_one', $Invoice_no, NULL);
foreach ($rows_invoices as $row_invoices) {
    // code...
}

//getting the currency
if ($row_invoices->USD == "" || $row_invoices->USD == 0 || $row_invoices->USD == NULL) {
    $currency = 'MMK';
}
else {
    $currency = 'USD';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    table_invoice_heads ('update', $Invoice_no, NULL);
    table_invoice_details ('update', $Invoice_no, $currency);
    table_invoices ('update', $Invoice_no, $currency);
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = 'Edit Invoice';
    include "includes/head.php";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = "Edit Invoice";
            include "includes/header.php";
            include "includes/nav.php";
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
                                            <input type="text" name="Bill_to" id="Bill_to" value="<? echo $row_invoice_heads->Bill_to;?>" required>
                                        </td>
                                        <td>
                                            Invoice Date:
                                            <input type="date" name="Invoice_date" id="Invoice_date" value="<? echo $row_invoices->Invoice_date; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Address:
                                            <textarea name="Address" id="Address"><? echo $row_invoice_heads->Address;?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            City:
                                            <input type="text" name="City" id="City" placeholder="City" value="<? echo $row_invoice_heads->Address; ?>">
                                        </td>
                                        <td>
                                            Country:
                                            <input type="text" name="Country" id="Country" placeholder="Country" value="<? echo $row_invoice_heads->Country; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Attn:
                                            <input type="text" name="Attn" id="Attn" value="<? echo $row_invoice_heads->Attn;?>">
                                        </td>
                                        <td>
                                            Clients Reference:
                                            <input type="text" name="Clients_ref" id="Clients_ref" value="<? echo $row_invoices->Clients_ref; ?>">
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
                                        <th colspan="2">Description</th>
                                        <th>Amount in <? echo $currency; ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $rows_invoice_details = table_invoice_details ('select_one_invoice', $Invoice_no, NULL);
                                    foreach ($rows_invoice_details as $row_invoice_details) {
                                        echo "<tr>";
                                        echo "<td class=\"invisible\"><input type=\"number\" name=\"Id$i\" value=\"$row_invoice_details->Id\">";
                                        echo "<td colspan=\"2\"><input type=\"text\" name=\"Description$i\" value=\"$row_invoice_details->Description\"></td>";
                                        echo "<td>";
                                        if ($currency == 'MMK') {
                                            echo "<input type=\"number\" class=\"amount\" name=\"amount$i\" value=\"$row_invoice_details->MMK\" onchange=\"getTotal();\">";
                                        }
                                        else {
                                            echo "<input type=\"number\" class=\"amount\" name=\"amount$i\" value=\"$row_invoice_details->USD\">";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    ?>
                                    <tr>
                                        <th colspan="2">
                                            TOTAL in <? echo $currency?>
                                        </th>
                                        <th>
                                            <input type="number" id="total" name="total" value="" readonly>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">
                                            <a href="<? echo "print_invoice.php?Invoice_no=$Invoice_no"; ?>" target="_blank"><button type="button" name="button">Print</button></a>
                                            <button type="button" id="buttonSubmit" name="buttonSubmit" onclick="checkThreeFields('Bill_to', 'Invoice_date', 'Bill_to');">Update</button>
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
        <!-- content -->
        <?php include "includes/footer.html"; ?>
    </body>
    <script type="text/javascript" src="scripts/scripts.js"></script>

    <script type="text/javascript">
        window.onload = getTotal();
        //function to get the total
        function getTotal () {
            var amount = document.getElementsByClassName('amount');
            var total = Number(amount[0].value) + Number(amount[1].value) + Number(amount[2].value)
            + Number(amount[3].value) + Number(amount[4].value) + Number(amount[5].value)
            + Number(amount[6].value) + Number(amount[7].value) + Number(amount[8].value)
            + Number(amount[9].value) + Number(amount[10].value) + Number(amount[11].value)
            + Number(amount[12].value) + Number(amount[13].value) + Number(amount[14].value)
            + Number(amount[15].value) + Number(amount[16].value) + Number(amount[17].value)
            + Number(amount[18].value) + Number(amount[19].value) + Number(amount[19].value);
            document.getElementById('total').value = total;
        }
    </script>
</html>
