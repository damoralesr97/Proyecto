<?php
    session_start();
    $codigoUsr = $_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
        header("Location: /Practicas/Proyecto1/public/vista/elegir_local.php");
    }
    
    include '../../../config/conexionBD.php';
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Productos - Ferreteria</title>
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
                    <li><a href="">FACTURAS</a></li>
                </ul>
            </nav>
            </div>
        </header>
        <aside class="categorias">
            <h3>PRODUCTOS</h3>
            <ul>
                <li><a href="productos.php">DETALLE DE PRODUCTOS</a></li>
                <li><a href="anadir_productos.php">ANADIR PRODUCTO</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>
        <div class="contenedorTabla">
        <table class="tablaLocales">
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th colspan="2">Accion</th>
            </tr>

            <?php

                $sql = "SELECT * FROM producto WHERE pro_loc_codigo=$codigoUsr";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["pro_eliminado"]!='S'){
                            echo "<tr>";
                            echo "<td>" .$row["pro_codigo"]."</td>";
                            echo "<td>" .$row["pro_nombre"]."</td>";
                            echo "<td>" .$row["pro_detalle"]."</td>";
                            echo "<td>" .buscarCat($row["pro_cat_codigo"])."</td>";
                            echo "<td>" .$row["pro_precio"]."</td>";
                            echo "<td>" .$row["pro_cantidad"]."</td>";
                            echo "<td class='accion'><a href='?codigo=".$row['pro_codigo']."'>Modificar</a></td>";
                            echo "<td class='accion'><a href='?codigo=".$row['pro_codigo']."'>Eliminar</a></td>";
                        }
                    }
                }else{
                    echo "<tr>";
                    echo "<td colspan='7'>No existen productos registrados en el sistema</td>";
                    echo "</tr>";
                }
                $conn->close();
                $catName="";
                function buscarCat($codigo){
                    include '../../../config/conexionBD.php';
                    $sqli = "SELECT cat_nombre FROM categoria WHERE cat_codigo='$codigo'";
                    $result = $conn->query($sqli);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $catName=$row['cat_nombre'];
                        }
                    }
                    return $catName;
                }

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