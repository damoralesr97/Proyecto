<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Perfil - Ferreteria</title>
    </head>
    <body>
        <form>
        <?php
            session_start();
            if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
                header("Location: /Practicas/Proyecto1/public/vista/elegir_local.php");
            }
            //Incluir conexion a la base de datos
            include '../../../config/conexionBD.php';

            $codigo = $_POST["codigo"];
            $nombre = isset($_POST["nombreEd"]) ? mb_strtoupper(trim($_POST["nombreEd"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefonoEd"]) ? trim($_POST["telefonoEd"]) : null;
            $direccion = isset($_POST["direccionEd"]) ? mb_strtoupper(trim($_POST["direccionEd"]), 'UTF-8') : null;
            $mail = isset($_POST["correoEd"]) ? trim($_POST["correoEd"]) : null;

            date_default_timezone_set("America/Guayaquil");
            $fecha = date('Y-m-d H:i:s',time());

            $sql = "UPDATE local SET loc_nombre = '$nombre', loc_telefono = '$telefono', loc_direccion = '$direccion', loc_correo = '$mail', loc_fecha_modificacion = '$fecha' WHERE loc_codigo = $codigo";
            
            if ($conn->query($sql) == TRUE){
                echo "Se ha actualizado los datos personales correctamente!!!<br>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($conn)."<br>";
            }
            echo "<a href='../../vista/local/index.php'>Regresar</a>";

            $conn->close();
        ?>
        </form>
    </body>
</html>