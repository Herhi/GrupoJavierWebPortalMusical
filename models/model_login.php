<?php 

require_once("../db/db.php");

function comprobarCredenciales($user, $clave) {

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
	return setcookie("userId", $idUsuario, time() + (86400 * 10), "/"); // La cookie expira en 10 días
}

?>