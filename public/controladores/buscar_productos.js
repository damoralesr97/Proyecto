function buscarProducto() {
    
    var producto = document.getElementById("buscar").value;
    if(producto == ""){
        document.getElementById("menuProd").innerHTML="No existe ese producto en Stock";

       /* if (window.XMLHttpRequest) {
            //code for actuar browsers
            xmlhttp = new XMLHttpRequest();
        } else {
            //code for old browsers
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue");
                document.getElementById("menuProd").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../../controladores/usuario/defaultRecibidos.php?remitente=",true);
        xmlhttp.send();*/

    }else{
        
        if(window.XMLHttpRequest){
            
            //code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }else{
            //code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status==200){
    
                document.getElementById("menuProd").innerHTML = this.responseText;
            }

        };

        xmlhttp.open("GET","../../controladores/consulta_productos.php?producto="+producto,true);
        xmlhttp.send();
    
    }   
}