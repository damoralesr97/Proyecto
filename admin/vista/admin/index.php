<?php
    session_start();
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
        <title>Ferreteria - Administrador</title>
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
    <article class="infoAdmin">
        <h4>PAGINA DE ADMINISTRADOR</h4>
        <img src="data:image/jpg; base64,<?php echo base64_encode($datos->usu_avatar) ?>">
        <br>
        <label>NOMBRES</label>
        <p><?php echo $row['usu_nombres'] ?></p>
        <label>APELLIDOS</label>
        <p><?php echo $row['usu_apellidos'] ?></p>
        <label>NICK</label>
        <p><?php echo $row['usu_nick'] ?></p>
        <label>TELEFONO</label>
        <p><?php echo $row['usu_telefono'] ?></p>
        <label>CORREO</label>
        <p><?php echo $row['usu_correo'] ?></p>
    <?php
            }
        }
    }
    ?>
    </article>
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