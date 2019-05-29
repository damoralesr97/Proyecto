<?php
    session_start();
    $_SESSION["local"];
    include '../../config/conexionBD.php'
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ferreteria - Carrito</title>
        <link type="text/css" href="../../css/estilos.css" rel="stylesheet">
        <script type="text/javascript" src="../../js/funciones.js"></script>
    </head>
    <body>
        <header>
            <div class="topHeader">
                <a href="mi_cuenta.php" class="nombreUser">INICIAR SESION O REGISTRARME</a>
            </div>
            <div class="encabezado">
                <nav class="menu">
                    <ul>
                        <li><a href="home.php?codigo=<?php echo $_SESSION['local'] ?>">INICIO</a></li>
                        <li><a href="">NOSOTROS</a>
                            <ul>
                                <li><a href="">QUIENES SOMOS</a></li>
                                <li><a href="">MISION Y VISION</a></li>
                                <li><a href="">HISTORIA</a></li>
                            </ul>
                        </li>
                        <li><a href="productos.php">PRODUCTOS</a></li>
                        <li><a href="">CONTACTO</a></li>
                    </ul>
                </nav>
                <div class="busqueda">
                    <input type="search" name="buscar" id="buscar" placeholder="Buscar producto" onkeyup = "return buscarProducto()"/>
                    <!--<a href="" onsubmit = >Buscar</a>-->
                </div>
                <div class="carrito">
                    <img src="../../imagenes/iconos/carrito.png" alt="imgCarro">
                    <a href="carrito.php">Carrito</a>
                </div>
            </div>
        </header>

        <div class="carroC">
        <?php
        $total=0;
        if(isset($_SESSION['carrito'])){
            $arreglo = $_SESSION['carrito'];
            echo "<table border='1px'><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Accion</th>";
            $i=0;
            foreach($arreglo as $key => $fila){
                echo "<tr>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td> $ ".number_format($fila['precio'],2,".",".")."</td>";
                echo "<td>".$fila['cantidad']."</td>";
                echo "<td><a href='eliminar.php?indice=".$i."'>Eliminar</a></td>";
                $i++;
                $total=(float)$total+(float)$fila['precio']*(float)$fila['cantidad'];
                echo "<tr>";
            }
            echo "<td class='preciolbl' colspan=3><b>Total:</b> $</td>";
            echo "<td>".$total."</td>";
            $_SESSION['total']=$total;
            echo "</table>";
        }else{
            echo "no hay productos";
        }
        echo "<a class='reglbl' href='productos.php'>SEGUIR COMPRANDO</a>";
    ?>
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


