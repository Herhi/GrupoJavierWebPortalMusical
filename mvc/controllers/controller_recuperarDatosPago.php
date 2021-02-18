<?php 

// La Pasarela de Pago manda el resultado del pago aquí
// Pago OK => $_GET["resultado"] = "OK"
// PAGO KO => $_GET["resultado"] = "KO"

var_dump($_GET);
require_once('../external/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php');
$respuesta = new RedsysAPI;

if (isset($_GET) && isset($_GET["resultado"]) && isset($_GET["Ds_MerchantParameters"])) {
	if ($_GET["resultado"] == "OK") {
		
		$datos = $respuesta->decodeMerchantParameters($_GET["Ds_MerchantParameters"]);
		$datos = json_decode($datos);
	
		var_dump($datos);
		// Datos para el InvoiceLine
		$fecha = urldecode($datos->Ds_Date);
		$hora = urldecode($datos->Ds_Hour);
		$tarjeta = $datos->Ds_Card_Number;
		$codigoRespuesta = $datos->Ds_Response;

		// Se convierte la fecha del formato (dd/mm/aaaa), al formato (aaaa/mm/dd), para que lo acepte la base de datos (DATETIME)
		$fecha = implode("/", array_reverse(explode("/", $fecha)));

		$fechaFin = $fecha ." ". $hora;

		// Llamada al modelo

		// Llamada a la vista
		// Se hace con Location, en vez de require para que el <a href> funcione chachi 
		header("Location: ../views/compraCorrecta.php");
	

	} else {
		// Llamada a la vista
		// Se hace con Location, en vez de require para que el <a href> funcione chachi 
		header("Location: ../views/compraIncorrecta.php");
	}
} else {
	// Se han colao en esta pagina, se redirecciona al login. Si ya está iniciado sesión, se redirige automáticamente en el controlador del login
	header("Location: ../controllers/controller_login.php");
}



?>