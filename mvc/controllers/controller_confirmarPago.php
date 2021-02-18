<?php 

	// API de RedSys
	require_once('../external/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php');

	$peticion = new RedsysAPI;

	$cantidadPagar = 10000; // En céntimos
	$peticion->setParameter("DS_MERCHANT_AMOUNT", strval($cantidadPagar * 100) );
	$peticion->setParameter("DS_MERCHANT_CURRENCY", "978");
	$peticion->setParameter("DS_MERCHANT_MERCHANTCODE", "999008881");
	$peticion->setParameter("DS_MERCHANT_ORDER", date("ymdHism"));
	$peticion->setParameter("DS_MERCHANT_TERMINAL", "1");
	$peticion->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");

	$redireccion = "http://localhost" . $_SERVER["PHP_SELF"] . "/../controller_recuperarDatosPago.php";

	$peticion->setParameter("DS_MERCHANT_URLKO", $redireccion . "?resultado=KO");
	$peticion->setParameter("DS_MERCHANT_URLOK", $redireccion . "?resultado=OK");

	$parametros = $peticion->createMerchantParameters();

	$claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
	$firma = $peticion->createMerchantSignature($claveSHA256);

	// Llamada a la vista
	require_once("../views/confirmarCompra.php");
?>