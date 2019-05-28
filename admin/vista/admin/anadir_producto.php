<?php
    session_start();
    $codigoUsr = $_SESSION['usuario'];
    if(isset($_SESSION['usuario'])==null || $_SESSION['usuario'] == ""){
        header("Location: ../../../public/vista/elegir_local.php");
    }
    
    include '../../../config/conexionBD.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Locales - Ferreteria</title>
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
                }
            ?>
            </ul>
            </div>
            <div class="encabezado">
            <nav class="menu">
                <ul>
                    <li><a href="index.php">INICIO</a></li>
                    <li><a href="locales.php">LOCALES</a></li>
                    <li><a href="productos.php">PRODUCTOS</a></li>
                    <li><a href="">FACTURAS</a></li>
                    <li><a href="">USUARIOS</a></li>
                </ul>
            </nav>
            </div>
        </header>
        <aside class="categorias">
            <h3>PRODUCTOS</h3>
            <ul>
                <li><a href="productos.php">DETALLES DE PRODUCTOS</a></li>
                <li><a href="anadir_local.php">AÑADIR PRODUCTO</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>
        
        <form class="formEditarPerfil" method="POST" action="../../controladores/admin/anadir_producto.php" enctype="multipart/form-data">
                <h4>AÑADIR PRODUCTO</h4>
                <label>Nombre</label>
                <input type="text" name="nombreProd" id="nombreProd" class="campoED">
                <label>Descripción del producto</label>
                <input type="text" name="descripcionProd" id="descripcionProd" class="campoED">
                <label>Precio Unitario</label>
                <input type="text" name="precioProd" id="precioProd" class="campoED">
                <label>Stock</label>
                <input type="text" name="stockProd" id="stockProd" class="campoED">

                <label>Categoria</label>
                <select style="width:93%" type="text" name="categoriaProd" id="categoriaProd" class="campoED">
                    <option>ACABADOS DE CASA</option>
                    <option>ADITIVOS</option>
                    <option>BASICOS DE LA CONSTRUCCION</option>
                    <option>ELECTRONICO</option>
                    <option>FERRETERIA</option>
                    <option>HIDROSANITARIA</option>
                    <option>HOGAR</option>
                    <option>INDUSTRIA</option>
                    <option>JARDINERIA</option>
                    <option>PINTURA</option>
                    <option>VARIOS</option>
                </select>
                <label>Imagen</label>
                <input type="file" name="imagenProd" id="imagenProd" class="campoED">
                <input type="submit" name="btnLoc" id="btnProd" value="AÑADIR PRODUCTO">
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