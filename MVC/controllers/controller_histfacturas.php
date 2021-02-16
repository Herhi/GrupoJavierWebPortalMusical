<?php

#Raquel Alcázar

require_once("../models/model_histfacturas.php");

$customerId=$_COOKIE["userId"];
$facturas=obtenerFacturas($customerId);

require_once("../views/histfacturas.php");
?>
