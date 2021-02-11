<?php 
	if (isset($_COOKIE) && isset($_COOKIE["userId"])) {
		// Redireccionar al usuario a otra página, ya se ha iniciado la sesión
		echo "<p style='color: green;'>Ha iniciado sesión, redireccionando... (NO IMPREMENTADO AÚN, NO ES QUE NO FUNCIONE. ACORDAUS DE QUITAR ESTE MENSAJE PLS)</p><br>";
		// header("Location: ");
	} else if (isset($_GET) && isset($_GET["didWork"])) {
		$iniciadoSesion = $_GET["didWork"] == "1"; // TRUE si es 1, FALSE si es 0. No se declara si no se ha enviado el formulario antes
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8" />
</head>
<body>
<form action="../controllers/controller_login.php" method="POST">
	<?php if (isset($iniciadoSesion) && !$iniciadoSesion) echo "<p style='color: red;'>El usuario o la contraseña no son correctas.</p><br><br>"; ?>

	<label>Usuario:</label><br>
	<?php 
		if (isset($iniciadoSesion) && !$iniciadoSesion && isset($usuario)) { // Si ha ocurrido un error, se mantiene el usuario, para una mejor experiencia del usuario, owo
			echo '<input type="text" name="user" value="'. $usuario .'" required /><br><br>';
		} else {
			echo '<input type="text" name="user" required /><br><br>';
		}
	?>

	<label>Contraseña:</label><br>
	<input type="password" name="password" required /><br><br>

	<input type="submit" name="iniciarSesion" value="Iniciar Sesión" />
	
</form>

</body>
</html>
