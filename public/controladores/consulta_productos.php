<?php  
    session_start();            
    include '../../config/conexionBD.php'; 

    //$codigo = $_SESSION['codigo'];
    
    $producto=$_GET['producto'];

    $sql = "SELECT * FROM productos WHERE prod_eliminado = 'N' AND prod_nombre LIKE '%$producto%' ORDER BY prod_nombre DESC"; 

    $result = $conn->query($sql); 

        if ($result->num_rows > 0) { 
                
            while($row = $result->fetch_assoc()) { 

                echo "<article class='contenidoProductos'>";

                    ?>                  
                    <img id= "imgProd" src="<?php echo $row['prod_imagen']?>" alt=imgProd>
                    <?php
                    echo "<br>";        
                    echo $row['prod_nombre']; 
                    echo "<br>";     
                    echo "$".$row['prod_precio']." INCLUYE IVA"; 
                    echo "<br>";
                    echo "<a href=''><img class = 'imgCarrito' src='../../../imagenes/iconos/carrito.png' alt='imgCarro'> </a>";

                echo "</article>";                                             
                

            } 

        } else {                 
            echo "<tr>";                 
            echo "<td colspan='7'> No existen productos </td>";                 
            echo "</tr>"; 

        }
            
        $conn->close();          
?> 

