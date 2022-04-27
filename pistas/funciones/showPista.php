<?php

require "../../conexion.php";

$sql = "SELECT p.*, s.descripcion FROM pista p INNER JOIN superficie s 
    ON p.IDSuperficie=s.ID ORDER BY p.nombre";
$resultado = $conn->prepare($sql);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

//envio el array final el formato json a AJAX
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
?>