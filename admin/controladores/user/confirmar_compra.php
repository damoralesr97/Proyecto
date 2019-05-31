<?php
    session_start();
    $codUsu = $_SESSION['usuario'];
    $codLoc = $_SESSION['local'];
    $arreglo = $_SESSION['carrito'];
    $codFac="";
    include '../../../config/conexionBD.php';

    $direc = isset($_POST["direccion"]) ? trim($_POST["direccion"]) : null;
    $lat = $_POST["txtLat"];
    $lng = $_POST["txtLng"];

    $sql="INSERT INTO `factura_cabecera`(`fc_codigo`, `fc_usu_codigo`, `fc_loc_codigo`, `fc_direccion`, `fc_latitud`, `fc_longitud`, `fc_fecha_creacion`, `fc_fecha_eliminado`, `fc_eliminado`) VALUES (0,'$codUsu','$codLoc','$direc','$lat','$lng',null,null,'N')";
    if ($conn->query($sql)==TRUE){
        $sql2="SELECT * FROM factura_cabecera WHERE fc_usu_codigo='$codUsu' and fc_latitud='$lat' and fc_longitud='$lng'";
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0){
            while($row = $result2->fetch_assoc()){
                echo $codFac = $row['fc_codigo'];
                echo "<br>";
            }
        }
        $t=0;
        $i=3;
        foreach($arreglo as $key => $fila){
            $t=(float)$fila['precio']*(float)$fila['cantidad'];
            $i="INSERT INTO `factura_detalle`(`fd_codigo`, `fd_fc_codigo`, `fd_pro_codigo`, `fd_cantidad`, `fd_precio`, `fd_total`) VALUES (0,".(int)$codFac.",".(int)$fila['idproducto'].",".(float)$fila['cantidad'].",".(float)$fila['precio'].",".(float)$t.");";
            echo "<br>";
            $result = $conn->query($i);
            $i++;
            $t=0;
        }
        echo "Pedido realizado con exito";
    }else{
        echo "Tuvimos un problema al procesar tu pedido";
        echo "Error: " .mysqli_error($conn);
    }
    header("Location: /Proyecto/admin/vista/user/index.php");

?>