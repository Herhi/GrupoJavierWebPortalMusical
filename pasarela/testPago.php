<!DOCTYPE html>
<html>
<head>
	<title>Pagos</title>
</head>
<body>
<?php
	
var_dump($_GET);
echo $_GET["Ds_MerchantParameters"];

       /* Importar el fichero principal de la librería, tal y como se muestra a
continuación: */
include_once 'redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';
//El comercio debe decidir si la importación desea hacerla con la función
// “include” o “required”, según los desarrollos realizados.
/* Definir un objeto de la clase principal de la librería, tal y como se
muestra a continuación: */
$miObj = new RedsysAPI;
/* Calcular el parámetro Ds_MerchantParameters. Para llevar a cabo el cálculo
de este parámetro, inicialmente se deben añadir todos los parámetros de la
petición de pago que se desea enviar, tal y como se muestra a continuación: */
$cantidadPagar = 10000; // En céntimos
$miObj->setParameter("DS_MERCHANT_AMOUNT", $cantidadPagar);
$miObj->setParameter("DS_MERCHANT_CURRENCY", "978");
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", "999008881");
$miObj->setParameter("DS_MERCHANT_ORDER", date("ymdHis"));
$miObj->setParameter("DS_MERCHANT_TERMINAL", "1");
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
$miObj->setParameter("DS_MERCHANT_URLKO", "http://localhost/views/pasarela/testPago.php");
$miObj->setParameter("DS_MERCHANT_URLOK", "http://localhost/views/pasarela/testPago.php");

/*Por último, para calcular el parámetro Ds_MerchantParameters, se debe
llamar a la función de la librería “createMerchantParameters()”, tal y como
se muestra a continuación: */
$params = $miObj->createMerchantParameters();
/* Calcular el parámetro Ds_Signature. Para llevar a cabo el cálculo de
este parámetro, se debe llamar a la función de la librería
“createMerchantSignature()” con la clave SHA-256 del comercio (obteniendola
en el panel del módulo de administración), tal y como se muestra a
continuación: */
$claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
$firma = $miObj->createMerchantSignature($claveSHA256);
/* Una vez obtenidos los valores de los parámetros Ds_MerchantParameters y
Ds_Signature , se debe rellenar el formulario de pago con dichos valores, tal
y como se muestra a continuación: */
?>


<form name="from" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
	<input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
	<input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/>
	<input type="hidden" name="Ds_Signature" value="<?php echo $firma; ?>"/>	
	<input type="submit">
</form>
</body>
</html>