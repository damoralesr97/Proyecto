<?php
    session_start();
    $codigoUsr=$_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
        header("Location: /Practicas/Proyecto/public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';
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
            ?>
            </ul>
            </div>
            <div class="encabezado">
                <nav class="menu">
                    <ul>
                        <li><a href="index.php">INICIO</a></li>
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
                    <img src="../../../imagenes/iconos/carrito.png" alt="imgCarro">
                    <a href="">Carrito</a>
                    <i id="precio">$ 0.00</i>
                </div>
            </div>
        </header>
        <aside class="categorias">
            <h3>MENU</h3>
            <ul>
                <li><a href="">PEDIDOS</a></li>
                <li><a href="editar_perfil.php">DETALLES DE LA CUENTA</a></li>
                <li><a href="editar_avatar.php">CAMBIAR AVATAR</a></li>
                <li><a href="editar_contrasena.php">CAMBIAR CONTRASEÑA</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>

        <form class="formEditarPerfil" method="POST" action="../../controladores/user/modificar.php">
            <h4>EDITAR MI PERFIL</h4>
            <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigoUsr ?>" class="campoED">
            <label>Nombres</label>
            <input type="text" name="nombresEd" id="nombresEd" value="<?php echo $row["usu_nombres"] ?>" class="campoED">
            <label>Apellidos</label>
            <input type="text" name="apellidosEd" id="apellidosEd" value="<?php echo $row["usu_apellidos"] ?>" class="campoED">
            <label>Nick</label>
            <input type="text" name="nickEd" id="nickEd" value="<?php echo $row["usu_nick"] ?>" class="campoED">
            <label>Telefono</label>
            <input type="text" name="telefonoEd" id="telefonoEd" value="<?php echo $row["usu_telefono"] ?>" class="campoED">
            <label>Correo</label>
            <input type="text" name="mailEd" id="mailEd" value="<?php echo $row["usu_correo"] ?>" class="campoED">
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