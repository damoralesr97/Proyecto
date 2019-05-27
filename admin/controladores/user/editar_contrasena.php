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
                header("Location: /Practicas/Proyecto/public/vista/home.html");
            }
            //Incluir conexion a la BD
            include "../../../config/conexionBD.php";

            $codigo = $_POST["codigo"];
            $contrasena1 = isset($_POST["claveAnt"]) ? trim($_POST["claveAnt"]) : null;
            $contrasena2 = isset($_POST["claveNueva"]) ? trim($_POST["claveNueva"]) : null;

            $sqlContrasena1 = "SELECT * FROM usuario WHERE usu_codigo=$codigo and usu_password=MD5('$contrasena1')";
            $result = $conn->query($sqlContrasena1);

            if ($result->num_rows > 0){
                date_default_timezone_set("America/Guayaquil");
                $fecha = date('Y-m-d H:i:s',time());

                $sqlContrasena2 = "UPDATE usuario SET usu_password=MD5($contrasena2), usu_fecha_modificacion='$fecha' WHERE usu_codigo=$codigo";

                if ($conn->query($sqlContrasena2) === TRUE){
                    echo "Se ha actualizado la contrasena correctamente";
                }else{
                    echo "<p>Error: ".mysqli_error($conn)."</p>";
                }
            }else{
                echo "<p>La contrasena actual no coincide con nuestros registros!!!</p>";
            }
            echo "<a href='../../vista/user/index.php'>Regresar</a>";
            $conn->close();
        ?>
        </form>
    </body>
</html>