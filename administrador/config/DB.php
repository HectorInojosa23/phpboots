<?php


$host = "localhost";
$DB = "biblioteca";
$usuario = "root";
$contrasenia = "";

    try {

        $conexion = new PDO("mysql:host=$host;dbname=$DB", $usuario, $contrasenia);

        if ($conexion) {echo "conectado a sistema";}

    } catch ( Exception $ex) {

        echo $ex->getMessage();

    }


?>