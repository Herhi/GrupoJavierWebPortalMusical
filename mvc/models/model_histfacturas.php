<?php

include_once '../db/db.php';

# Función 'obtenerFacturas'.
# 
# Parámetros: 
#   -$customerId
#   
# Funcionalidad: Obtener las facturas de un cliente.
# 
# Return: $datos 
#
# Realizado: 13/02/2021
# 
# Código por Raquel Alcázar
function obtenerFacturas($customerId) {

	global $conexion;

	try {

		$consulta = $conexion->prepare("SELECT * FROM invoice WHERE customerId=:customerId");
		$consulta->bindParam(":customerId", $customerId);
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC); 
		
		return $datos;

	} catch (PDOException $ex) {
		echo "<p>Ha ocurrido un error al devolver los datos <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
		return null;
	}

}

?>