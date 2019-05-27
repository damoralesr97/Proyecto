<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ferreteria - Home</title>
        <link type="text/css" href="../../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="topHeader">
                <a href="mi_cuenta.html" class="nombreUser">INICIAR SESION O REGISTRARME</a>
            </div>
            <div class="encabezado">
                <nav class="menu">
                    <ul>
                        <li><a href="home.html">INICIO</a></li>
                        <li><a href="">NOSOTROS</a>
                            <ul>
                                <li><a href="">QUIENES SOMOS</a></li>
                                <li><a href="">MISION Y VISION</a></li>
                                <li><a href="">HISTORIA</a></li>
                            </ul>
                        </li>
                        <li><a href="">PRODUCTOS</a></li>
                        <li><a href="">CONTACTO</a></li>
                    </ul>
                </nav>
                <div class="busqueda">
                    <input type="search" name="buscar" id="buscar" placeholder="Buscar producto">
                    <a href="">Buscar</a>
                </div>
                <div class="carrito">
                    <img src="../../imagenes/iconos/carrito.png" alt="imgCarro">
                    <a href="">Carrito</a>
                    <i id="precio">$ 0.00</i>
                </div>
            </div>
        </header>
            <aside class="categorias">
                <h3>CATEGORIAS</h3>
                <ul>
                    <li><a href="">ACABADOS DE CASA</a></li>
                    <li><a href="">ADITIVOS</a></li>
                    <li><a href="">BASICOS DE LA CONSTRUCCION</a></li>
                    <li><a href="">ELECTRICO</a></li>
                    <li><a href="">FERRETERIA</a></li>
                    <li><a href="">HIDROSANITARIA</a></li>
                    <li><a href="">HOGAR</a></li>
                    <li><a href="">INDUSTRIA</a></li>
                </ul>
            </aside>
            <div>
                <article class="imagenesContenido">

                    <table style="width:100%"> 

                        <?php             
                            include '../../config/conexionBD.php';  
                            $sql = "SELECT * FROM productos"; 
                            $result = $conn->query($sql); 
                            //$sql = 'SELECT = FROM news WHERE status <> 0'; 
                
                            if ($result->num_rows > 0) { 
                                    
                                while($row = $result->fetch_assoc()) { 

                                    echo "<tr>"; 
                                    echo "<td>";                  
                                    echo $row['prod_imagen'];
                                    echo "<br>";        
                                    echo $row['prod_descripcion'];  
                                    echo "<br>";        
                                    echo $row['prod_precio'];
                                    echo "<br>";  
                                    echo"</td>";                                              
                                    echo "</tr>";

                                } 

                            } else {                 
                                echo "<tr>";                 
                                echo "<td colspan='7'> No existen productos </td>";                 
                                echo "</tr>"; 
                    
                            }
                                
                            $conn->close();          
                        ?>

                    </table>    
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