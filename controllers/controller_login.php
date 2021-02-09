<?php 

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


require_once("../views/login.php"); // Se llama a la Vista


?>