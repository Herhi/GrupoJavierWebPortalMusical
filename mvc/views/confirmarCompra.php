<!DOCTYPE html>
<html>
<head>
	<title>Confirmar Compra</title>
	<meta charset="utf-8" />
</head>
<body>

<!-- Mostrar carrito de la compra -->
<!-- Mostrar precio total a pagar -->

<!-- Variables $parametros & $firma, sacados del controlador 'controller_confirmarPago.php' -->
<form name="from" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
	<input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
	<input type="hidden" name="Ds_MerchantParameters" value="<?php echo $parametros; ?>"/>
	<input type="hidden" name="Ds_Signature" value="<?php echo $firma; ?>"/>	

	<input type="submit" name="confirmar" value="Realizar Compra" />
</form>

<?php 

	
?>

</body>
</html>