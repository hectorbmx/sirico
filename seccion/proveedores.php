<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * from proveedores");           
            
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
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$descripcion =(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$RFC =(isset($_POST['rfc']))?$_POST['rfc']:"";
$domicilio =(isset($_POST['domicilio']))?$_POST['domicilio']:"";
$telefono =(isset($_POST['telefono']))?$_POST['telefono']:"";
$email =(isset($_POST['email']))?$_POST['email']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$hoy =date("Y-m-d");

?>

<?php

switch($accion){
    
    case "agregar":

                    $sql=$conexion->prepare ("INSERT INTO proveedores (nombre,descripcion,RFC,domicilio,telefono,email,fecha_registro)
                                                    VALUES (:nombre,:descripcion,:RFC,:domicilio,:telefono,:email,:fecha_registro)");
                    $sql->bindParam(':nombre',$nombre);
                    $sql->bindParam(':descripcion',$descripcion);
                    $sql->bindParam(':RFC',$RFC);
                    $sql->bindParam(':domicilio',$domicilio);
                    $sql->bindParam(':telefono',$telefono);
                    $sql->bindParam(':email',$email);
                    $sql->bindParam(':fecha_registro',$hoy);
                    $sql->execute(); 
                    if (!empty($sql)) { 
                        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                    break;
}                                   
?>
<div class="container" width='100%'><br><br><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar proveedor</button>
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
                <label for="floatingInput">Nombre:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder=""required /> 
                <label for="floatingInput">Descripcion:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="rfc" id="rfc" class="form-control" placeholder=""required /> 
                <label for="floatingInput">RFC:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="domicilio" id="domicilio" class="form-control" placeholder=""required /> 
                <label for="floatingInput">domicilio:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="telefono" id="telefono" class="form-control" placeholder=""required /> 
                <label for="floatingInput">telefono:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="email" id="email" class="form-control" placeholder=""required /> 
                <label for="floatingInput">email:</label>      
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
                <th># proveedor</th>
                <th>Nombre</th>
                <th>RFC</th>
                <th>Domicilio</th>
                <th>Telefono</th>
                <th>email</th>
                
                
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_proveedor'];?></td>   
                <td><?PHP echo $result ['nombre'];?></td>
                
                <td><?PHP echo $result ['RFC'];?></td>
                <td><?PHP echo $result ['domicilio'];?></td>
                <td><?PHP echo $result ['telefono'];?></td>
                <td><?PHP echo $result ['email'];?></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>