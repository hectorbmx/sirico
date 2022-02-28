<?php include ("../config/bd.php"); ?>
<?php  
 
 #$connect = mysqli_connect("localhost", "root", "admin", "riveraco1");  
 if(isset($_POST["query"]))  
 {  
     
    $output = '';  
    $sql=$conexion->prepare("SELECT * FROM clientes WHERE Razon_social LIKE '%".$_POST["query"]."%'" ); 
    $sql->execute();
    $result =$sql->fetchall(PDO::FETCH_ASSOC); 
    $output = '<ul class="list-unstyled">';  
    if(($result) > 0)
    #if(mysqli_num_rows($result) > 0)  
    {  
         #while($row = mysqli_fetch_array($result))  
         foreach 
          ($result as $row)
          
                  {  
                          $output .= '<li>'.$row["Razon_social"].'</li>';
                          $output .= '<li type="hidden" >'.$row["id_cliente"].'</li>';  
                  }  
    }  
    else  
    {  
         $output .= '<li>Cliente no encontrado</li>';  
    }  
    $output .= '</ul>';  
    echo $output;  
}  
 
 ?>  
 <?php

if(isset($_POST["query2"]))  
 {  
     
    $output = '';  
    $sql=$conexion->prepare("SELECT * FROM proveedores WHERE nombre LIKE '%".$_POST["query2"]."%'" ); 
    $sql->execute();
    $result =$sql->fetchall(PDO::FETCH_ASSOC); 
    $output = '<ul class="list-unstyled">';  
    if(($result) > 0)
    #if(mysqli_num_rows($result) > 0)  
    {  
         #while($row = mysqli_fetch_array($result))  
         foreach 
          ($result as $row)
          
                  {  
                          $output .= '<li>'.$row["nombre"].'</li>';
                          $output .= '<li type="hidden" >'.$row["id_proveedor"].'</li>';  
                  }  
    }  
    else  
    {  
         $output .= '<li>Cliente no encontrado</li>';  
    }  
    $output .= '</ul>';  
    echo $output;  
}  
 
 ?>  

<?php  
 
 #$connect = mysqli_connect("localhost", "root", "admin", "riveraco1");  
 if(isset($_POST["queryy"]))  
 {  
     
    $output = '';  
    $sql=$conexion->prepare("SELECT * FROM tipos_pilas WHERE nombre_pila LIKE '%".$_POST["queryy"]."%'" ); 
    $sql->execute();
    $result =$sql->fetchall(PDO::FETCH_ASSOC); 
    $output = '<ul class="list-unstyled">';  
    if(($result) > 0)
    #if(mysqli_num_rows($result) > 0)  
    {  
         #while($row = mysqli_fetch_array($result))  
         foreach 
          ($result as $row)
          
                  {  
                          
                          $output .= '<li>'.$row["nombre_pila"].'</li>';
                          $output .= '<li>'.$row["id"].'</li>';  
                  }  
    }  
    else  
    {  
         $output .= '<li>Cliente no encontrado</li>';  
    }  
    $output .= '</ul>';  
    echo $output;  
}  
 
 ?>  
 <?php  
 
 #busqueda de empleados
 if(isset($_POST["query_empleados"]))  
 {  
     
    $output = '';  
    $sql=$conexion->prepare("SELECT * FROM empleados_web WHERE nombre LIKE '%".$_POST["query_empleados"]."%'" ); 
    $sql->execute();
    $result =$sql->fetchall(PDO::FETCH_ASSOC); 
    $output = '<ul class="list-unstyled" id="empleados">';  
    if(($result) > 0)
    #if(mysqli_num_rows($result) > 0)  
    {  
         #while($row = mysqli_fetch_array($result))  
         foreach 
          ($result as $row)
          
                  {  
                          
                          $output .= '<li>'.$row["Nombre"].'</li>';
                          $output .= '<li>'.$row["id_Empleado"].'</li>';
                          
                  }  
    }  
    else  
    {  
         $output .= '<li>Cliente no encontrado</li>';  
    }  
    $output .= '</ul>';  
    echo $output;  
}  
 

if(isset($_POST["birds"]))  
 {  
     
    $output = '';  
    $sql=$conexion->prepare("SELECT * FROM proveedores WHERE nombre LIKE '%".$_POST["birds"]."%'" ); 
    $sql->execute();
    $result =$sql->fetchall(PDO::FETCH_ASSOC); 
    $output = '<ul class="list-unstyled" id="empleados">';  
    if(($result) > 0)
    #if(mysqli_num_rows($result) > 0)  
    {  
         #while($row = mysqli_fetch_array($result))  
         foreach 
          ($result as $row)
          
                  {  
                          
                          $output .= '<li>'.$row["nombre"].'</li>';
                          
                          
                  }  
    }  
    else  
    {  
         $output .= '<li>Cliente no encontrado</li>';  
    }  
    $output .= '</ul>';  
    echo $output;  
}  
 ?> 
 