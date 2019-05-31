<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear Nuevo Usuario</title>
        <link type="text/css" rel="stylesheet" href="../../style.css">
    </head>
    <body>
        <form class="box">
        <?php
            //Incluir conexion a la base de datos
            include '../../config/conexionBD.php';

            $nombres = isset($_POST["nombresReg"]) ? mb_strtoupper(trim($_POST["nombresReg"]), 'UTF-8') : null;
            $apellidos = isset($_POST["apellidosReg"]) ? mb_strtoupper(trim($_POST["apellidosReg"]), 'UTF-8') : null;
            $mail = isset($_POST["mailReg"]) ? trim($_POST["mailReg"]) : null;
            $nick = isset($_POST["nickReg"]) ? mb_strtoupper(trim($_POST["nickReg"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefonoReg"]) ? trim($_POST["telefonoReg"]) : null;
            
            $nombreImg = $_FILES['avatarReg']['name'];
            $tmp = $_FILES['avatarReg']['tmp_name'];
            $folder = 'avatars';
            move_uploaded_file($tmp,'../../imagenes/'.$folder.'/'.$nombreImg);
            $bytesArchivo = file_get_contents('../../imagenes/'.$folder.'/'.$nombreImg);

            $contrasena1 = isset($_POST["claveReg"]) ? trim($_POST["claveReg"]) : null;
            $contrasena2 = isset($_POST["repClaveReg"]) ? trim($_POST["repClaveReg"]) : null;

            $sql = "INSERT INTO usuario VALUES (0, '$nombres', '$apellidos', '$nick', '$mail', MD5('$contrasena1'), '$telefono', null, null, null, 'N', 2)";
            if ($conn->query($sql)==TRUE){
                echo"<p>Se han creado los datos personales correctamente!!!</p>";
            }else{
                if ($conn->errno == 1062){
                    echo"<p class='error'>La persona con el correo electronico $mail ya esta registrada en el sistema</p>";
                }else{
                    echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
                }
            }
            //PARA INSERTAR AVATAR DEL USUARIO
            $sql1 = "SELECT * FROM usuario WHERE usu_correo='$mail'";
            $result = $conn->query($sql1);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $codigo=$row['usu_codigo'];
                    $sql2 = "UPDATE usuario SET usu_avatar=? WHERE usu_codigo=?";
                    $stm = $conn->prepare($sql2);
                    $stm->bind_param('ss',$bytesArchivo,$codigo);
                    $stm->execute();
                }
            }
            
            //Cerrar la base de datos
            $conn->close();
            echo"<a href='../vista/mi_cuenta.php'>Regresar</a>";
        ?>
    </form>
    </body>
</html>