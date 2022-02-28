<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php include ("search.php"); ?>


<?php $sql= $conexion->prepare("SELECT productos.id_producto,nombre,descripcion,proveedor,area,inventario_almacen.existencia
                                 from productos
                                 left join inventario_almacen on inventario_almacen.id_producto = productos.id_producto");           
            
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
?>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">


  <script>
       $(document).ready(function(){  
      $('#proveedor').keyup(function(){  
           var query2 = $(this).val();  
           if(query2 != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query2:query2},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#proveedor').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 });  

$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detalles de  '+data[1]+' ' +data[2];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );
$("#ModalNuevo").find("input,textarea,select").val("");
</script>
<?php 
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$descripcion =(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$proveedor =(isset($_POST['proveedor']))?$_POST['proveedor']:"";
$area =(isset($_POST['area']))?$_POST['area']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$hoy =date("Y-m-d");

?>

<?php

switch($accion){
    
    case "agregar":

                    $sql=$conexion->prepare ("INSERT INTO productos (nombre,descripcion,proveedor,area,fecha_registro)
                                                    VALUES (:nombre,:descripcion,:proveedor,:area,:fecha_registro)");
                    $sql->bindParam(':nombre',$nombre);
                    $sql->bindParam(':descripcion',$descripcion);
                    $sql->bindParam(':proveedor',$proveedor);
                    $sql->bindParam(':area',$area);
                    $sql->bindParam(':fecha_registro',$hoy);
                    $sql->execute(); 
                    if (!empty($sql)) { $sql=$conexion->prepare ("SELECT * from inventario_almacen where id_producto=:");}          
                    
                    if (!empty($sql)) { 
                        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                    break;
}                                   
?>

<div class="container" width='100%'><br><br><br>
<h1>Lista de productos del almacen</h1><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar producto</button>

<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura del producto:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Nombre producto:</label> 
                
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Descripcion:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder=""required /> 
          <label for="floatingInput">proveedor:</label> 
          <div id="countryList"></div>     
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="area" id="area" class="form-control" placeholder=""required /> 
          <label for="floatingInput">area:</label>      
          </div>                
            </div>
            <div class="modal-footer">
            <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name ="accion" value ="agregar" class="btn btn-success">Guardar</button>
            </form>
      </div>
    </div>
  </div>
</div>

<br><br><br>
<table id="example" class="display nowrap" style="width:100%">
<?php if (isset($mensaje)){?>
        <div class="alert alert-success" role="alert">
          <?php echo $mensaje; ?>
        </div>
        <?php  } ?>
        <thead>
            <tr>
                <th>#producto</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>proveedor</th>
                <th>area</th>
                <th>existencia</th>
                
                
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_producto'];?></td>   
                <td><?PHP echo $result ['nombre'];?></td>
                <td><?PHP echo $result ['descripcion'];?></td>
                <td><?PHP echo $result ['proveedor'];?></td>
                <td><?PHP echo $result ['area'];?></td>
                <td><?PHP echo $result ['existencia'];?></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>