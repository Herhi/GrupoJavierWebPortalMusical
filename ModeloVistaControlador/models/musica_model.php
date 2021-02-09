<?php

// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

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

function altaPedido($conn){

    //obtenemos el numpedidomaximo
    $stmt = $conn->prepare("SELECT MAX(InvoiceId) as pedido FROM invoice");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $maxpedido=$row['pedido'];
    }
    $maxpedido=$maxpedido+1;

    //sacamos las variables

    $InvoiceId=$maxpedido;
    $CustomerId=$_COOKIE["customerId"]; //hay que sacarlo de la cookie
    $InvoiceDate=getFecha();
    $BillingAddress=getBillingAddress($customerId);
    $BillingCity=getBillingCity($customerId);
    $BillingState=getBillingState($customerId);
    $BillingCountry=getBillingCountry($customerId);
    $BillingPostalCode=getBillingPostalCode($customerId);
    //$Total=;
    

    //insertamos en la tabla 'Invoice'
    $stmt = $conn->prepare("INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingState, BillingCountry, BillingPostalCode, Total) VALUES (:InvoiceId, :CustomerId, :InvoiceDate, :BillingAddress, :BillingCity, :BillingState, :BillingState, :BillingCountry, :BillingPostalCode, :Total)");

        $stmt->bindParam(':InvoiceId', $InvoiceId);
        $stmt->bindParam(':CustomerId', $CustomerId);
        $stmt->bindParam(':InvoiceDate', $InvoiceDate);
        $stmt->bindParam(':BillingAddress', $BillingAddress);
        $stmt->bindParam(':BillingCity', $BillingCity);
        $stmt->bindParam(':$BillingState', $BillingState);
        $stmt->bindParam(':$BillingPostalCode', $BillingPostalCode);
        

    $stmt->execute();

    return $InvoiceId;

}
?>