<?php
    session_start();
    
    include '../../config/conexionBD.php';

    $usuario = isset($_POST["mailIS"]) ? trim($_POST["mailIS"]) : null;
    $contrasena = isset($_POST["claveIS"]) ? trim($_POST["claveIS"]) : null;

    $sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena')";
    $result = $conn->query($sql);

    //Una vez verificado el correo y contrasena se inica una sesion y dependiendo del rol del usuario se envia a su index.html correspondiente
    if ($result->num_rows > 0 ){
        $_SESSION['isLogged']=TRUE;
        while($row = $result->fetch_assoc()){
            $codigo = $row["usu_codigo"];
            if ($row["rol_usu_codigo"]==1){
                header("Location: ../../admin/vista/admin/index.php?codigo_admin=".$row['usu_codigo']);
            }else{
                header("Location: ../../admin/vista/user/index.php?codigo=".$row['usu_codigo']);
            }
        }
    }else{
        header("Location: ../vista/mi_cuenta.html");
    }

    $conn->close();

?>