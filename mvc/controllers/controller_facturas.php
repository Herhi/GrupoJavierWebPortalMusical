<?php

#Raquel Alcázar

require_once("../views/facturas.html");

if(isset($_POST) && !empty($_POST)){

	require_once("../models/model_facturas.php");

	$customerId=$_COOKIE["userId"];
	$fecha_ini=$_POST["fecha_ini"];
	$fecha_fin=$_POST["fecha_fin"];

	require_once("../views/funciones_view_facturas.php");

	$facturas=obtenerFacturasFecha($customerId, $fecha_ini, $fecha_fin);

	verFacturas($facturas);
}

?>