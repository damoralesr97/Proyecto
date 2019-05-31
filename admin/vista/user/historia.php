<?php
    session_start();
    $codigoUsr = $_SESSION["usuario"];
    include '../../../config/conexionBD.php';
?>
<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quienes Somos</title>
        <link type="text/css" href="../../../css/estilos.css" rel="stylesheet">
    </head>
    <body>
    <header>
        <div class="topHeader">
                
                <?php
                    $sqli ="SELECT * FROM usuario WHERE usu_codigo='$codigoUsr'";
                    $stm = $conn->query($sqli);
                    while ($datos = $stm->fetch_object()){
                ?>
                    <img src="data:image/jpg; base64,<?php echo base64_encode($datos->usu_avatar) ?>">
                <?php   
                    }
                ?>
    
                    <ul>
                    <?php
                        $sql = "SELECT * FROM usuario WHERE usu_codigo=$codigoUsr";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<li><a href='' class='nombreUser'><i>Hola </i>".$row['usu_nick']."</a>
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
                        <li><a href="index.php?codigo=<?php echo $_SESSION['local'] ?>">INICIO</a></li>
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
                    <!--<a href="" onsubmit = >Buscar</a>-->
                </div>
                <div class="carrito">
                    <img src="../../../imagenes/iconos/carrito.png" alt="imgCarro">
                    <a href="carrito.php">Carrito</a>
                </div>
            </div>
        </header>
            <div>
                <article>
                    <div>
                            <article class="imagenesContenido">
                            <img id = "h1" src="../../../imagenes/img/h1.jpeg" alt="Imagenes promociones" class="imagenCabecera">
                        </article>
                    </div>
                    <h1 class="tituloContenido">Historia</h1>
                    
                    <p class="contenidoTexto1">
                    En el año 2000 en la ciudad de Cuenca, 
                    una visionaria pareja  abren las puertas de su pequeño negocio , dedicado a comercializar productos de ferretería y materiales
                    de construcción que permitan satisfacer las necesidades de la creciente demanda de esta industria en la ciudad.
                   <br><br>
                    Es importante señalar además, que nuestros servicios están fortalecidos por contar con un stock permanente de 
                    los principales productos de nuestra comercialización.
                   <br><br>
                    Con el transcurso del tiempo de nuestra empresa se ha convertido en una de las empresas líderes en la comercialización de materiales 
                    de construcción, ferretería y productos para el hogar en el mercado ecuatoriano.
                    <br>
                    </p>
                </article>
                
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