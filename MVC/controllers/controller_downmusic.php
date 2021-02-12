<?php

  #Javier Gonzalez
	
    require_once("../models/model_downmusic.php");

    try {
    
        if (!isset($_POST) || empty($_POST)) {

            $tracks=obtenerTracks();

    		require_once("../views/view_downmusic.php");

    	}else{

            $track = $_POST['track'];
            $track = getTrackId($track);
            

            if(isset($_POST['agregar'])){

                if (!isset($_COOKIE['cesta'])){
                //Si no está creada la cookie hay que crear la cesta con la cancion dentro
                    setcookie('cesta', serialize(array($track)), time() + (86400 * 30), "/");
                }
                else{
                //Si la cookie de cesta ya existe hay que añadir la cancion
                    $cesta=unserialize($_COOKIE['cesta']);

                    array_push($cesta, $track);
                    //hay que actualizar la cookie 
                    setcookie('cesta', serialize($cesta), time() + (86400 * 30), "/");
                }

                var_dump(unserialize($_COOKIE['cesta']));
                header('refresh: 2');


              
            }else if (isset($_POST['limpiar'])){
                //hay multiples formas de hacerlo, desde crear el array vacio, hasta destruir la cookie, restandole el mismo tiempo
                $cesta=array();
                setcookie('cesta', serialize($cesta), time() - (86400 * 30), "/");



            }else if (isset($_POST['comprar'])){
                //codigo de comprar
                if (!empty($_COOKIE['cesta'])){

                    $cesta=unserialize($_COOKIE['cesta']);
                    $pedido=getMaxPedido();
                    $total=0;


                    foreach ($cesta as $cancion) {
                        $total+=getPrecioUnitario($cancion);

                    }

                    echo "Tu pedido es el numero: ".$pedido."<br>";
                    echo "El total a pagar es: ".$total;

                    imprimirCesta($cesta);

                    altaPedido(($_COOKIE['userId']), $total);

                }else{
                    echo 'La cesta está vacía';
                }

            }
              
        }

    }catch(PDOException $e)
        {  
            echo "<br>" . $e->getMessage()."<br>";
        }

    $conexion = null;


?>