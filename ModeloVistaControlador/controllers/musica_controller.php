<?php

//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/musica_model.php");

if (!isset($_POST) || empty($_POST)) {
$tracks=obtenerTracks();


}else{
	
}

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/musica_view.phtml");

?>