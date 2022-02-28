<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * from tareas");           
            
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
$concepto=(isset($_POST['Concepto']))?$_POST['Concepto']:"";
$detalles =(isset($_POST['Detalles']))?$_POST['Detalles']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$hoy =date("Y-m-d");

?>

<?php

switch($accion){
    
    case "agregar":

                    $sql=$conexion->prepare ("INSERT INTO tareas (concepto,detalles,fecha_inicio)
                                                    VALUES (:concepto,:detalles,:fecha_inicio)");
                    $sql->bindParam(':concepto',$concepto);
                    $sql->bindParam(':detalles',$detalles);
                    $sql->bindParam(':fecha_inicio',$hoy);
                    $sql->execute(); 
                    if (!empty($sql)) { 
                        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                    break;
}                                   
?>
<div class="container" width='100%'><br><br><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar nuevo registro</button>
<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura los datos de la tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="Concepto" id="Concepto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Concepto</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="Detalles" id="Detalles" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Detalles</label>      
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
                <th># registro</th>
                <th>Concepto</th>
                <th>Detalles</th>
                <th>fecha inicio</th>
                <th>fecha fin</th>
                <th>Estatus</th>
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id'];?></td>   
                <td><?PHP echo $result ['concepto'];?></td>
                <td><?PHP echo $result ['detalles'];?></td>
                <td><?PHP echo $result ['fecha_inicio'];?></td>
                <td><?PHP echo $result ['fecha_fin'];?></td>
                
                <td><?PHP if($result ['status']==1)echo '<button type="button" class="btn btn-success">Activo</button>';else if($result ['status']==0)echo'<button type="button" class="btn btn-warning">en proceso</button>';else if($result ['status']==2)echo'<button type="button" class="btn btn-danger">terminado</button>'; else echo '<button type="button" class="btn btn-warning">stand by</button>';?></td>
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>