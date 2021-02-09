<?php

//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/musica_model.php");

if (!isset($_POST) || empty($_POST)) {
$tracks=obtenerTracks();

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/musica_view.phtml");
	
	
 }else{ 

    $track    = ($_POST['track']);
    $track    = getTrackId($track);
    $cantidad = ($_POST['cantidad']);
    //$orderNumber = altaPedido($conn);
    //insertarOrderDetails($conn,$orderNumber, $cantidad);


  }
}

catch(PDOException $e) {  
  	echo $stmt . "<br>" . $e->getMessage();
}

$conn = null;

?>
