<?php

include_once '../db/db.php';

# Función 'obtenerRanking'.
# 
# Parámetros: 
#   -$customerId
#   
# Funcionalidad: Obtener las canciones descargadas por un cliente, ordenado por número de descargas.
# 
# Return: $datos 
#
# Realizado: 16/02/2021
# 
# Código por Raquel Alcázar

function obtenerRanking($customerId) {

	global $conexion;

	try {

		$consulta = $conexion->prepare("SELECT sum(quantity) as Descargas, t.* FROM Track t, InvoiceLine i, Invoice WHERE t.TrackId=i.TrackId and Invoice.InvoiceId=i.InvoiceId and Invoice.CustomerId=$customerId group by t.name order by t.name");

		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC); 

		return $datos;

	} catch (PDOException $ex) {
		echo "<p>Ha ocurrido un error al devolver los datos <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
		return null;
	}

}

?>