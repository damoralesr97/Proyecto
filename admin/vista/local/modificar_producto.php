<?php
    session_start();
    $codigoUsr = $_SESSION['usuario'];
    $codigoPro = $_GET["codigo"];
    if(isset($_SESSION['usuario'])==null || $_SESSION['rol'] != "3"){
        header("Location: /Proyecto/public/vista/elegir_local.php");
    }
    include '../../../config/conexionBD.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Productos - Ferreteria</title>
        <link type="text/css" href="../../../css/estilos.css" rel="stylesheet">
    </head>
    <body>
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
                    }
                }
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
            <h3>PRODUCTOS</h3>
            <ul>
                <li><a href="productos.php">DETALLE DE PRODUCTOS</a></li>
                <li><a href="anadir_productos.php">ANADIR PRODUCTO</a></li>
                <li><a href="">CERRAR SESION</a></li>
            </ul>
        </aside>

        <?php
            $sql = "SELECT * FROM producto where pro_codigo=$codigoPro";
            include '../../../config/conexionBD.php';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {
        ?>
                    <form class="formEditarPerfil" method="POST" action="../../controladores/local/modificar_producto.php" enctype="multipart/form-data">
                        <h4>MODIFICAR PRODUCTO</h4>
                        <input type="hidden" id="codigoP" name="codigoP" value="<?php echo $codigoPro ?>" />
                        <label>Nombre</label>
                        <input type="text" name="nombreP" id="nombresP" class="campoED" value="<?php echo $row["pro_nombre"]?>">
                        <label>Detalle</label>
                        <input type="text" name="detalleP" id="detalleP" class="campoED" value="<?php echo $row["pro_detalle"]?>">
                        <label>Precio</label>
                        <input type="text" name="precioP" id="precioP" class="campoED" value="<?php echo $row["pro_precio"]?>">
                        <label>Categoria</label>
                        <?php
                            $pro_cat_codigo=$row['pro_cat_codigo'];
                            $sqlC = "SELECT cat_nombre FROM categoria WHERE cat_codigo=$pro_cat_codigo";
                            $res=$conn->query($sqlC);
                            $rowC=mysqli_fetch_array($res);
                            $categoria = $rowC["cat_nombre"]; 
                            echo "<h5> Categoria anterior: ".$categoria."</h5>";       
                        ?>
                        <select name="categoriaP">
                            <?php
                                $sql1 = "SELECT * FROM categoria";
                                $rec=$conn->query($sql1);
                                while($rowC=mysqli_fetch_array($rec)){
                                    echo "<option value='".$rowC['cat_codigo']."'>";
                                    echo $rowC['cat_nombre'];
                                    echo "</option>";
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                        <label>Cantidad</label>
                        <input type="text" name="cantidadP" id="cantidadP" class="campoED" value="<?php echo $row["pro_cantidad"]?>">
                        <input type="submit" name="btnP" id="btnP" value="AÑADIR PRODUCTO">
                    </form>
            <?php
                }
            } else {
                echo "<p>Ha ocurrido un error inesperado !</p>";
                echo "<p>" . mysqli_error($conn) . "</p>";
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

