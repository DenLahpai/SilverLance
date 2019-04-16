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

//function to use data from the table invoices
function table_invoices ($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'select_all':
            $query = "SELECT * FROM invoices ;";
            $database->query($query);
            return $r = $database->resultset();
            break;

        case 'generate_invoice_no':
            // generating invoice number
            $year = date('Y');
            $query = "SELECT * FROM invoices ;";
            $database->query($query);
            $rowCount = $database->rowCount();
            $num = $rowCount + 1;
            if($num <= 9) {
                $Invoice_no = $year.'-000'.$num;
            }
            elseif($num <= 99) {
                $Invoice_no = $year.'-00'.$num;
            }
            elseif ($num <= 999) {
                $Invoice_no = $year.'-0'.$num;
            }
            else {
                $Invoice_no = $year.'-'.$num;
            }
            return $Invoice_no;
            break;

        case 'insert':
            //$var1 = Invoice_no
            //$var2 = sum
            $Clients_ref = trim($_REQUEST['Clients_ref']);
            $Invoice_date = $_REQUEST['Invoice_date'];
            $currency = $_REQUEST['currency'];
            $query = "INSERT INTO invoices (
                Invoice_no,
                Invoice_date,
                Clients_ref,
                $currency,
                Status
                ) VALUES (
                :Invoice_no,
                :Invoice_date,
                :Clients_ref,
                :sum,
                :Status
                )
            ;";
            $database->query($query);
            $database->bind(':Invoice_no', $var1);
            $database->bind(':Invoice_date', $Invoice_date);
            $database->bind(':Clients_ref', $Clients_ref);
            $database->bind(':sum', $var2);
            $database->bind(':Status', 'Invoiced');
            if ($database->execute()) {
                header("location: edit_invoice.php?Invoice_no=$var1");
            }
            break;

        case 'select_one':
            $query = "SELECT * FROM invoices WHERE Invoice_no = :Invoice_no ;";
            $database->query($query);
            $database->bind(':Invoice_no', $var1);
            return $r = $database->resultset();
            break;

        case 'update':
            // $var1 = Invoice_no
            //$var2 = currency
            $Clients_ref = trim($_REQUEST['Clients_ref']);
            $Invoice_date = $_REQUEST['Invoice_date'];
            $total = $_REQUEST['total'];
            $query = "UPDATE invoices SET
                Clients_ref = :Clients_ref,
                Invoice_date = :Invoice_date,
                $var2 = :total
                WHERE Invoice_no = :Invoice_no
            ;";
            $database->query($query);
            $database->bind(':Clients_ref', $Clients_ref);
            $database->bind(':Invoice_date', $Invoice_date);
            $database->bind(':total', $total);
            $database->bind(':Invoice_no', $var1);
            if ($database->execute()) {
                header("location: edit_invoice.php?Invoice_no=$var1");
            }
            break;

        default:
            // code...
            break;
    }
}

// function to use data from the invoice_heads
function table_invoice_heads ($job, $var1, $var2) {
    $database = new Database();
    switch ($job) {
        case 'insert':
            $Bill_to = trim($_REQUEST['Bill_to']);
            $Address = trim($_REQUEST['Address']);
            $City = trim($_REQUEST['City']);
            $Country = trim($_REQUEST['Country']);
            $Attn = trim($_REQUEST['Attn']);
            $query = "INSERT INTO invoice_heads (
                Invoice_no,
                Bill_to,
                Address,
                City,
                Country,
                Attn
                ) VALUES(
                :Invoice_no,
                :Bill_to,
                :Address,
                :City,
                :Country,
                :Attn
                )
            ;";
            $database->query($query);
            $database->bind(':Invoice_no', $var1);
            $database->bind(':Bill_to', $Bill_to);
            $database->bind(':Address', $Address);
            $database->bind(':City', $City);
            $database->bind(':Country', $Country);
            $database->bind(':Attn', $Attn);
            $database->execute();
            break;

        case 'select_one':
            $query = "SELECT * FROM invoice_heads
                WHERE Invoice_no = :Invoice_no
            ;";
            $database->query($query);
            $database->bind(':Invoice_no', $var1);
            return $r = $database->resultset();
            break;

        case 'update':
            // $var1 = Invoice_no
            $Bill_to = trim($_REQUEST['Bill_to']);
            $Address = trim($_REQUEST['Address']);
            $City = trim($_REQUEST['City']);
            $Country = trim($_REQUEST['Country']);
            $Attn = trim($_REQUEST['Attn']);

            $query = "UPDATE invoice_heads SET
                Bill_to = :Bill_to,
                Address = :Address,
                City = :City,
                Country = :Country,
                Attn = :Attn
                WHERE Invoice_no = :Invoice_no
            ;";
            $database->query($query);
            $database->bind(':Bill_to', $Bill_to);
            $database->bind(':Address', $Address);
            $database->bind(':City', $City);
            $database->bind(':Country', $Country);
            $database->bind(':Attn', $Attn);
            $database->bind(':Invoice_no', $var1);
            $database->execute();
            break;

        default:
            // code...
            break;
    }
}

//function to to user data from the table invoice_details
function table_invoice_details ($job, $var1, $var2) {
    $database = new Database();
    //$var1 = Invoice_no
    //$var2 = currency

    switch ($job) {
        case 'insert':
            $i = 1;
            while ($i <= 20) {
                $Description = trim($_REQUEST["Description$i"]);
                $amount = $_REQUEST["amount$i"];
                $query = "INSERT INTO invoice_details (
                    Invoice_no,
                    Description,
                    $var2
                    ) VALUES(
                    :Invoice_no,
                    :Description,
                    :amount
                    )
                ;";
                $database->query($query);
                $database->bind(':Invoice_no', $var1);
                $database->bind(':Description', $Description);
                $database->bind(':amount', $amount);
                $database->execute();
                $i++;
            }
            break;

        case 'get_sum':
            $query = "SELECT SUM($var2) AS $var2 FROM invoice_details
                WHERE Invoice_no = :Invoice_no
            ;";
            $database->query($query);
            $database->bind(':Invoice_no', $var1);
            $rows = $database->resultset();
            foreach ($rows as $row) {
                $sum = $row->$var2;
            }
            return $sum;
            break;

        case 'select_one_invoice':

            $query = "SELECT * FROM invoice_details
                WHERE Invoice_no = :Invoice_no
            ;";
            $database->query($query);
            $database->bind(':Invoice_no', $var1);
            return $r = $database->resultset();
            break;

        case 'update':
            // $var1 = $Invoice_no
            // $var2 = $currency
            $i = 1;
            while ($i <= 20) {
                $Id = $_REQUEST["Id$i"];
                $Description = trim($_REQUEST["Description$i"]);
                $amount = $_REQUEST["amount$i"];
                $query = "UPDATE invoice_details SET
                    Description = :Description,
                    $var2 = :amount
                    WHERE Id = :Id
                ;";
                $database->query($query);
                $database->bind(':Id', $Id);
                $database->bind(':Description', $Description);
                $database->bind(':amount', $amount);
                $database->execute();
                $i++;
            }
            break;

        default:
            // code...
            break;
    }
}



?>
