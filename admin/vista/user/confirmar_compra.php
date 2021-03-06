<?php
    session_start();
    $codigoUsr=$_SESSION['usuario'];
    $nombre="";
    include '../../../config/conexionBD.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Confirmar Compra</title>
        <link type="text/css" href="../../../css/estilos.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoJ3ujl8XgJZMJ3H8Hfu4wXa41tY_Eozc"></script>
        <script type="text/javascript">
            function initialize() {
                // Creating map object
                var map = new google.maps.Map(document.getElementById('map_canvas'), {
                    zoom: 14,
                    center: new google.maps.LatLng(-2.915132, -78.999517),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(-2.915132, -78.999517),
                    draggable: true
                });

                // adds a listener to the marker
                // gets the coords when drag event ends
                // then updates the input with the new coords
                google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                    //$("#txtLat").val(evt.latLng.lat().toFixed(6));
                    //$("#txtLng").val(evt.latLng.lng().toFixed(6));
                    document.getElementById('txtLat').value = evt.latLng.lat().toFixed(6)
                    document.getElementById('txtLng').value = evt.latLng.lng().toFixed(6)

                    map.panTo(evt.latLng);
                });

                // centers the map on markers coords
                map.setCenter(vMarker.position);

                // adds the marker on the map
                vMarker.setMap(map);
            }
        </script>


    </head>
    <body onload="initialize()">
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
                                $nombre=$row['usu_nombres']." ".$row['usu_apellidos'];
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
        <?php
            function nombreLocal($codigo){
                include '../../../config/conexionBD.php';
                $sql = "SELECT * FROM local WHERE loc_codigo=$codigo";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                             return $row['loc_nombre'];
                        }
                    }
            }
        ?>
        <div class="confComp" >
            <form method="POST" action="../../controladores/user/confirmar_compra.php">
            <label>Cliente:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>" disabled>
            <label>Local:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo nombreLocal($_SESSION['local']);?>" disabled>
            <label>Direccion de envio:</label>
            <input type="text" id="direccion" name="direccion">
            <input type="hidden" id="txtLat" name="txtLat">
            <input type="hidden" id="txtLng" name="txtLng">
            <div id="map_canvas" style="width: 80%; height: 500px;"></div>

            <div class="carroC">
                <?php
                    $total=0;
                    if(isset($_SESSION['carrito'])){
                        $arreglo = $_SESSION['carrito'];
                        echo "<table border='1px'><th>Nombre</th><th>Precio</th><th>Cantidad</th>";
                        foreach($arreglo as $key => $fila){
                            echo "<tr>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td> $ ".number_format($fila['precio'],2,".",".")."</td>";
                            echo "<td>".$fila['cantidad']."</td>";
                            $total=(float)$total+(float)$fila['precio']*(float)$fila['cantidad'];
                            echo "<tr>";
                        }
                        echo "<td class='preciolbl' colspan=2><b>Total:</b> $</td>";
                        echo "<td>".$total."</td>";
                        $_SESSION['total']=$total;
                        echo "</table>";
                    }else{
                        echo "no hay productos";
                    }
                ?>
            </div>

            <input type="submit" name="confComp" id="confComp" value="CONFIRMAR COMPRA">
            
            </form>
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