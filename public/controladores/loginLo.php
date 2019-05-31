<?php
    session_start();
    
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["mailIS"]) ? trim($_POST["mailIS"]) : null;
    $contrasena = isset($_POST["claveIS"]) ? trim($_POST["claveIS"]) : null;

    $sql = "SELECT * FROM local WHERE loc_correo = '$usuario' and loc_password = MD5('$contrasena') and loc_rol_codigo=3";
    $result = $conn->query($sql);

    //Una vez verificado el correo y contrasena se inica una sesion y dependiendo del rol del usuario se envia a su index.html correspondiente
    if ($result->num_rows == 1 ){
        while($row = $result->fetch_assoc()){
                $_SESSION['usuario']=$row['loc_codigo'];
                $_SESSION['rol']=$row['loc_rol_codigo'];
                header("Location: /Proyecto/admin/vista/local/index.php");
        }
    }else{
        header("Location: /Proyecto/public/vista/mi_cuentaLo.html");
    }

    $conn->close();

?>