<?php
    session_start();
    $_SESSION['isLogged'] = FALSE;
    session_destroy();
    header("Location: /Practicas/Proyecto/public/vista/home.html");
?>