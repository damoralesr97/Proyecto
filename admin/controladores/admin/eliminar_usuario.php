<?php
session_start();
       
include '../../../config/conexionBD.php';
$codigoUsr = $_GET["codigo"];
//Si voy a eliminar físicamente el registro de la tabla
//$sql = "DELETE FROM usuario WHERE codigo = '$codigo'";
date_default_timezone_set("America/Guayaquil");
$fecha = date('Y-m-d H:i:s', time());
$sql = "UPDATE usuario SET usu_eliminado = 'S', usu_fecha_modificacion = '$fecha' WHERE usu_codigo = $codigoUsr";

if ($conn->query($sql) === TRUE) {
    echo "<p>Se ha eliminado los datos correctamente!</p>";
} else {
    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
}
header("Location: /Proyecto/admin/vista/admin/usuarios.php");
$conn->close();

?>
