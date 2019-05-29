<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Contraseña - Ferreteria</title>
        <link type="text/css" rel="stylesheet" href="../../../style.css">
    </head>
    <body>
        <form>
        <?php
            session_start();
            if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
                header("Location: /Practicas/Proyecto1/public/vista/elegir_local.php");
            }
            //Incluir conexion a la BD
            include "../../../config/conexionBD.php";

            $codigo = $_POST["codigo"];

            $contrasena = isset($_POST["claveNueva"]) ? trim($_POST["claveNueva"]) : null;

            date_default_timezone_set("America/Guayaquil");
            $fecha = date('Y-m-d H:i:s',time());

            $sqlContrasena = "UPDATE usuario SET usu_password=MD5('$contrasena'), usu_fecha_modificacion='$fecha' WHERE usu_codigo=$codigo";

            if ($conn->query($sqlContrasena) === TRUE){
                echo "Se ha actualizado la contrasena correctamente";
            }else{
                echo "<p>Error: ".mysqli_error($conn)."</p>";
            }
            echo "<br>";
            echo "<a href='../../vista/admin/usuarios.php'>Regresar</a>";

            $conn->close();
        ?>
        </form>
    </body>
</html>