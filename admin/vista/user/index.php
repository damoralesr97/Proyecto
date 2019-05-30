<?php
    session_start();
    $codigoUsr = $_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "2"){
        header("Location: ../../../public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';
?>
<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ferreteria - Home</title>
        <link type="text/css" href="../../../css/estilos.css" rel="stylesheet">
        <script>
            /**
             * Array con las imagenes y enlaces que se iran mostrando en la web
             */
            var imagenes=new Array();
            for (var i=1;i<=4;i++) {
                imagenes[i] = "../../../imagenes/img/imgCont"+i.toString()+'.png';
            }
            /**
             * Funcion para cambiar la imagen y link
             */
            function rotarImagenes()
            {
                // obtenemos un numero aleatorio entre 0 y la cantidad de imagenes que hay
                var index=Math.floor(Math.random() * (5 - 1)) + 1;
             
                // cambiamos la imagen
                document.getElementById("imagen").src=imagenes[index];
            }
             
            /**
             * Función que se ejecuta una vez cargada la página
             */
            onload=function()
            {
                // Cargamos una imagen aleatoria
                rotarImagenes();
         
                // Indicamos que cada 5 segundos cambie la imagen
                setInterval(rotarImagenes,5000);
            }
        </script>
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
                        <li><a href="index.php">INICIO</a></li>
                        <li><a href="">NOSOTROS</a>
                            <ul>
                                <li><a href="quienesSomos.php">QUIENES SOMOS</a></li>
                                <li><a href="misionVision.php">MISION Y VISION</a></li>
                                <li><a href="">HISTORIA</a></li>
                            </ul>
                        </li>
                        <li><a href="productos.php">PRODUCTOS</a></li>
                        <li><a href="">CONTACTO</a></li>
                    </ul>
                </nav>
                <div class="busqueda">
                    <input type="search" name="buscar" id="buscar" placeholder="Buscar producto">
                    <a href="">Buscar</a>
                </div>
                <div class="carrito">
                    <img src="../../../imagenes/iconos/carrito.png" alt="imgCarro">
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
            <div class="contenido">
                <article class="imagenesContenido">
                    <img src="" alt="Imagenes promociones" id="imagen">
                </article>
                <div class="caracteristicas">
                    <article class="cajaCarac">
                        <img src="../../../imagenes/iconos/cobertura.png" alt="Cobertura Local">
                        <h4>COBERTURA LOCAL</h4>
                        <p>Contamos con locales en varios sectores de la ciudad</p>    
                    </article>
                    <article class="cajaCarac">
                        <img src="../../../imagenes/iconos/asesoria.png" alt="Asesoria en Productos">
                        <h4>ASESORIA EN PRODUCTOS</h4>
                        <p>Servicio pre y post-venta con atención personalizada.</p>    
                    </article>
                    <article class="cajaCarac">
                        <img src="../../../imagenes/iconos/calidad.png" alt="Productos de calidad">
                        <h4>PRODUCTOS DE CALIDAD</h4>
                        <p>Excelente calidad en todas nuestras líneas de productos.</p>    
                    </article>
                </div>
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