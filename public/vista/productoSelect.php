<?php
    session_start();
    $_SESSION["local"];
    $pro_codigo = $_GET['codigo'];
    include '../../config/conexionBD.php'
    
?>
<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ferreteria - Productos</title>
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
                                <li><a href="quienesSomos.php">QUIENES SOMOS</a></li>
                                <li><a href="misionVision.php">MISION Y VISION</a></li>
                                <li><a href="historia.php">HISTORIA</a></li>
                            </ul>
                        </li>
                        <li><a href="productos.php">PRODUCTOS</a></li>
                        <li><a href="contactanos.php">CONTACTO</a></li>
                    </ul>
                </nav>
                <div class="busqueda">
                    <input type="search" name="buscar" id="buscar" placeholder="Buscar producto" onkeyup = "return buscarProducto()"/>
                    <!--<a href="">Buscar</a>-->
                </div>
                <div class="carrito">
                    <img src="../../imagenes/iconos/carrito.png" alt="imgCarro">
                    <a href="carrito.php">Carrito</a>
                </div>
            </div>
        </header>
        <aside class="categorias">
                <h3>CATEGORIAS</h3>
                <ul>
                    <li><a href="acabados_casa.php">ACABADOS DE CASA</a></li>
                    <li><a href="aditivos.php">ADITIVOS</a></li>
                    <li><a href="basicos_cons.php">BASICOS DE LA CONSTRUCCION</a></li>
                    <li><a href="electrico.php">ELECTRICO</a></li>
                    <li><a href="ferreteria.php">FERRETERIA</a></li>
                    <li><a href="hidro.php">HIDROSANITARIA</a></li>
                    <li><a href="hogar.php">HOGAR</a></li>
                    <li><a href="industria.php">INDUSTRIA</a></li>
                </ul>
            </aside>

            <article class="prods">
                <table id = "menuProd">

                    <?php
                        $sql = "SELECT * FROM producto WHERE pro_codigo='$pro_codigo' AND pro_loc_codigo=".$_SESSION["local"];
                        $result = $conn->query($sql);
                        $i=0;
                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                if($row["pro_eliminado"]!='S'){
                                    echo "<tr>";
                                    
                                    $sqli ="SELECT pro_imagen FROM producto WHERE pro_codigo=$row[pro_codigo]";
                                    $stm = $conn->query($sqli);
                                    while ($datos = $stm->fetch_object()){
                                        
                                        echo "<td>  <img src='data:image/jpg; base64,".base64_encode($datos->pro_imagen)."'>  </td>";
                                    }
                                    echo "<form method='post' action=agregar.php?cantidad=0&codigo=".$row['pro_codigo'].">";
                                    echo "<td id='titP'>".$row["pro_nombre"]."</td>";
                                    echo "<td>".$row["pro_detalle"]."</td>";
                                    echo "<td><strong>Stock: </strong>".$row["pro_cantidad"]."</td>";
                                    echo "<td><i>".$row["pro_precio"]."$<i></td>";
                                    echo "<td> <input type='button' onclick='disminuir()' value='-' > <input type='text' name='txtC' id='txtC' value='1'> <input type='button' onclick='aumentar()' value='+'> </td>";
                                    echo "<td><input type='submit' value='Agregar al carrito'></td>";
                                }
                            }
                        }else{
                            echo "<tr>";
                            echo "<td colspan='7'>No existen productos registrados en el sistema</td>";
                            echo "</tr>";
                        }
                        $conn->close();
                    ?>
                </table>
                
            </article>

            <div class="ec-stars-wrapper">
                <a href="mi_cuenta.php" data-value="1" title="Votar con 1 estrellas">&#9733;</a>
                <a href="mi_cuenta.php" data-value="2" title="Votar con 2 estrellas">&#9733;</a>
                <a href="mi_cuenta.php" data-value="3" title="Votar con 3 estrellas">&#9733;</a>
                <a href="mi_cuenta.php" data-value="4" title="Votar con 4 estrellas">&#9733;</a>
                <a href="mi_cuenta.php" data-value="5" title="Votar con 5 estrellas">&#9733;</a>
            </div>

            <?php
            include '../../config/conexionBD.php';
            $sqlC = "SELECT * FROM rating WHERE ra_pro_codigo='$pro_codigo'";
            $resultC = $conn->query($sqlC);
            $rowC = $resultC->fetch_assoc();
            $calificacion = $rowC['ra_calificacion'];

            echo "<div><h5>La calificacion del producto es: $calificacion/5</h5></div>";
            
            ?>


            
            
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