<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT id_entrada,entradas_almacen.id_producto,productos.nombre,cantidad,costo,factura,entradas_almacen.fecha from entradas_almacen
                                inner join productos on productos.id_producto = entradas_almacen.id_producto");           
            
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
</script>
<?php 
$item=(isset($_POST['item']))?$_POST['item']:"";
$cantidad =(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$factura =(isset($_POST['factura']))?$_POST['factura']:"";
$costo =(isset($_POST['costo']))?$_POST['costo']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$hoy =date("Y-m-d");

?>

<?php

switch($accion){
    
    case "agregar":
        //Primero validar producto => Si no hay producto avis de error
        //Abrir transaccion
        //Validar inventario
        //=> Si no existe hacer insert con la cantidad que te capturaron
        //=> Si existe hacer el update con la suma
        //=> Al ulimo la entrada
        //Cerrar transaccion
                  
                     
                    $sql=$conexion->prepare ("INSERT INTO entradas_almacen (id_producto,cantidad,costo,factura,fecha)
                                                    VALUES (:id_producto,:cantidad,:costo,:factura,:fecha)");
                    $sql->bindParam(':id_producto',$item);
                    $sql->bindParam(':cantidad',$cantidad);
                    $sql->bindParam(':costo',$factura);
                    $sql->bindParam(':factura',$costo);
                    $sql->bindParam(':fecha',$hoy);
                    $sql->execute(); 
                    if (!empty($sql)){
                        $sql=$conexion->prepare("select * from inventario where id_producto=:id_producto");
                    }
                    
                    if (!empty($sql)){
                       $sql=$conexion->prepare ("UPDATE inventario_almacen set existencia = existencia + $cantidad where id_producto =:id_producto");
                       $sql->bindParam(':id_producto',$item);
                       $sql->execute(); 
                        if (!empty($sql)){ 
                        $mensaje=  "Registro agregado con exito!. <a href='entradas_giralda.php'>Regresar</a>";
                                         }
                                         $sql=$conexion->prepare ("SELECT * from productos where id_producto =:id_producto");
                                         $sql->bindParam(':id_producto',$item);            
                                         $sql->execute();
                                         if (empty($sql)){
                                             $mensaje=  "El producto no existe!. <a href='entradas_giralda.php'>Regresar</a>";
                                         }
                                    }          
                    break;
}                                   
?>
<div class="container" width='100%'><br><br><br>
<h1>Lista de entradas al almacen</h1><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar entrada:</button>
<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura datos de entrada:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="item" id="item" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Número de item:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Cantidad:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="factura" id="factura" class="form-control" placeholder=""required /> 
          <label for="floatingInput"># Factura:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="costo" id="costo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Costo de factura:</label>      
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
                <th>#entrada</th>
                <th># item</th>
                <th>nombre item</th>
                <th>costo</th>
                <th>cantidad</th>
                <th>factura</th>
                <th>fecha entrada</th>
                
                
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_entrada'];?></td>   
                <td><?PHP echo $result ['id_producto'];?></td>
                <td><?PHP echo $result ['nombre'];?></td>
                <td><?PHP echo $result ['costo'];?></td>
                <td><?PHP echo $result ['cantidad'];?></td>
                <td><?PHP echo $result ['factura'];?></td>
                <td><?PHP echo $result ['fecha'];?></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>