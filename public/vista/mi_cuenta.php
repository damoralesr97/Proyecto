
<?php
    session_start();
    $_SESSION["local"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi Cuenta - Ferreteria</title>
        <link type="text/css" href="../../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="topHeader">
                <a href="mi_cuenta.php" class="nombreUser">INICIAR SESION O REGISTRARME</a>
            </div>
            <div class="encabezado">
                <nav class="menu">
                    <ul>
                        <li><a href="home.php?codigo=<?php echo $_SESSION["local"] ?>">INICIO</a></li>
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
                </div>
                <div class="carrito">
                    <img src="../../imagenes/iconos/carrito.png" alt="imgCarro">
                    <a href="carrito.php">Carrito</a>
                </div>
            </div>
        </header>
        <div class="contenidoMiCuenta">
            <form class="formulario" method="POST" action="../controladores/login.php">
                <h4>INICIAR SESION</h4>
                <label>Direccion de email</label>
                <input type="email" name="mailIS" id="mailIS" class="campo">
                <label>Contrasena</label>
                <input type="password" name="claveIS" id="claveIS" class="campo">
                <input type="submit" name="btnIS" id="btnIS" value="INICIAR SESION">
            </form>
            <form class="formulario" method="POST" action="../controladores/registrar_usuario.php" enctype="multipart/form-data">
                <h4>REGISTRARME</h4>
                <label>Nombres</label>
                <input type="text" name="nombresReg" id="nombresReg" class="campo">
                <label>Apellidos</label>
                <input type="text" name="apellidosReg" id="apellidosReg" class="campo">
                <label>Direccion de email</label>
                <input type="email" name="mailReg" id="mailReg" class="campo">
                <label>Nick</label>
                <input type="text" name="nickReg" id="nickReg" class="campo">
                <label>Telefono</label>
                <input type="text" name="telefonoReg" id="telefonoReg" class="campo">
                <label>Avatar</label>
                <input type="file" name="avatarReg" id="avatarReg" class="campo">
                <label>Contrasena</label>
                <input type="password" name="claveReg" id="claveReg" class="campo">
                <label>Contrasena (Repetir)</label>
                <input type="password" name="repClaveReg" id="repClaveReg" class="campo">
                <input type="submit" name="btnReg" id="btnReg" value="REGISTRARME">
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