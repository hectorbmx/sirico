<?php include ("../template/cabecera.php");?>
<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?><br>

<?php

$presupuesto =(isset($_POST['txtpresupuesto']))?$_POST['txtpresupuesto']:"";
$sql= $conexion->prepare("SELECT * FROM riveraco1.presupuestos_ WHERE riveraco1.presupuestos_.id_presupuesto =$presupuesto");           
            $sql->execute();
            $presupuestos=$sql->fetchall(PDO::FETCH_ASSOC);
?>

<?php 
$consult = "SELECT    riveraco1.presupuestos_detalles.id_presupuesto_detalle,#SI QUITAS ESTE NO FUNCIONA EL BOTON BORRAR
                      riveraco1.tipos_pilas.nombre_pila as pila,
                      riveraco1.tipos_pilas.descripcion_pila as descripcion,
                      riveraco1.unidades_medida.nombre as nombre,
                      riveraco1.unidades_medida.Descripcion as detalles,
                      riveraco1.presupuestos_detalles.id_pila,
                      riveraco1.presupuestos_detalles.unidad,
                      riveraco1.presupuestos_detalles.Cantidad,
                      riveraco1.presupuestos_detalles.precio_unitario,
                      riveraco1.presupuestos_detalles.importe_siva
                      FROM riveraco1.presupuestos_detalles 
                      INNER JOIN  riveraco1.unidades_medida on riveraco1.unidades_medida.id_medida = riveraco1.presupuestos_detalles.unidad
                      INNER JOIN riveraco1.tipos_pilas on riveraco1.tipos_pilas.id = riveraco1.presupuestos_detalles.id_pila
                      WHERE riveraco1.presupuestos_detalles.id_presupuesto =$presupuesto";

$sql =$conexion->prepare($consult);
            $sql->execute();
            $rest=$sql->fetchall(PDO::FETCH_ASSOC);
            # echo var_dump ($rest);    revisa los datos de la consulta antes de imprimir , muestra tipo de dato asignado ala consulta
?>
<?php 
$sql =$conexion->prepare("SELECT sum(importe_siva) as total from riveraco1.presupuestos_detalles where riveraco1.presupuestos_detalles.id_presupuesto=$presupuesto");
$sql->execute();
$suma=$sql->fetchall(PDO::FETCH_ASSOC);


