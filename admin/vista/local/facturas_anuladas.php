<?php
    session_start();
    $codigoUsr = $_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "3"){
        header("Location: /Proyecto/public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Facturas - Ferreteria</title>
        <link type="text/css" href="../../../css/estilos.css" rel="stylesheet">
    </head>
    <body>
    <header>
        <div class="topHeader">

            <?php
                $sqli ="SELECT * FROM local WHERE loc_codigo='$codigoUsr'";
                $stm = $conn->query($sqli);
                while ($datos = $stm->fetch_object()){
            ?>
                <img src="data:image/jpg; base64,<?php echo base64_encode($datos->loc_avatar) ?>">
            <?php   
                }
            ?>

            <ul>
            <?php
                $sql = "SELECT * FROM local WHERE loc_codigo=$codigoUsr";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<li><a href='' class='nombreUser'><i>Local </i>".$row['loc_nombre']."</a>
                            <ul>
                                <li><a href='editar_perfil.php'>Editar mi perfil</a></li>
                                <li><a href='../../../config/cerrar_sesion.php'>Cerrar Sesion</a></li>
                            </ul>
                        </li>";
                    }
                }
            ?>
            </ul>
            </div>
            <div class="encabezado">
            <nav class="menu">
                <ul>
                    <li><a href="index.php">INICIO</a></li>
                    <li><a href="productos.php">PRODUCTOS</a></li>
                    <li><a href="facturas.php">FACTURAS</a></li>
                </ul>
            </nav>
            </div>
        </header>
        <aside class="categorias">
            <h3>FACTURAS</h3>
            <ul>
                <li><a href="facturas.php">DETALLE DE FACTURAS</a></li>
                <li><a href="facturas_anuladas.php">FACTURAS ANULADAS</a></li>
                <li><a href="../../../config/cerrar_sesion.php">CERRAR SESION</a></li>
            </ul>
        </aside>

        <div class="contenedorTabla">
        <table class="tablaLocales">
            <tr>
                <th>Factura Num</th>
                <th>Cliente</th>
                <th>Fecha Emision</th>
                <th>Detalle</th>
            </tr>

            <?php

                $sql = "SELECT * FROM factura_cabecera WHERE fc_loc_codigo=$codigoUsr and fc_eliminado='S'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["fc_eliminado"]!='N'){
                            echo "<tr>";
                            echo "<td>" .$row["fc_codigo"]."</td>";
                            echo "<td>" .$row["fc_usu_codigo"]."</td>";
                            echo "<td>" .$row["fc_fecha_creacion"]."</td>";
                            echo "<td><a href='factura_detalle.php?usu=".$row["fc_usu_codigo"]."&fac=".$row["fc_codigo"]."'>Ver</a></td>";
                        }
                    }
                }else{
                    echo "<tr>";
                    echo "<td colspan='4'>No existen facturas anuladas en el sistema.</td>";
                    echo "</tr>";
                }
                $conn->close();
            ?>
        </table>
        </div>

        <footer>
            <div class="contenidoPie">
                <div class="infoPie">
                    <h3>INFORMACION DE CONTACTO</h3>
                    <div class="detalleInfoPie">
                        <p class="tituloDetalleInfoPie">DIRECCION</p>
                        <p class="textoDetalleInfoPie">Av. Huayna Capac y Pio Bravo. Matriz Cuenca</p>
                    </div>
                    <div class="detalleInfoPie">
                        <p class="tituloDetalleInfoPie">TELEFONO</p>
                        <p class="textoDetalleInfoPie">(07) 4123150</p>
                    </div>
                    <div class="detalleInfoPie">
                        <p class="tituloDetalleInfoPie">EMAIL</p>
                        <p class="textoDetalleInfoPie">servicio@ferreteria.com</p>
                    </div>
                </div>
                <div class="infoPie">
                    <h3>ENCUENTRANOS</h3>
                    <div class="detalleInfoPie">
                        <p class="tituloDetalleInfoPie">MATRIZ</p>
                        <p class="textoDetalleInfoPie">Av. Huayna Capac y Pio Bravo. Matriz Cuenca</p>
                    </div>
                    <div class="detalleInfoPie">
                        <p class="tituloDetalleInfoPie">SUCURSAL 1</p>
                        <p class="textoDetalleInfoPie">Av. 10 de Agosto y Francisco Moscoso</p>
                    </div>
                    <div class="detalleInfoPie">
                        <p class="tituloDetalleInfoPie">SUCURSAL 2</p>
                        <p class="textoDetalleInfoPie">Av. de las Americas</p>
                    </div>
                </div>
            </div>
            <div class="derechos">
                <p>Desarrollado por: Jose Calle, Pablo Calle, Marcelo Durazno, David Morales, Esteban Rosero</p>
                <p>Copyright &copy; 2019 Todos los derechos reservados</p>
            </div>
        </footer>
    </body>
</html>