<?php
    session_start();
    $codigo=$_GET['codigo'];
    $codigoUsr = $_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "1"){
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
                        echo "<li><a href='' class='nombreUser'><i>Administrador </i>".$row['usu_nick']."</a>
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
                $conn->close();
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
            <h3>MENU</h3>
            <ul>
                <li><a href="modificar_usuario.php?codigo=<?php echo $codigo?>">DETALLES DE LA CUENTA</a></li>
                <li><a href="modificar_contrasena.php?codigo=<?php echo $codigo?>">CAMBIAR CONTRASEÑA</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>

<form class="formEditarPerfil" method="POST" action="../../controladores/admin/modificar_contrasena_usuario.php">
<h4>EDITAR MI CONTRASEÑA</h4>
<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo ?>" class="campoED">
<label>Contraseña nueva</label>
<input type="password" name="claveNueva" id="claveNueva" class="campoED">
<input type="submit" name="editar" id="editar" value="CAMBIAR CONTRASEÑA">
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