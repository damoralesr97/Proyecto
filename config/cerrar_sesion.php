<?php
    session_start();
    session_destroy();
    header("Location: /Practicas/Proyecto/public/vista/elegir_local.php");
?>