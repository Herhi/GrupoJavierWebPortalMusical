<?php

# Función 'verFacturas'.
# 
# Parámetros: 
#    -$facturas
#   
# Funcionalidad: Visualizar las facturas de un cliente
# 
# Return: Nada.
#
# Realizado: 13/02/2021
# 
# Código por Raquel Alcázar
function verFacturas($facturas){

    if(count($facturas)!=null){
    	echo "<br><table border='1'>
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
                </tr>";

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

    	echo "</table>";

    }else{
        echo "<p>No hay facturas entre las fechas indicadas.</p>";
    }

}

?>
