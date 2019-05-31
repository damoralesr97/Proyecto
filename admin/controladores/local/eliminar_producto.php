<?php
session_start();
       
include '../../../config/conexionBD.php';
$codigoPro = $_GET["codigo"];
//Si voy a eliminar físicamente el registro de la tabla
//$sql = "DELETE FROM usuario WHERE codigo = '$codigo'";
date_default_timezone_set("America/Guayaquil");
$fecha = date('Y-m-d H:i:s', time());
$sql = "UPDATE producto SET pro_eliminado = 'S', pro_fecha_modificacion = '$fecha' WHERE pro_codigo = $codigoPro";

if ($conn->query($sql) === TRUE) {
    echo "<p>Se ha eliminado los datos correctamente!</p>";
} else {
    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
}
echo "<a href='../../vista/local/productos.php'>Regresar</a>";
header("Location: /Proyecto/admin/vista/local/productos.php");
$conn->close();

?>
