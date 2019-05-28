<?php
    include '../../config/conexionBD.php'
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seleccionar Local - Ferreteria</title>
        <link type="text/css" href="../../css/estilos.css" rel="stylesheet">
    </head>
    <body class="fondo">

    <div class="elegirLocal">
        <table>

            <?php
                $sql = "SELECT * FROM local";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["loc_eliminado"]!='S'){
                            echo "<tr>";

                            $sqli ="SELECT loc_avatar FROM local WHERE loc_codigo=$row[loc_codigo]";
                            $stm = $conn->query($sqli);
                            while ($datos = $stm->fetch_object()){
                                echo "<td>  <img src='data:image/jpg; base64,".base64_encode($datos->loc_avatar)."'>  </td>";
                            }
                            echo "<td ><a href='home.php?codigo=".$row["loc_codigo"]."'>" .$row["loc_nombre"]."</a></td>";
                            echo "<td class='dirLoc'>" .$row["loc_direccion"]."</td>";
                        }
                    }
                }else{
                    echo "<tr>";
                    echo "<td colspan='3'>No existen locales registrados en el sistema</td>";
                    echo "</tr>";
                }
                $conn->close();
            ?>
        </table>
        </div>
        <div class="pie">
                <a href="mi_cuentaAd.html">Administrador</a>
                <a href="mi_cuentaLo.html">Local</a>
        </div>

    </body>
</html>