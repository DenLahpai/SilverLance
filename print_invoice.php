<?php
require_once "functions.php";
require_once "xcodes.php";

//getting Invoice_no
$Invoice_no = trim($_REQUEST['Invoice_no']);

//getting data from the table invoices
$rows_invoices = table_invoices ('select_one', $Invoice_no, NULL);
foreach ($rows_invoices as $row_invoices) {
    // code...
}

//getting data from the table $inovice_heads
$rows_invoice_heads = table_invoice_heads ('select_one', $Invoice_no, NULL);
foreach ($rows_invoice_heads as $row_invoice_heads) {
    // code...
}

$rows_invoice_details = table_invoice_details ('select_one_invoice', $Invoice_no, NULL);

//getting the currency
if ($row_invoices->USD == "" || $row_invoices->USD == 0 || $row_invoices->USD == NULL) {
    $currency = 'MMK';
}
else {
    $currency = 'USD';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = 'Invoice - '.$Invoice_no;
    include "includes/head.php";
    ?>
    <style media="screen">
        body {
            background: #FFF;
        }
        footer {
            margin-top: 60px;
        }
    </style>
    <body>
        <!-- content -->
        <div class="print">
            <!-- page-header -->
            <div class="page-header">
                <table>
                    <thead>
                        <tr>
                            <td><img src="images/SIlver-Lance-3.png" alt=""></td>
                            <td>
                                <ul>
                                    <li class="bold">Silver Lance Co Ltd</li>
                                    <li>15th Street, No 116, 8th Floor Room (13)</li>
                                    <li>Lanmadaw Township</li>
                                    <li>Yangon, Myanmar</li>
                                </ul>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul>
                                    <li>
                                        Bill To: <span class="bold"><? echo $row_invoice_heads->Bill_to; ?></span>
                                    </li>
                                    <li>
                                        Address: <? echo $row_invoice_heads->Address; ?>
                                    </li>
                                    <li>
                                        City: <?php echo $row_invoice_heads->City; ?>
                                    </li>
                                    <li>
                                        Country: <?php echo $row_invoice_heads->Country; ?>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        Invoice No: <span class="bold"><?php echo $Invoice_no; ?></span>
                                    </li>
                                    <li>
                                        Invoice Date: <?php echo date("d-M-Y", strtotime($row_invoices->Invoice_date)); ?>
                                    </li>
                                    <li>
                                        Clients Reference: <?php echo $row_invoices->Clients_ref; ?>
                                    </li>
                                    <li>
                                        Due Date: <?php //TODO ?>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end of page-header -->
            <!-- invoice-body  -->
            <div class="invoice-body">
                <h2>INVOICE</h2>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Description</th>
                            <th>
                                Amount in
                                <?php echo $currency; ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows_invoice_details as $row_invoice_details) {
                            if ($row_invoice_details->Description != "" || $row_invoice_details->Description != NULL) {
                                echo "<tr>";
                                echo "<td colspan=\"2\">".$row_invoice_details->Description."</td>";
                                if ($currency == 'MMK') {
                                    echo "<td>".$row_invoice_details->MMK."</td>";
                                }
                                else {
                                    echo "<td>".$row_invoice_details->USD."</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="2">TOTAL IN <? echo $currency; ?></th>
                            <th>
                                <?php
                                if ($currency == 'MMK') {
                                    echo $sum = $row_invoices->MMK;
                                }
                                else {
                                    echo $sum = $row_invoices->USD;
                                }
                                ?>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <p>Amount in <? echo $currency;?>: <? echo ucwords(convert_number_to_words($sum))?> ONLY.</p>
            </div>
            <!-- end of invoice-body -->
        </div>
        <!-- end of print -->
        <footer>
            <p>This is a computer-generated document. No signature is required.</p>
        </footer>
    </body>
</html>
