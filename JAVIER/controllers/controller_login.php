<?php 
require_once("../views/login.php"); // Se llama a la Vista

if (isset($_POST) && !empty($_POST) && isset($_POST["user"]) && isset($_POST["password"])) {
	$usuario = $_POST["user"];
	$clave = $_POST["password"];

	require_once("../models/model_login.php"); // Se -insertan- las funciones para comprobar usuario y contraseña

	$idUsuario = comprobarCredenciales($usuario, $clave);

	if ($idUsuario != null) {
		// Si existe un usuario con ese correo y 'LastName', se determina si se ha iniciado sesión o no según se haya creado la cookie o no.
		$iniciadoSesion = crearCookieLogin($idUsuario);
	}


} else {
	$iniciadoSesion = false; // Para mostrar el mensaje de error en la VISTA
}



// Se llama a la Vista, pasándole el valor de '$iniciadoSesión' manualmente, por GET
header("Location: ../views/login.php?didWork=". ($iniciadoSesion ? "1" : "0") );
// ($iniciadoSesion ? "1" : "0") es necesario para pasar el tipo de dato boolean. Si no se pone, didWork sería '1' si $iniciadoSesión es TRUE, pero sería '' (vacío), si es FALSE


?>



?>