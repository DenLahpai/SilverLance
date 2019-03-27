<?php
require_once "functions.php";
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
            include "includes/sub-menu.php";
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
                                            <input type="date" name="Invoice_date" id="Inovice_date" value="<? echo date("Y-m-d");?>">
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
                                            <input type="text" name="Attn" id="Attn" placeholder="Attention">
                                            Attn:    klczx nklbvcgotepijvm,h8jcxm, 9ercx
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
                    </form>
                </div>
                <!-- end of invoice form -->
            </main>
        </div>
        <!-- end of content -->
    </body>
</html>
