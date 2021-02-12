<?php 

require_once("../db/db.php");

function comprobarCredenciales($user, $clave) {
	// Daniel González Carretrero
	// Dado un $user y una $clave, se comprueba si existe algún usuario con esos credenciales
	// Devuelve NULL si no existe o hay algún fallo, o el ID del Usuario (customerId) si existe
	
	global $conexion;

	try {

		$credenciales = $conexion->prepare("SELECT customerId FROM customer WHERE email = :user AND lastName = :password");
		$credenciales->bindParam(":user", $user);
		$credenciales->bindParam(":password", $clave);
		$credenciales->execute();

		return $credenciales->fetch(PDO::FETCH_ASSOC)["customerId"];

	} catch (PDOException $ex) {
		return null;
	}

}

function crearCookieLogin($idUsuario) {
	// Daniel González Carretero
	// Dado un $idUsuario, se crea una cookie para mantener iniciada la sesión
	// Se guarda el ID del Usuario (customerId)
	
	return setcookie("userId", $idUsuario, time() + (86400 * 10), "/"); // La cookie expira en 10 días
}

?>
