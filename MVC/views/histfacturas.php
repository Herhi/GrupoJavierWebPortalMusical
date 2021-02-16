<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
         <meta name="author" content="Raquel Alcázar">
        <title>Portal Musical</title>
    </head>
    <body>
	   <h1>Facturas</h1>
          <table border="1">
            <tr>
                <th>InvoiceId</th>
                <th>CustomerId</th>
                <th>InvoiceDate</th>
                <th>Billing Address</th>
                <th>Billing City</th>
                <th>Billing State</th>
                <th>Billing Country</th>
                <th>Billing Postal Code</th>
                <th>Total</th>
            </tr>
        <?php
            for($i=0; $i<count($facturas); $i++){
                   
                echo "<tr>
                        <td>" .$facturas[$i]["InvoiceId"] ."</td>
                        <td>" .$facturas[$i]["CustomerId"] ."</td>
                        <td>" .$facturas[$i]["InvoiceDate"] ."</td>
                        <td>" .$facturas[$i]["BillingAddress"] ."</td>
                        <td>" .$facturas[$i]["BillingCity"] ."</td>
                        <td>" .$facturas[$i]["BillingState"] ."</td>
                        <td>" .$facturas[$i]["BillingCountry"] ."</td>
                        <td>" .$facturas[$i]["BillingPostalCode"] ."</td>
                        <td>" .$facturas[$i]["Total"] ."</td>
                    </tr>";
            }

        ?>
    </table>
    </body>
</html>
