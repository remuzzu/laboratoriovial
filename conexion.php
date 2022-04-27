<?php

/* DATOS PARA TRABAJAR CON EL SERVIDOR 
$servername = '127.0.0.1';
$user = 'laboratoriovial';  //'root';
$pass = 'ViaLab4521';       //'';
$dataBaseName = 'laboratoriovial';  //'laboratorioweb';
*/

/* DATOS PARA TRABAJAR DESDE EL LOCALHOST */
$servername = '127.0.0.1';
$user = 'root';
$pass = '';
$dataBaseName = 'laboratorioweb';


try {
    $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dataBaseName, $user, $pass, 
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(Exception $e){
    echo "ERROR: " . $e->getMessage();
}


?>

