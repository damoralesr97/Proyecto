<?php
    session_start();
    session_destroy();
    header("Location: ../public/vista/elegir_local.php");
?>