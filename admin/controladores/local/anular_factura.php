<?php
    $cF = $_GET['fac'];
    //incluir conexión a la base de datos
    include '../../../config/conexionBD.php';

 
    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d H:i:s', time());
 
    $sql = "UPDATE factura_cabecera SET fc_eliminado = 'S', fc_fecha_eliminado = '$fecha' WHERE fc_codigo = $cF";

    if ($conn->query($sql) === TRUE) {
        echo "Se ha anulado la factura correctamente!!!<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
    echo "<a href='../../vista/local/facturas.php'>Regresar</a>";
    $conn->close();

?>