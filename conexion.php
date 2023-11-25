<?php

$server='localhost';
$user='root';
$pass='';
$db='interface';

 $conexion= new mysqli($server, $user, $pass, $db);

 if($conexion->connect_errno){
     die("Conexion fallida". $conexion->connect_errno);
 }else{
    echo "<label style='color: white;'>Conectado</label>";

 }

// try{
//     $conn=new PDO("mysql:host=$server;dbname=$db;",$user, $pass);
// }catch(PDOException $e){
//     die('Connected failed: '.$e->getMessage());

// }

?>