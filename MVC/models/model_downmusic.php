<?php

 include_once '../db/db.php';


# Función 'obtenerTracks'. 
# Parámetros: Conexión a la bbdd 
#   
# Funcionalidad: Conseguir un Array con las tracks
# 
# Return: Array de TrackId#Name
#
# Realizado: 08/02/2021
# 
# Código por Javier Gonzalez


function obtenerTracks(){

	global $conexion;

    $tracks = array();
    
    $sql = "SELECT TrackId, Name FROM Track";

    foreach ($conexion->query($sql) as $row) {
        $tracks[]=$row['TrackId']."#".$row['Name'];
    }
    return $tracks;
}


# Función 'getTrackId'. 
# Parámetros: Conexión a la bbdd 
#   
# Funcionalidad: Obtener el TrackId, de las canciones seleccionadas (TrackId#Name)
# 
# Return: TrackId
#
# Realizado: 08/02/2021
# 
# Código por Javier Gonzalez

function getTrackId($track){
    
    $data = explode('#', $track);
    
    $idtrack = $data[0];
    return $idtrack;
}


# Función 'insertarInvoiceLine'. 
# Parámetros:
#   
# Funcionalidad: Obtiene el ultimo InvoiceId
# 
# Return: Maximo InvoiceId+1
#
# Realizado: 12/02/2021
# 
# Código por Javier Gonzalez
function getMaxPedido(){

    global $conexion;

    //obtenemos el numpedidomaximo
    $stmt = $conexion->prepare("SELECT MAX(InvoiceId) as pedido FROM invoice");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $maxpedido=$row['pedido'];
    }
    $maxpedido=$maxpedido+1;

    return $maxpedido;

}



# Función 'altaPedido'. 
# Parámetros: Conexión a la bbdd 
#   
# Funcionalidad: Dar de alta los datos en tabla Invoice & InvoiceLine
# 
# Return: 
#
# Realizado: 08/02/2021
# 
# Código por Javier Gonzalez

function altaPedido($userId, $total){

	global $conexion;


    //sacamos las variables

    $InvoiceId=getMaxPedido();
    $CustomerId=$userId; //hay que sacarlo de la cookie
    $InvoiceDate=getFecha();
    $BillingAddress=getBillingAddress($CustomerId);
    $BillingCity=getBillingCity($CustomerId);
    $BillingState=getBillingState($CustomerId);
    $BillingCountry=getBillingCountry($CustomerId);
    $BillingPostalCode=getBillingPostalCode($CustomerId);
    $Total=$total;
    

    //insertamos en la tabla 'Invoice'
    $stmt = $conexion->prepare("INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingState, BillingCountry, BillingPostalCode, Total) VALUES (:InvoiceId, :CustomerId, :InvoiceDate, :BillingAddress, :BillingCity, :BillingState, :BillingState, :BillingCountry, :BillingPostalCode, :Total)");

        $stmt->bindParam(':InvoiceId', $InvoiceId);
        $stmt->bindParam(':CustomerId', $CustomerId);
        $stmt->bindParam(':InvoiceDate', $InvoiceDate);
        $stmt->bindParam(':BillingAddress', $BillingAddress);
        $stmt->bindParam(':BillingCity', $BillingCity);
        $stmt->bindParam(':$BillingState', $BillingState);
        $stmt->bindParam(':$BillingPostalCode', $BillingPostalCode);
        $stmt->bindParam(':$Total', $Total);
        

    $stmt->execute();

    return $InvoiceId;

}


/*SIGUIENTE FUNCION: la llamaremos en la funcion de arriba, PERO AUN NO ESTÁ ACABADA*/

# Función 'insertarInvoiceLine'. 
# Parámetros: Conexión a la bbdd , $InvoiceId
#   
# Funcionalidad: Dar de alta los datos en tabla Invoice & InvoiceLine
# 
# Return: 
#
# Realizado: 08/02/2021
# 
# Código por Javier Gonzalez

function insertarInvoiceLine($InvoiceId){

	global $conexion;

    $stmt2 = $conexion->prepare("INSERT INTO orders (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) VALUES (:InvoiceLineId, :InvoiceId, :TrackId, :UnitPrice, :Quantity)");

    $stmt2->bindParam(':InvoiceLineId', $InvoiceLineId);
    $stmt2->bindParam(':InvoiceId', $InvoiceId);
    $stmt2->bindParam(':TrackId', $TrackId);
    $stmt2->bindParam(':UnitPrice', $UnitPrice);
    $stmt2->bindParam(':Quantity', $Quantity);

    $stmt2->execute();
}


# Función 'getPrecioUnitario'
#   
# Funcionalidad: Obtiene el precio unitario de cada cancion
# 
# Return: $precio
#
# Realizado: 12/02/2021
# 
# Código por Javier Gonzalez

function getPrecioUnitario($cancion){
    global $conexion;

    $stmt = $conexion->prepare("SELECT UnitPrice as precio FROM Track WHERE TrackId='$cancion'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $precio=$row['precio'];
    }
    return $precio;
}



# Función 'imprimirCesta'
#   
# Funcionalidad: Imprime la cesta de la compra
# 
# Return: 
#
# Realizado: 12/02/2021
# 
# Código por Javier Gonzalez

function imprimirCesta($cesta){
    global $conexion;

    echo "<table>";
    echo "<tr>";
        echo "<th>"."ID Cancion"."</th>";
        echo "<th>"."título"."</th>";
    echo "</tr>";

    
    foreach ($cesta as $id) {
        global $conexion;

        $stmt = $conexion->prepare("SELECT Name as nombre FROM Track WHERE TrackId='$id'");
        $stmt->execute();

        foreach($stmt->fetchAll() as $row) {
            $titulo=$row['nombre'];
        }


        echo "<tr>";
            echo "<td>".$id."</td>";
            echo "<td>".$titulo."</td>";
        echo"</tr>";
    }
    echo "</table";
}



# Función 'getFecha'
#   
# Funcionalidad: Consigue la hora del sistema al llamar a la funcion
# 
# Return: Hora
#
# Realizado: 08/02/2021
# 
# Código por Javier Gonzalez    
function getFecha(){
    $fecha=getdate()['year']."-".getdate()['mon']."-".getdate()['mday']." ".getDate()['hours'].":".getDate()['minutes'].":".getDate()['seconds'];
    return $fecha;
}


/*Las siguientes funciones se llaman en altaPedido(), falta comentarlas*/

function getBillingAddress($cliente){
    global $conexion;

    $stmt = $conexion->prepare("SELECT Address as dato FROM Customer WHERE CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingCity($cliente){
    global $conexion;

    $stmt = $conexion->prepare("SELECT City as dato FROM Customer WHERE CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingState($cliente){
    global $conexion;

    $stmt = $conexion->prepare("SELECT State as dato FROM Customer WHERE CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingCountry($cliente){

    global $conexion;
    $stmt = $conexion->prepare("SELECT Country as dato FROM Customer WHERE CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingPostalCode($cliente){

    global $conexion;
    $stmt = $conexion->prepare("SELECT PostalCode as dato FROM Customer WHERE CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

?>