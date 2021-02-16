<?php

#Raquel Alcázar

require_once("../models/model_ranking.php");

$customerId=$_COOKIE["userId"];

$canciones=obtenerRanking($customerId);

require_once("../views/ranking.php");

?>
