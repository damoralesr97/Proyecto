<?php
    session_start();
    $codigoUsr=$_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "3"){
        header("Location: /Proyecto/public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Perfil - Ferreteria</title>
        <link type="text/css" href="../../../css/estilos.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoJ3ujl8XgJZMJ3H8Hfu4wXa41tY_Eozc"></script>
        <script type="text/javascript">
            function initialize(lat,lng) {
                // Creating map object
                var map = new google.maps.Map(document.getElementById('map_canvas'), {
                    zoom: 14,
                    center: new google.maps.LatLng(lat,lng),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat,lng),
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
    
    <?php
        $sql = "SELECT * FROM local WHERE loc_codigo=".$_SESSION['usuario'];
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
    ?>
    <body onload="initialize(<?php echo floatval($row['loc_latitud']) ?>,<?php echo floatval($row['loc_longitud']) ?>)">
    <?php
            }
        }
    ?>

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
                                <li><a href='editar_informacion.php'>Editar mi perfil</a></li>
                                <li><a href='../../../config/cerrar_sesion.php'>Cerrar Sesion</a></li>
                            </ul>
                        </li>";
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
            <h3>MENU</h3>
            <ul>
                <li><a href="editar_informacion.php">DETALLES DE LA CUENTA</a></li>
                <li><a href="editar_avatar.php">CAMBIAR AVATAR</a></li>
                <li><a href="editar_contrasena.php">CAMBIAR CONTRASEÑA</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>

        <form class="formEditarPerfil" method="POST" action="../../controladores/local/modificar.php">
            <h4>EDITAR MI PERFIL</h4>
            <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigoUsr ?>" class="campoED">
            <label>Nombre</label>
            <input type="text" name="nombreEd" id="nombreEd" value="<?php echo $row["loc_nombre"] ?>" class="campoED">
            <label>Telefono</label>
            <input type="text" name="telefonoEd" id="telefonoEd" value="<?php echo $row["loc_telefono"] ?>" class="campoED">
            <label>DIRECCION</label>
            <input type="text" name="direccionEd" id="direccionEd" value="<?php echo $row["loc_direccion"] ?>" class="campoED">
            <input type="hidden" id="txtLat" name="txtLat" value="<?php echo $row['loc_latitud'] ?>">
            <input type="hidden" id="txtLng" name="txtLng" value="<?php echo $row['loc_longitud'] ?>">
            <div id="map_canvas" style="width: 80%; height: 500px;"></div>
            <label>Correo</label>
            <input type="text" name="correoEd" id="correoEd" value="<?php echo $row["loc_correo"] ?>" class="campoED">
            <input type="submit" name="editar" id="editar" value="GUARDAR LOS CAMBIOS">
        </form>
        <?php
            }
        }else{
            echo "<p>Ha ocurrido un error inesperdado</p>";
            echo "<p>".mysqli_error($conn)."</p>";
        }
        $conn->close();
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