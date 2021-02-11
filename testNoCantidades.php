<?php 
	
	if (isset($_COOKIE) && isset($_COOKIE["userId"])) {
		// Si pueden añadir productos al carrito

		if (isset($_POST) && isset($_POST["id"])) {
			// Si se quiere añadir un producto a la cesta

			$id = $_POST["id"];

			if (!isset($_COOKIE["cesta"])) {
				// Si es el primer producto que se añade, se crea la cookie:
				setcookie("cesta", $id, time() + (24 * 360 * 10), "/");
			} else {
				// Si la cookie ya está creada:

				$cookie = $_COOKIE["cesta"];

				$cookieProductos = explode(",", $cookie); // Se convierte el String a Array
				array_push($cookieProductos, $id);	// Se añade el nuevo ID del producto
				setcookie("cesta", implode(",", $cookieProductos), time() + (24 * 360 * 10), "/"); // Se actualiza la cookie

				header("Location: #");

			}

		}


	} else {
		// Si no pueden (no ha iniciado sesión), se redirige
		//header("Location ");
	}

	var_dump($_COOKIE);


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

	<input type="submit" name="submit" value="Añadir">
</form>
</body>
</html>