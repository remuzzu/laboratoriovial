<?php

//Colocamos el siguiente header para que aparezcan correctamente los acentos 
//OJO que va en conjunto con la linea JSON_UNESCAPED_UNICODE (en el print)
//header('Content-type: application/json; charset=utf-8');

include ("../../entity/pista.php");

$parametro = $_POST['parametro'];
$IDpista= $_POST['IDpista'];
$anio= $_POST['anio'];

$ot = new pista();
if ($IDpista==-1){
    $resultado = $ot->read();
} else {
    $resultado = $ot->single_record($IDpista);
}
print json_encode($resultado, JSON_UNESCAPED_UNICODE);


//caso 1
//print json_encode($resultado, JSON_UNESCAPED_UNICODE);

//caso 2
//print($resultado);

//caso 3
//La sgte.linea nos sirve solo si estamos trabajando con numeros
//Es decir: si queremos SUMAR debemos utilizar JSON_NUMERIC_CHECK
//caso contrario si en el ajax hacemos 3 + 5 -> devuelve 35 en lugar de 8 (es decir que concatena!!)
//print json_encode($resultado, JSON_NUMERIC_CHECK);

//caso 4
//print json_encode($resultado, JSON_UNESCAPED_UNICODE);




//https://www.youtube.com/watch?v=VFLja08YEfg
?>