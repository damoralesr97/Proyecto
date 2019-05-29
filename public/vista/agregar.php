<?php
    session_start();
    include '../../config/conexionBD.php';
    $id = $_GET['codigo'];
    $cantidad = $_GET['cantidad'];
    $cantidad1 = $_POST['txtC'];
    if($cantidad==0){
        $cantidad=$cantidad1;
    }
    $sql = "SELECT * FROM producto WHERE pro_codigo=$id and pro_loc_codigo=".$_SESSION['local'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $fila = mysqli_fetch_array($result);
        if(!isset($_SESSION['carrito'])){
            $arreglo[0]['idproducto'] = $fila['pro_codigo'];
            $arreglo[0]['nombre'] = $fila['pro_nombre'];
            $arreglo[0]['precio'] = $fila['pro_precio'];
            $arreglo[0]['cantidad'] = $cantidad;
            $_SESSION['carrito'] = $arreglo;
        }else{
            $arreglo = $_SESSION['carrito'];
            $cant = count($arreglo);
            $arreglo[$cant + 1]['idproducto'] = $fila['pro_codigo'];
            $arreglo[$cant + 1]['nombre'] = $fila['pro_nombre'];
            $arreglo[$cant + 1]['precio'] = $fila['pro_precio'];
            $arreglo[$cant + 1]['cantidad'] = $cantidad;
            $_SESSION['carrito'] = $arreglo;

        }
    }
    header("Location: carrito.php")
?>