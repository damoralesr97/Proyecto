<?php
    session_start();
    
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["mailIS"]) ? trim($_POST["mailIS"]) : null;
    $contrasena = isset($_POST["claveIS"]) ? trim($_POST["claveIS"]) : null;

    $sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena')";
    $result = $conn->query($sql);

    //Una vez verificado el correo y contrasena se inica una sesion y dependiendo del rol del usuario se envia a su index.html correspondiente
    if ($result->num_rows > 0 ){
        while($row = $result->fetch_assoc()){
            if ($row["usu_rol_codigo"]==1){
                $_SESSION['usuario']=$row['usu_codigo'];
                $_SESSION['rol']=$row['usu_rol_codigo'];
                header("Location: ../../admin/vista/admin/index.php");
            }else{
                $_SESSION['usuario']=$row['usu_codigo'];
                $_SESSION['rol']=$row['usu_rol_codigo'];
                header("Location: ../../admin/vista/user/index.php");
            }
        }
    }else{
        $sql = "SELECT * FROM local WHERE loc_correo = '$usuario' and loc_password = MD5('$contrasena')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0 ){
            while($row = $result->fetch_assoc()){
                if ($row["loc_rol_codigo"]==3){
                    $_SESSION['usuario']=$row['loc_codigo'];
                    $_SESSION['rol']=$row['loc_rol_codigo'];
                    header("Location: ../../admin/vista/local/index.php");
                }
            }
        }else{
            header("Location: ../vista/mi_cuenta.html");
        }

        
    }

    $conn->close();

?>