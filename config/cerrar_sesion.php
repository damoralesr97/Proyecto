<?php
    session_start();
    session_destroy();
    header("Location: /Practicas/Proyecto/public/vista/home.html");
?>