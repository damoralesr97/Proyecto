<?php
    session_start();
    if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
        header("Location: /Practicas/Proyecto1/public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';
    $codigo = $_SESSION['usuario'];

    $nombre = $_FILES['avatarEd']['name'];
    $tmp = $_FILES['avatarEd']['tmp_name'];
    $folder = 'avatars';
    move_uploaded_file($tmp,'../../../imagenes/'.$folder.'/'.$nombre);

    $bytesArchivo = file_get_contents('../../../imagenes/'.$folder.'/'.$nombre);

    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d H:i:s',time());

    $sql = "UPDATE local SET loc_avatar=?, loc_fecha_modificacion=? WHERE loc_codigo=?";
    $stm = $conn->prepare($sql);
    $stm->bind_param('sss',$bytesArchivo,$fecha,$codigo);
    if($stm->execute()){
        echo 'Avatar actualizado!!!';
    }else{
        echo 'Error!!!';
    }

    echo "<a href='../../vista/local/index.php'>Regresar</a>";
?>