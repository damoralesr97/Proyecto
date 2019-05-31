<?php
    session_start();
    session_destroy();
    header("Location: /Proyecto/public/vista/elegir_local.php");
?>