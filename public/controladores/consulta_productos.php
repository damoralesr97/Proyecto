<?php  
    session_start();            
    include '../../config/conexionBD.php'; 

    //$codigo = $_SESSION['codigo'];
    
    $producto=$_GET['producto'];
    $loc_codigo=$_SESSION["local"];

    if($producto==""){

        $sql = "SELECT * FROM producto WHERE pro_loc_codigo=".$_SESSION["local"];
        $result = $conn->query($sql);
        $i=0;
        if ($result->num_rows > 0) { 
                
            while($row = $result->fetch_assoc()) { 

                if($row["pro_eliminado"]!='S'){

                    echo "<article class='contenidoProductos'>";

                        $sqli ="SELECT pro_imagen FROM producto WHERE pro_codigo=$row[pro_codigo]";
                        $stm = $conn->query($sqli);
                        while ($datos = $stm->fetch_object()){
                            
                            echo "<td>  <img id='imgProd' src='data:image/jpg; base64,".base64_encode($datos->pro_imagen)."'>  </td>";
                        }
                        $i=$i+1;
                        echo "<br>";        
                        echo $row['pro_nombre']; 
                        echo "<br>";     
                        echo "$".$row['pro_precio']." INCLUYE IVA"; 
                        echo "<br>";
                        echo "<a href=''><img class = 'imgCarrito' src='../../imagenes/iconos/carrito.png' alt='imgCarro'> </a>";

                    echo "</article>";                                             
                
                }      
            } 

        } else {                 
            echo "<tr>";                 
            echo "<td colspan='7'> No existen productos </td>";                 
            echo "</tr>"; 

        }

    }else{


        $sql = "SELECT * FROM producto WHERE pro_loc_codigo='$loc_codigo' AND pro_eliminado = 'N' AND pro_nombre LIKE '%$producto%' ORDER BY pro_nombre DESC"; 

        $result = $conn->query($sql);
        $i=0;
        if ($result->num_rows > 0) { 
                
            while($row = $result->fetch_assoc()) { 

                if($row["pro_eliminado"]!='S'){

                echo "<article class='contenidoProductos'>";

                    $sqli ="SELECT pro_imagen FROM producto WHERE pro_codigo=$row[pro_codigo]";
                    $stm = $conn->query($sqli);
                    while ($datos = $stm->fetch_object()){
                        
                        echo "<td>  <img id='imgProd' src='data:image/jpg; base64,".base64_encode($datos->pro_imagen)."'>  </td>";
                    }
                    $i=$i+1;
                    echo "<br>";        
                    echo $row['pro_nombre']; 
                    echo "<br>";     
                    echo "$".$row['pro_precio']." INCLUYE IVA"; 
                    echo "<br>";
                    echo "<a href=''><img class = 'imgCarrito' src='../../imagenes/iconos/carrito.png' alt='imgCarro'> </a>";

                echo "</article>";                                             
                
                }      
            } 

        } else {                 
            echo "<tr>";                 
            echo "<td colspan='7'> No existen productos </td>";                 
            echo "</tr>"; 

        }
    }

    $conn->close();  

?> 

