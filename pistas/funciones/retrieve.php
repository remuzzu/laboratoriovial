<?php

//require "../conexion.php";
include ("../../entity/pista.php");

$ot = new pista();
$resultado = $ot->read();

print json_encode($resultado, JSON_UNESCAPED_UNICODE);
?>