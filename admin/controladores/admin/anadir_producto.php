<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear Nuevo Local</title>
        <link type="text/css" rel="stylesheet" href="../../style.css">
    </head>
    <body>
        <form>
        <?php
            //Incluir conexion a la base de datos
            include '../../../config/conexionBD.php';

            $nombre = isset($_POST["nombreProd"]) ? mb_strtoupper(trim($_POST["nombreProd"]), 'UTF-8') : null;
            $descripcion = isset($_POST["descripcionProd"]) ? mb_strtoupper(trim($_POST["descripcionProd"]), 'UTF-8') : null;
            $precio = isset($_POST["precioProd"]) ? trim($_POST["precioProd"]) : null;
            $stock = isset($_POST["stockProd"]) ? trim($_POST["stockProd"]) : null;
            $categoria = isset($_POST["categoriaProd"]) ? mb_strtoupper(trim($_POST["categoriaProd"]), 'UTF-8') : null;
            
            $nombreImg = $_FILES['imagenProd']['name'];
            $ruta = $_FILES['imagenProd']['tmp_name'];
            $destino = '../../../imagenes/productos/'.strtolower($categoria).'/'.$nombreImg;
            copy($ruta,$destino);

            $sql = "INSERT INTO productos VALUES (0, '$destino', '$nombre', '$descripcion', '$precio', '$stock', '$categoria', 'N', '')";
            if ($conn->query($sql)==TRUE){
                echo"<p>Se ha registrado el producto correctamente!!!</p>";
            }else{
                if ($conn->errno == 1062){
                    echo"<p class='error'>El local con el nombre $nombre ya esta registrado en el sistema</p>";
                }else{
                    echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
                }
            }

            //Cerrar la base de datos
            $conn->close();
            echo"<a href='../../vista/admin/locales.php'>Regresar</a>";
        ?>
    </form>
    </body>
</html>