<?php
    session_start();
    include '../../../config/conexionBD.php';
    $_SESSION["local"];
    $codigoUsr = $_SESSION['usuario'];
    $ra_pro_codigo = $_GET['proCodigo'];
    $calificacion = $_GET['calificacion'];

    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d H:i:s', time());

    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "2"){
        header("Location: ../../../public/vista/elegir_local.php");
    }

    $sql = "SELECT * FROM rating WHERE ra_pro_codigo = $ra_pro_codigo";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $unaEstrella = $row['ra_unaEstrella'];
    $dosEstrellas = $row['ra_dosEstrellas'];
    $tresEstrellas = $row['ra_tresEstrellas'];
    $cuatroEstrellas = $row['ra_cuatroEstrellas'];
    $cincoEstrellas = $row['ra_cincoEstrellas'];
    
    if ($result->num_rows > 0){ 

        if($calificacion == 1){

            $unaEstrella = $row['ra_unaEstrella'] + 1;

        }
    
        if($calificacion == 2){

            $dosEstrellas = $row['ra_dosEstrellas'] + 1;
        
        }
    
        if($calificacion == 3){

            $tresEstrellas = $row['ra_tresEstrellas'] + 1;
       
        }
    
        if($calificacion == 4){

            $cuatroEstrellas = $row['ra_cuatroEstrellas'] + 1;
       
        }
    
        if($calificacion == 5){


            $cincoEstrellas = $row['ra_cincoEstrellas'] + 1;
            
        }

        $numerador = (5*$row['ra_cincoEstrellas'] + 4*$row['ra_cuatroEstrellas'] + 3*$row['ra_tresEstrellas'] + 2*$row['ra_dosEstrellas'] + $row['ra_unaEstrella']);
        $denominador = ($row['ra_cincoEstrellas']+$row['ra_cuatroEstrellas']+$row['ra_tresEstrellas']+$row['ra_dosEstrellas']+$row['ra_unaEstrella']);

        $calificacion = $numerador/$denominador;
        echo $calificacion;

        $sql = "UPDATE rating SET ra_unaEstrella = '$unaEstrella', ra_dosEstrellas = '$dosEstrellas', ra_tresEstrellas = '$tresEstrellas', ra_cuatroEstrellas = '$cuatroEstrellas', ra_cincoEstrellas = '$cincoEstrellas', ra_calificacion = '$calificacion', ra_fecha_modificacion = '$fecha' WHERE ra_pro_codigo = $ra_pro_codigo";

        

    }else{

        if($calificacion == 1){

            
            $unaEstrella += 1; 

        }
    
        if($calificacion == 2){

            
            $dosEstrellas += 1; 
        
        }
    
        if($calificacion == 3){

            
            $tresEstrellas += 1; 
       
        }
    
        if($calificacion == 4){

            
            $cuatroEstrellas += 1; 
       
        }
    
        if($calificacion == 5){

            
            $cincoEstrellas += 1; 
            
        }

        $sql = "INSERT INTO rating VALUES (0, '$ra_pro_codigo', '$unaEstrella', '$dosEstrellas', '$tresEstrellas', '$cuatroEstrellas', '$cincoEstrellas', '$calificacion', 'N', null, null)";
        
    }

   
    if ($conn->query($sql)==TRUE){
        echo"<p>Se ha calificado el producto!</p>";
    }else{
        if ($conn->errno == 1062){
            echo"<p class='error'>El producto ya esta registrado en la tabla de calificaciones</p>";
        }else{
            echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
        }
    }

    echo"<a href='../../vista/user/productos.php?calificacion=$calificacion'>Regresar</a>";
    $conn->close();
    
?>
