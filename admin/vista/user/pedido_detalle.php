<?php
    session_start();
    $cF=$_GET['fac'];
    $lto=0;
    $lno=0;
    $ltd=0;
    $lnd=0;
    $codigoUsr=$_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "2"){
        header("Location: /Proyecto/public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';

    $sql = "SELECT * FROM factura_cabecera WHERE fc_codigo=".$cF;
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $ltd=$row['fc_latitud'];
            $lnd=$row['fc_longitud'];
        }
    }

    $sql = "SELECT * FROM local WHERE loc_codigo=".$_SESSION['local'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $lto=$row['loc_latitud'];
            $lno=$row['loc_longitud'];
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Perfil - Ferreteria</title>
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
                }else{
                    echo "<p>Ha ocurrido un error inesperdado</p>";
                    echo "<p>".mysqli_error($conn)."</p>";
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
            <h3>MENU</h3>
            <ul>
                <li><a href="pedidos.php">PEDIDOS</a></li>
                <li><a href="editar_perfil.php">DETALLES DE LA CUENTA</a></li>
                <li><a href="editar_avatar.php">CAMBIAR AVATAR</a></li>
                <li><a href="editar_contrasena.php">CAMBIAR CONTRASEÑA</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>


        <div class="contenedorTabla">
        <table class="tablaLocales">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th></th>
            </tr>

            <?php
                $total=0;
                $dir="";
                $sql = "SELECT * FROM factura_cabecera, factura_detalle WHERE fc_codigo=fd_fc_codigo and fc_codigo=".$cF;
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["fc_eliminado"]!='S'){
                            echo "<tr>";
                            echo "<td>" .$row["fd_pro_codigo"]."</td>";
                            echo "<td>" .$row["fd_cantidad"]."</td>";
                            echo "<td>" .$row["fd_precio"]."</td>";
                            echo "<td>" .$row["fd_total"]."</td>";
                            $total=(float)$total+(float)$row["fd_total"];
                            $dir=$row['fc_direccion'];
                        }
                    }
                    echo "<tr>";
                    echo "<td colspan='3'>TOTAL</td>";
                    echo "<td id='totApgr'>".$total."</td>";                   
                    echo "</tr>";
                }else{
                    echo "<tr>";
                    echo "<td colspan='4'>No tienes pedidos en tu cuenta!!!</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <div class="ubi">
        <label><b>Enviar Pedido A:</b> <?php echo $dir ?></label>
        <div id="floating-panel">
            <b>Modo de Viaje: </b>
            <select id="mode">
                <option value="DRIVING">Coche</option>
                <option value="WALKING">A Pie</option>
                <option value="BICYCLING">Bicicleta</option>
                <option value="TRANSIT">Transito</option>
            </select>
        </div>
        <div id="map" style="width: 100%; height: 500px;"></div>

        <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoJ3ujl8XgJZMJ3H8Hfu4wXa41tY_Eozc&callback=initMap">
    </script>

        <script>
      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 1,
          center: {lat: -2.908447, lng: -79.007989}
        });
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: {lat: <?php echo (float)$lto ?>, lng: <?php echo (float)$lno ?>},  // Haight.
          destination: {lat: <?php echo (float)$ltd ?>, lng: <?php echo (float)$lnd ?>},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>

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