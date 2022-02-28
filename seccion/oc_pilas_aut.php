<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * from ordenes_compra ");           
            
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"  />
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
$area = 2;
$concepto=(isset($_POST['Concepto']))?$_POST['Concepto']:"";
$proveedor =(isset($_POST['Proveedor']))?$_POST['Proveedor']:"";
$usuario= $_SESSION['nombreUsuario'];
$costo =(isset($_POST['Costo']))?$_POST['Costo']:"";
$status = (isset($_POST['status']))?$_POST['status']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$id=(isset($_POST['txtId']))?$_POST['txtId']:"";
$hoy =date("Y-m-d");

?>

<?php

switch($accion){
    
    case "agregar":

                    $sql=$conexion->prepare ("INSERT INTO ordenes_compra (id_area,Proveedor,Concepto,Costo,id_usuario,fecha)
                                                    VALUES (:id_area,:Proveedor,:Concepto,:Costo,:id_usuario,:fecha)");
                    $sql->bindParam(':id_area',$area);
                    $sql->bindParam(':Proveedor',$proveedor);
                    $sql->bindParam(':Concepto',$concepto);
                    $sql->bindParam(':Costo',$costo);
                    $sql->bindParam(':id_usuario',$usuario);
                    $sql->bindParam(':fecha',$hoy);
                    $sql->execute(); 
                     if (!empty($sql)) { 
                         $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                     break;

    case "status1":
        
                    $sql=$conexion->prepare ("UPDATE ordenes_compra SET status = 1 WHERE id_orden =:id_orden ");
                    $sql->bindParam(':id_orden',$id);
                    $sql->execute();
                    
                    break;
    case "status2":
        
                    $sql=$conexion->prepare ("UPDATE ordenes_compra SET status = 2 WHERE id_orden =:id_orden ");
                    $sql->bindParam(':id_orden',$id);
                    $sql->execute();                    
                    break;
    case "status3":
        
                    $sql=$conexion->prepare ("UPDATE ordenes_compra SET status = 0 WHERE id_orden =:id_orden ");
                    $sql->bindParam(':id_orden',$id);
                    $sql->execute();                    
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
          <input type="text" name="Proveedor" id="Proveedor" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Proveedor</label>      
          </div>

          <div class="form-floating mb-3">
          <input type="text" name="Concepto" id="Concepto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Concepto</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="Costo" id="Costo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Costo</label>      
          </div>
         
           
             
      </div>
      <div class="modal-footer">
     
        <button type="button"value ="" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
                <th># Orden</th>
                <th># area</th>
                <th>Concepto</th>
                <th>Proveedor</th>
                <th>Usuario </th>
                <th>Costo </th>
                <th>fecha</th>
                <th>Autorición</th>
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td>OC<?PHP echo $result ['id_orden'];?></td> 
                <td><?PHP echo $result ['id_area'];?></td>   
                <td><?PHP echo $result ['Concepto'];?></td>
                <td><?PHP echo $result ['Proveedor'];?></td>
                <td><?PHP echo $result ['id_usuario'];?></td>
                <td><?PHP echo $result ['Costo'];?></td>
                <td><?PHP echo $result ['fecha'];?></td>
                <form method="post" action="">
                <td><label>
                <input type="hidden" name="txtId" id="txtId" value="<?PHP echo $result ['id_orden'] ?>" />
                <button type="submit" name ="accion" value ="status1" class="btn btn-success"><i class="fa fa-toggle-on" aria-hidden="true"></i></button>
                <button type="submit" name ="accion" value ="status2" class="btn btn-danger"><i class="fas fa-times"></i></button>
                <button type="submit" name ="accion" value ="status3" class="btn btn-warning"><i class="fas fa-edit"></i></button>
            </td>     
                
                
                </form>
               
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>