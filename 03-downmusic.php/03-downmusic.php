<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>03-downmusic</title>
    <style>
        table, tr, th, td{border:1px solid black; border-collapse:collapse; text-align: center;}
        #desc{font-weight: bold; font-size:14pt;}
        .estado{color:ForestGreen;};
    </style>
    <!-- <link rel="stylesheet" href="../bootstrap.min.css"> -->
</head>
<body>


<?php

  #Javier Gonzalez
    include_once '03-funciones.php';
    $conn = conexionBBDD();


    try {
    
        if (!isset($_POST) || empty($_POST)) {

            $tracks=obtenerTracks($conn);
?>
        <h1 class="text-center"> REALIZAR PEDIDO </h1>
            <form id="product-form" name="formulario" action="03-downmusic.php" method="post" class="card-body">
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
<?php
        }else{ 

                $track    = ($_POST['track']);
                $track    = getTrackId($track);
                $cantidad = ($_POST['cantidad']);
                //$orderNumber = altaPedido($conn);
                //insertarOrderDetails($conn,$orderNumber, $cantidad);


            }
        }

    catch(PDOException $e)
        {  
            echo $stmt . "<br>" . $e->getMessage();
        }

    $conn = null;
    
?>






</body>
</html>