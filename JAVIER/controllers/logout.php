<?php 

//Establezo el tiempo de la cookie a 0 
setcookie("userId" , '' , time()-(86400 * 10), '/');
 
//Redirecciono al login
header("location: ../views/login.php");
exit;
?>