<?php

    $db_servername = "localhost";
    $db_username = "8617";
    $db_password = "ferreteria";
    $db_name = "8617";

    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
    $conn->set_charset("utf8");

    #Probar conexion
    
    if ($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }

?>