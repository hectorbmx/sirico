<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * from gastosgiralda");           
            
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">  


 
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf'
        ]
    } );
} );
</script>
<?php 
$id_factura=(isset($_POST['id_factura']))?$_POST['id_factura']:"";
$proveedor =(isset($_POST['proveedor']))?$_POST['proveedor']:"";
$concepto =(isset($_POST['concepto']))?$_POST['concepto']:"";
$cantidad =(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$costosiva =(isset($_POST['costosiva']))?$_POST['costosiva']:"";
$total =(isset($_POST['total']))?$_POST['total']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$hoy =date("Y-m-d");

?>

<?php

switch($accion){
    
    case "agregar":
     


                    $sql=$conexion->prepare ("INSERT INTO gastosgiralda (id_factura,proveedor,concepto,cantidad,costosiva,total,fecha_registro)
                                                    VALUES (:id_factura,:proveedor,:concepto,:cantidad,:costosiva,:total,:fecha_registro)");
                    $sql->bindParam(':id_factura',$id_factura);
                    $sql->bindParam(':proveedor',$proveedor);
                    $sql->bindParam(':concepto',$concepto);
                    $sql->bindParam(':cantidad',$cantidad);
                    $sql->bindParam(':costosiva',$costosiva);
                    $sql->bindParam(':total',$total);
                    $sql->bindParam(':fecha_registro',$hoy);
                    $sql->execute(); 
                    if (!empty($sql)) { 
                        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                    break;
}                                   
?>
<div class="container" width='100%'><br><br><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar gasto</button>
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
                <input type="text" name="id_factura" id="id_factura" class="form-control" placeholder=""required /> 
                <label for="floatingInput"># numero de factura:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder=""required /> 
                <label for="floatingInput">proveedor:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="concepto" id="concepto" class="form-control" placeholder=""required /> 
                <label for="floatingInput">concepto:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder=""required /> 
                <label for="floatingInput">cantidad:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="costosiva" id="costosiva" class="form-control" placeholder=""required /> 
                <label for="floatingInput">precio antes de iva:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="total" id="total" class="form-control" placeholder=""required /> 
                <label for="floatingInput">total:</label>      
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
                <th># factura</th>
                <th>Proveedor</th>
                <th>Concepto</th>
                <th>cantidad</th>
                <th>costo</th>
                <th>total</th>
                <th>fecha</th>
                
                
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_factura'];?></td>   
                <td><?PHP echo $result ['proveedor'];?></td>
                
                <td><?PHP echo $result ['concepto'];?></td>
                <td><?PHP echo $result ['cantidad'];?></td>
                <td>$<?PHP  echo $result ['costosiva'];?></td>
                <td>$<?PHP  echo $result ['total'];?></td>
                <td><?PHP  echo $result ['fecha_registro'];?></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>