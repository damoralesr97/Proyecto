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
                header("Location: /Proyecto/public/vista/elegir_local.php");
            }
            //Incluir conexion a la base de datos
            include '../../../config/conexionBD.php';

            $codigo = $_POST["codigo"];
            $nombres = isset($_POST["nombresEd"]) ? mb_strtoupper(trim($_POST["nombresEd"]), 'UTF-8') : null;
            $apellidos = isset($_POST["apellidosEd"]) ? mb_strtoupper(trim($_POST["apellidosEd"]), 'UTF-8') : null;
            $mail = isset($_POST["mailEd"]) ? trim($_POST["mailEd"]) : null;
            $nick = isset($_POST["nickEd"]) ? mb_strtoupper(trim($_POST["nickEd"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefonoEd"]) ? trim($_POST["telefonoEd"]) : null;

            date_default_timezone_set("America/Guayaquil");
            $fecha = date('Y-m-d H:i:s',time());

            $sql = "UPDATE usuario SET usu_nombres = '$nombres', usu_apellidos = '$apellidos', usu_nick = '$nick', usu_correo = '$mail', usu_telefono = '$telefono', usu_fecha_modificacion = '$fecha' WHERE usu_codigo = $codigo";
            
            if ($conn->query($sql) == TRUE){
                echo "Se ha actualizado los datos personales correctamente!!!<br>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($conn)."<br>";
            }
            echo "<a href='../../vista/user/index.php'>Regresar</a>";

            $conn->close();
        ?>
        </form>
    </body>
</html>