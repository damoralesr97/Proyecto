<?php
    session_start();
    
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["mailIS"]) ? trim($_POST["mailIS"]) : null;
    $contrasena = isset($_POST["claveIS"]) ? trim($_POST["claveIS"]) : null;

    $sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena') and usu_rol_codigo=1";
    $result = $conn->query($sql);

    //Una vez verificado el correo y contrasena se inica una sesion y dependiendo del rol del usuario se envia a su index.html correspondiente
    if ($result->num_rows == 1 ){
        while($row = $result->fetch_assoc()){
                $_SESSION['usuario']=$row['usu_codigo'];
                $_SESSION['rol']=$row['usu_rol_codigo'];
                header("Location: /Proyecto/admin/vista/admin/index.php");
        }
    }else{
        header("Location: /Proyecto/public/vista/mi_cuentaAd.html");
    }

    $conn->close();

?>