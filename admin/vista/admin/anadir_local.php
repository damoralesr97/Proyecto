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
        <title>Locales - Ferreteria</title>
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
    <body onload="initialize();">
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
                        echo "<li><a href='' class='nombreUser'><i>Administrador </i>".$row['usu_nick']."</a>
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
                    <li><a href="locales.php">LOCALES</a></li>
                    <li><a href="usuarios.php">USUARIOS</a></li>
                </ul>
            </nav>
            </div>
        </header>
        <aside class="categorias">
            <h3>LOCALES</h3>
            <ul>
                <li><a href="locales.php">DETALLES DE LOCALES</a></li>
                <li><a href="anadir_local.php">AÑADIR LOCAL</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>
        
        <form class="formEditarPerfil" method="POST" action="../../controladores/admin/anadir_local.php" enctype="multipart/form-data">
                <h4>AÑADIR LOCAL</h4>
                <label>Nombre</label>
                <input type="text" name="nombreLoc" id="nombresLoc" class="campoED">
                <label>Direccion</label>
                <input type="text" name="direccionLoc" id="direccionLoc" class="campoED">
                <input type="hidden" id="txtLat" name="txtLat">
                <input type="hidden" id="txtLng" name="txtLng">
                <div id="map_canvas" style="width: 80%; height: 500px; margin: auto;"></div>
                <label>Telefono</label>
                <input type="text" name="telefonoLoc" id="telefonoLoc" class="campoED">
                <label>Avatar</label>
                <input type="file" name="avatarLoc" id="avatarLoc" class="campoED">
                <label>Direccion de email</label>
                <input type="email" name="mailLoc" id="mailLoc" class="campoED">
                <label>Contrasena</label>
                <input type="password" name="claveLoc" id="claveLoc" class="campoED">
                <input type="submit" name="btnLoc" id="btnLoc" value="AÑADIR LOCAL">
            </form>
        
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