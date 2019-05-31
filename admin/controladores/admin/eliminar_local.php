<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eliminar Local - Ferreteria</title>
    </head>
    <body>
        <form>
        <?php
            session_start();
            if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
                header("Location: /Proyecto/public/vista/elegir_local.php");
            }
            //Incluir conexion a la base de datos
            include '../../../config/conexionBD.php';

            $codigo = $_POST["codigoLoc"];
            $nombre = isset($_POST["nombreLoc"]) ? mb_strtoupper(trim($_POST["nombreLoc"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefonoLoc"]) ? trim($_POST["telefonoLoc"]) : null;
            $direccion = isset($_POST["direccionLoc"]) ? mb_strtoupper(trim($_POST["direccionLoc"]), 'UTF-8') : null;
            $mail = isset($_POST["mailLoc"]) ? trim($_POST["mailLoc"]) : null;
            $lat = $_POST["txtLat"];
            $lon = $_POST["txtLng"];

            date_default_timezone_set("America/Guayaquil");
            $fecha = date('Y-m-d H:i:s',time());

            $sql = "UPDATE local SET  loc_eliminado='S', loc_fecha_modificacion = '$fecha'  WHERE loc_codigo = $codigo";
            
            if ($conn->query($sql) == TRUE){
                echo "Se han eliminado los datos del local correctamente!!!<br>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($conn)."<br>";
            }
            echo "<a href='../../vista/admin/locales.php'>Regresar</a>";

            $conn->close();
        ?>
        </form>
    </body>
</html>