<?php

require "../../conexion.php";
//include_once ("../../entity/pista.php");
//include_once '../bd/conexion.php';

// Lo siguiente lo colocamos asi, porque puede venir de diferentes OPCIONES y no tener estos valores:
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
$idSup =(isset($_POST['superficie'])) ? $_POST['superficie'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO usuarios (username, first_name, last_name, gender, password, status) VALUES('$username', '$first_name', '$last_name', '$gender', '$password', '$status') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios ORDER BY user_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE usuarios SET username='$username', first_name='$first_name', last_name='$last_name', gender='$gender', password='$password', status='$status' WHERE user_id='$user_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM usuarios WHERE user_id='$user_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        //Antes de eliminar tendriamos que fijarnos que no esté asociado a ninguna medición        
        $consulta = "DELETE FROM usuarios WHERE user_id='$user_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:
        $sql = "SELECT p.*, s.descripcion FROM pista p INNER JOIN superficie s 
            ON p.IDSuperficie=s.ID ORDER BY p.nombre";
        $resultado = $conn->prepare($sql);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

//envio el array final el formato json a AJAX
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
?>