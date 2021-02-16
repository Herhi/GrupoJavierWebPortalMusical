<!DOCTYPE html>
<html>
<head>
	<title>Pagos</title>
</head>
<body>

	<?php 

		require("apiRedsys.php");

		$peticion = new RedsysAPI;

		// Se añaden los parámetros obligatorios al objeto
		$cantidadPagar = 10000; // En céntimos

		$peticion->setParameter("DS_MERCHANT_AMOUNT", strval($cantidadPagar));
		$peticion->setParameter("DS_MERCHANT_CURRENCY", "978");
		$peticion->setParameter("DS_MERCHANT_MERCHANTCODE", "999008881");
		$peticion->setParameter("DS_MERCHANT_ORDER", "1446068581");
		$peticion->setParameter("DS_MERCHANT_TERMINAL", "1");
		$peticion->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
		$peticion->setParameter("DS_MERCHANT_URLKO", "http://www.prueba.com/urlKO.php");
		$peticion->setParameter("DS_MERCHANT_URLOK", "http://www.prueba.com/urlOK.php");

		// Encriptado de los datos (en teoría, tampoco es que lo entienda al 100%)
		$params = $peticion->createMerchantParameters();
    	$signature = $peticion->createMerchantSignature('sq7HjrUOBfKmC576ILgskD5srU870gJ7');

	?>
<script src="https://sis-i.redsys.es:25443/sis/NC/inte/redsys2.js"></script>
<form name="from" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
	<input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
	<input type="hidden" name="Ds_MerchantParameters" value=<?php echo $params; ?>/>
	<input type="hidden" name="Ds_Signature" value=<?php echo $signature; ?>/>	
	<input type="submit">
</form>

<script type="text/javascript">
	// Enviar el formulario automáticamente
	// document.querySelector('form').submit();

	/*document.querySelector('form').addEventListener("submit", function(event){
	//	event.preventDefault();
	});*/
</script>
</body>
</html>