<?php
    session_start();
    $arreglo = $_SESSION['carrito'];
    $indice=$_GET['indice'];
    unset($arreglo[$indice]);
    $arreglo = array_values($arreglo);
    $_SESSION['carrito'] = $arreglo;

    header("Location: /Proyecto/admin/vista/user/carrito.php")
?>