?>
<?php 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$idpresupuesto =(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtconcepto=(isset($_POST['country']))?$_POST['country']:"";
$unidad=(isset($_POST['unidad']))?$_POST['unidad']:"";
$txtcantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$txtprecio=(isset($_POST['precio']))?$_POST['precio']:"";
$txtimporte=(isset($_POST['importe']))?$_POST['importe']:"";
$id=(isset($_POST['id']))?$_POST['id']:"";

?>


<?php 


?>
<?php



 switch($accion){   
        case "Agregar":  $sql= $conexion->prepare("INSERT INTO riveraco1.presupuestos_detalles (id_presupuesto,id_pila,unidad,Cantidad,precio_unitario) 
                                                VALUES (:id_presupuesto,:id_pila,:unidad,:Cantidad,:precio_unitario)");
                                                    $sql->bindParam(':id_presupuesto',$idpresupuesto); #id del presupuesto a ingresar, automaticamente de la consulta de la buscqueda
                                                    $sql->bindParam(':id_pila',$txtconcepto); #tipo de pila se debe registrar un int
                                                    $sql->bindParam(':unidad',$unidad); 
                                                    $sql->bindParam(':Cantidad',$txtcantidad);
                                                    $sql->bindParam(':precio_unitario',$txtprecio);
                                                    //$sql->bindParam(':importe_siva',$txtimporte); 
                                                    $sql->execute();

        break;

        case "borrar": $sql =$conexion->prepare("DELETE FROM riveraco1.presupuestos_detalles where id_presupuesto_detalle = :id");
                       $sql->bindParam(':id',$id);
                       $sql->execute();
        break;
                                
 
}    
?>  

<script>
    
        $(document).ready(function(){  
      $('#country').keyup(function(){  
           var queryy = $(this).val();  
           if(queryy != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{queryy:queryy},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#country').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 });  

    
</script>

<div class="container">
<div class="jumbotron">
    <h1 class="display-4">Agrega conceptos a un presupuesto</h1>
    <p class="lead">ingresa el # de presupuesto</p>
    <hr class="my-4">
    <div class="col-md-2">
    
        <label for="autocomplete" class="form-label" required> Ingresa presupuesto</label><br>
        <form method="POST">
            
            <input type="text" class="form-control" value ="" name ="txtpresupuesto" id="" required>
            <button type="submit"name ="accion" class="btn btn-success" value="buscar"> buscar</button>
         <table class="table">
         <thead class="thead-light">
            <tr>
                <?php foreach ($presupuestos as $resultado ){?>
                <td># de presupuesto</td>
                <td>Cliente</td>
                <td>Area</td>
                <td>Obra</td>
                <td>Atencion</td>
                <td>fecha de captura</td>
            </tr>
        </thead>
        
        <tbody>
            <td><?php echo $resultado['id_presupuesto'];?></td>
            <td><?php echo $resultado['id_cliente'];?></td>
            <td><?php echo $resultado['nombre_obra'];?></td>
            <td><?php echo $resultado['lugar_obra'];?></td>
            <td><?php echo $resultado['atencion'];?></td>
            <td><?php echo $resultado['fecha_captura'];?></td>
        </tbody>
        
    </table>   
    </form>
    </div><!-- cierra div del ingreso de presupuesto-->
   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Presupuesto</th>
                <th scope="col">Concepto</th>
                <th scope="col">Unidad</th>
                <th scope="col">Cant.</th>
                <th scope="col">Precio U.</th>
                <!--<th scope="col">Importe</th>-->
            </tr>
        </thead>
        <tbody>
  
    <tr>
    <form  method="post">
      <td><input type="hidden" type="hidden"  name="txtId"  class="form-control"id="txtId" value="<?PHP echo $resultado ['id_presupuesto'] ?>" />
          <input type="text" type="hidden" disabled name="txtId"  class="form-control"id="txtId" value="<?PHP echo $resultado ['id_presupuesto'] ?>" /></td>
      <td><input type="text" name="country" id="country" class="form-control" required>
      <div id="countryList"></div></td>
      <td><div class="col-md-12">
            <select class="form-select" id="" value=""  name="unidad" required> 
            <option selected disabled value="" id="unidad" name="unidad" required> ...</option>
            <option value ="1">ML</option>
            <option value ="2">M3</option>
            <option value ="3">KG</option>
            <option value ="4">PZA</option>
            </select>
            </div>
      </td>
      <td><input type="text" class="form-control" value ="" name ="cantidad" id="cantidad"  required></td>
      <td><input type="text"class="form-control" name ="precio" required></td>
     <!-- <td><input type="text"class="form-control" name ="importe" required></td>-->
      <td></td>
      <td>
      
            
                  
                  <input type="submit" name="accion" value="Agregar" class="btn btn-success">
                 
            </form>
            <?php }?>
        </td>
    </tr>
  </tbody>
 
    </table>

     
<table class="table table-light">
    
    <thead>
        <tr>
            <th>Concepto</th>
            <th>Detalles</th>
            <th>unidad medida</th>
            <th>cantidad</th>
            <th>precio u.</th>
            <th>importe</th>
            <th>acciones</th>
        </tr>
    </thead>
    
    <tbody>
    <?php foreach ($rest as $consulta) { ?> 
        <tr>
        <td><?php echo $consulta['pila']; ?></td>
        <td><?php echo $consulta['descripcion']; ?></td>
        <td><?php echo $consulta['nombre']; ?>(<?php echo $consulta['detalles']; ?>)</td>
        <td><?php echo $consulta['Cantidad']; ?></td>
        <td>$<?php echo $consulta['precio_unitario']; ?></td>
        <td>$<?php   echo $consulta['Cantidad']*$consulta['precio_unitario']; ?></td>
        <td> 
            <form method="post">
            <input type="hidden" name="id" id="id" value="<?PHP echo $consulta ['id_presupuesto_detalle'] ?>" />    
            <input type="submit" name="accion" value="borrar" class="btn btn-danger">
            </form>
        </td>
                
        
        </tr>
    </tbody>
    
    
  
    <?php } ?>
</table>
<?php foreach ($suma as $total){ ?> 
<label for="" >Subtotal</label>
<input  type="text" name="total" id="" disabled value ="$<?php echo $total['total'] ?> ">
<label for="" >I.V.A</label>
<input  type="text" name="total" id="" disabled value ="$<?php echo $total['total']*.16 ?> ">
<label for="" >Total</label>
<input  type="text" name="total" id="" disabled value ="$<?php echo $total['total']*1.16 ?> ">
<button type="submit" class="btn btn-warning"  value ="imprimir" >imprimir</button>
<button type="submit" class="btn btn-primary"  value ="imprimir" >generar Obra</button>
<?php } ?>
   

    


</div><!-- cierra Jumbotron--> 
    
</div><!-- cierra container principal--> 

<?php  include ("../template/footer.php"); ?>