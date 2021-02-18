<?php

include_once '../db/db.php';

# Función 'obtenerFacturasFecha'.
# 
# Parámetros: 
#   -$customerId
#	-$fecha_ini
#	-$fecha_fin
#   
# Funcionalidad: Obtener las facturas de un cliente entre dos fechas.
# 
# Return: $datos 
#
# Realizado: 13/02/2021
# 
# Código por Raquel Alcázar
function obtenerFacturasFecha($customerId, $fecha_ini, $fecha_fin) {

	global $conexion;

	try {

		$consulta = $conexion->prepare("SELECT * FROM invoice WHERE customerId=:customerId and InvoiceDate>=:fecha_ini and InvoiceDate<=:fecha_fin");

		$consulta->bindParam(":customerId", $customerId);
		$consulta->bindParam(":fecha_ini", $fecha_ini);
		$consulta->bindParam(":fecha_fin", $fecha_fin);

		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC); 
		
		return $datos;

	} catch (PDOException $ex) {
		echo "<p>Ha ocurrido un error al devolver los datos <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
		return null;
	}

}
?>