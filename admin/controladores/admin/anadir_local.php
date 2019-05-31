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

            $nombre = isset($_POST["nombreLoc"]) ? mb_strtoupper(trim($_POST["nombreLoc"]), 'UTF-8') : null;
            $direccion = isset($_POST["direccionLoc"]) ? mb_strtoupper(trim($_POST["direccionLoc"]), 'UTF-8') : null;
            $telefono = isset($_POST["telefonoLoc"]) ? trim($_POST["telefonoLoc"]) : null;
            $mail = isset($_POST["mailLoc"]) ? trim($_POST["mailLoc"]) : null;
            $contrasena = isset($_POST["claveLoc"]) ? trim($_POST["claveLoc"]) : null;
            $lat = $_POST["txtLat"];
            $len = $_POST["txtLng"];
            
            $nombreImg = $_FILES['avatarLoc']['name'];
            $tmp = $_FILES['avatarLoc']['tmp_name'];
            $folder = 'avatars';
            move_uploaded_file($tmp,'../../../imagenes/'.$folder.'/'.$nombreImg);
            $bytesArchivo = file_get_contents($tmp);

            

            $sql = "INSERT INTO local VALUES (0, '$nombre', '$mail', MD5('$contrasena'), '$telefono', '$direccion', null, null, null, 'N', 3, '$lat', '$len')";
            if ($conn->query($sql)==TRUE){
                echo"<p>Se ha creado el local correctamente!!!</p>";
            }else{
                if ($conn->errno == 1062){
                    echo"<p class='error'>El local con el correo electronico $mail ya esta registrado en el sistema</p>";
                }else{
                    echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
                }
            }

            //PARA INSERTAR AVATAR DEL USUARIO
            $sql1 = "SELECT * FROM local WHERE loc_correo='$mail'";
            $result = $conn->query($sql1);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $codigo=$row['loc_codigo'];
                    $sql2 = "UPDATE local SET loc_avatar=? WHERE loc_codigo=?";
                    $stm = $conn->prepare($sql2);
                    $stm->bind_param('ss',$bytesArchivo,$codigo);
                    $stm->execute();
                }
            }
            
            //Cerrar la base de datos
            $conn->close();
            header("Location: /Proyecto/admin/vista/admin/locales.php");
        ?>
    </form>
    </body>
</html>