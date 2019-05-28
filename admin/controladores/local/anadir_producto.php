<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear Nuevo Producto</title>
        <link type="text/css" rel="stylesheet" href="../../style.css">
    </head>
    <body>
        <form>
        <?php
            session_start();
            $codigoUsr = $_SESSION['usuario'];
            //Incluir conexion a la base de datos
            include '../../../config/conexionBD.php';

            $nombre = isset($_POST["nombreP"]) ? mb_strtoupper(trim($_POST["nombreP"]), 'UTF-8') : null;
            $detalle = isset($_POST["detalleP"]) ? mb_strtoupper(trim($_POST["detalleP"]), 'UTF-8') : null;
            $precio = isset($_POST["precioP"]) ? trim($_POST["precioP"]) : null;
            $categoria = isset($_POST["categoriaP"]) ? trim($_POST["categoriaP"]) : null;
            $cantidad = isset($_POST["cantidadP"]) ? trim($_POST["cantidadP"]) : null;
            
            $nombreImg = $_FILES['imagenP']['name'];
            $tmp = $_FILES['imagenP']['tmp_name'];
            $folder = 'productos/'.$categoria;
            move_uploaded_file($tmp,'../../../imagenes/'.$folder.'/'.$nombreImg);
            $bytesArchivo = file_get_contents('../../../imagenes/'.$folder.'/'.$nombreImg);

            

            $sql = "INSERT INTO producto VALUES (0, '$codigoUsr', '$nombre', '$detalle', '$precio', '$categoria', '$cantidad', null, null, null, 'N')";
            if ($conn->query($sql)==TRUE){
                echo"<p>Se ha creado el producto correctamente!!!</p>";
            }else{
                echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
            }

            //PARA INSERTAR AVATAR DEL USUARIO
            $sql1 = "SELECT * FROM producto WHERE pro_nombre='$nombre' and pro_detalle='$detalle' and pro_precio='$precio' and pro_cantidad='$cantidad'";
            $result = $conn->query($sql1);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $codigo=$row['pro_codigo'];
                    $sql2 = "UPDATE producto SET pro_imagen=? WHERE pro_codigo=?";
                    $stm = $conn->prepare($sql2);
                    $stm->bind_param('ss',$bytesArchivo,$codigo);
                    $stm->execute();
                }
            }
            
            //Cerrar la base de datos
            $conn->close();
            echo"<a href='../../vista/local/productos.php'>Regresar</a>";
        ?>
    </form>
    </body>
</html>