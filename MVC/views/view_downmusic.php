<?php 
	if (isset($_COOKIE) && isset($_COOKIE["userId"]) === false) {
	  exit("No estas logueado, datos incorrectos.");
		//header('location: ../01-login/controllers/controller_login.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>03-downmusic</title>
    <style>
        table, tr, th, td{border:1px solid black; border-collapse:collapse; text-align: center;}
    </style>
</head>
<body>


        <a href="../controllers/logout.php"><button>Cerrar Sesión</button></a>
                <h1>Bienvenido <?php echo htmlspecialchars($_COOKIE["userId"]) ?></h1>

                <h1 class="text-center"> REALIZAR PEDIDO </h1>

                    <!--IMPORTANTE: La ruta del action es al controller! no a la view!-->
                    <form id="product-form" name="formulario" action="../controllers/controller_downmusic.php" method="post" class="card-body">
                        <div>Cancion:
                            <select name="track">
                                <?php foreach($tracks as $track) : ?>
                                    <option> <?php echo $track ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <br><br>
                            
                        </div>
                         
                        <div>
                            <br>
                            <input type="submit" value="Comprar Canciones" name="comprar">
                            <input type="submit" value="Agregar a la Cesta" name="agregar">
                            <input type="submit" value="Limpiar la Cesta" name="limpiar">
                        </div>
                    </form>    
                <br>


</body>
</html>