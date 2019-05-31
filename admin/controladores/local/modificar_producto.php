<?php
 //incluir conexión a la base de datos
 include '../../../config/conexionBD.php';

 $codigo = $_POST["codigoP"];
 $nombre = isset($_POST["nombreP"]) ? mb_strtoupper(trim($_POST["nombreP"]), 'UTF-8') : null;
 $detalle = isset($_POST["detalleP"]) ? mb_strtoupper(trim($_POST["detalleP"]), 'UTF-8') : null;
 $precio = isset($_POST["precioP"]) ? trim($_POST["precioP"]) : null;
 $categoria = isset($_POST["categoriaP"]) ? trim($_POST["categoriaP"]) : null;
 $cantidad = isset($_POST["cantidadP"]) ? trim($_POST["cantidadP"]) : null;
 
 date_default_timezone_set("America/Guayaquil");
 $fecha = date('Y-m-d H:i:s', time());
 
 $sql = "UPDATE producto SET pro_nombre = '$nombre', pro_detalle = '$detalle', pro_precio = '$precio', pro_cat_codigo = '$categoria', pro_cantidad = '$cantidad', pro_fecha_modificacion = '$fecha' WHERE pro_codigo = $codigo";

 if ($conn->query($sql) === TRUE) {
 echo "Se ha actualizado los datos personales correctamente!!!<br>";
 } else {
 echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
 }
 header("Location: /Proyecto/admin/vista/local/productos.php");
 $conn->close();

?>