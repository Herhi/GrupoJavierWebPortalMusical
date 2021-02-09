 <?php

/* funcionalidad: conectarse a la base de datos */
function conexionBBDD(){
    
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "musica";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}


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


function obtenerTracks($conn){
    $tracks = array();
    
    $sql = "SELECT TrackId, Name FROM Track";

    foreach ($conn->query($sql) as $row) {
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
    //$CustomerId=; //hay que sacarlo de la cookie
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

function insertarInvoiceLine($conn,$InvoiceId){
    $stmt2 = $conn->prepare("INSERT INTO orders (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) VALUES (:InvoiceLineId, :InvoiceId, :TrackId, :UnitPrice, :Quantity)");

    $stmt2->bindParam(':InvoiceLineId', $InvoiceLineId);
    $stmt2->bindParam(':InvoiceId', $InvoiceId);
    $stmt2->bindParam(':TrackId', $TrackId);
    $stmt2->bindParam(':UnitPrice', $UnitPrice);
    $stmt2->bindParam(':Quantity', $Quantity);

    $stmt2->execute();
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
    $stmt = $conn->prepare("SELECT BillingAddress as dato FROM Customer WHERE $CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingCity($cliente){
    $stmt = $conn->prepare("SELECT BillingCity as dato FROM Customer WHERE $CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingState($cliente){
    $stmt = $conn->prepare("SELECT BillingState as dato FROM Customer WHERE $CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingCountry($cliente){
    $stmt = $conn->prepare("SELECT BillingCountry as dato FROM Customer WHERE $CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

function getBillingPostalCode($cliente){
    $stmt = $conn->prepare("SELECT BillingPostalCode as dato FROM Customer WHERE $CustomerId='$cliente'");
    $stmt->execute();

    foreach($stmt->fetchAll() as $row) {
        $info=$row['dato'];
    }
    return $info;
}

?>