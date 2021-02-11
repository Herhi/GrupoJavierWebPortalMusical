<?php 
	
	if (isset($_COOKIE) && isset($_COOKIE["userId"])) {
		// Si pueden añadir productos al carrito

		if (isset($_POST) && isset($_POST["id"]) && isset($_POST["cantidad"])) {
			// Si se quiere añadir un producto a la cesta

			$id = $_POST["id"];
			$cantidad = $_POST["cantidad"];

			if (!isset($_COOKIE["cesta"])) {
				// Si es el primer producto que se añade, se crea la cookie:
				setcookie("cesta", $id . ":" . $cantidad, time() + (24 * 360 * 10), "/");
			} else {
				// Si la cookie ya está creada:

				$cookie = $_COOKIE["cesta"];

				// Se convierte la cookie en un array manualmente

				$cookieProductos = explode(",", $cookie);
				$nuevaCesta = array();

				foreach ($cookieProductos as $producto) {
					if ($producto != "") {
						$productoPartes = explode(":", $producto);
						$nuevaCesta[ $productoPartes[0] ] = $productoPartes[1];

					}
				}

				# var_dump($nuevaCesta);

				// Se añade el nuevo producto:

				# var_dump($id);
				# var_dump($nuevaCesta);
				# var_dump(in_array($id, $nuevaCesta));
				if (isset($nuevaCesta[$id])) {
					// Si el producto ya está en la cesta
					$nuevaCesta[$id] = intval($nuevaCesta[$id]) + intval($cantidad);
				} else {
					$nuevaCesta[$id] = $cantidad;
				}

				

				// Se convierte, manualmente, el array de nuevo a String:

				$cestaString = "";
				foreach ($nuevaCesta as $idProducto => $cantidadProducto) {
					$cestaString = $cestaString . ($idProducto .":". $cantidadProducto .",");
				}

				// Se 'actualiza' la cookie:

				setcookie("cesta", $cestaString, time() + (24 * 360 * 10), "/");

				echo "\$_COOKIE:";
				var_dump($_COOKIE);

				echo "<br><br>Cesta de la compra (array):";
				var_dump($nuevaCesta);

				//header("Location: #");

			}

		}


	} else {
		// Si no pueden (no ha iniciado sesión), se redirige
		//header("Location ");
	}

	#var_dump($_POST);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Test Cesta</title>
	<meta charset="utf-8">
</head>
<body>

<form method="POST" action="#">
	<input type="text" name="id" placeholder="ID producto añadir"><br>
	<input type="text" name="cantidad" placeholder="Cantidad Producto"><br><br>

	<input type="submit" name="submit" value="Añadir">
</form>
</body>
</html>