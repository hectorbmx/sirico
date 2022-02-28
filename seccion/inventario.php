<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT equipo,marca,tipo,modelo,serie,areas.Nombre_area,fecha_compra,empleados_web.Nombre,costo,inventario_comp.foto,activo
FROM inventario_comp
INNER JOIN empleados_web ON empleados_web.id_Empleado = inventario_comp.usuario
INNER JOIN areas WHERE areas.id_area = inventario_comp.id_area");        
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

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$equipo=(isset($_POST['equipo']))?$_POST['equipo']:"";
$marca=(isset($_POST['marca']))?$_POST['marca']:"";
$modelo=(isset($_POST['modelo']))?$_POST['modelo']:"";
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";
$serie=(isset($_POST['serie']))?$_POST['serie']:"";
$id_area=(isset($_POST['id_area']))?$_POST['id_area']:"";
$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
$costo=(isset($_POST['costo']))?$_POST['costo']:"";
$activo=(isset($_POST['activo']))?$_POST['activo']:"";
$fecha_compra=(isset($_POST['fecha_compra']))?$_POST['fecha_compra']:"";
$foto=(isset($_FILES['foto']))?$_FILES['foto']:"";

?>
<?php switch ($accion) {
    case 'agregar':
        $sql= $conexion->prepare("INSERT INTO inventario_comp (equipo,marca,modelo,tipo,serie,id_area,usuario,costo,activo,fecha_compra,foto) VALUES (:equipo,:marca,:modelo,:tipo,:serie,:id_area,:usuario,:costo,:activo,:fecha_compra,:foto)");
        $sql->bindParam(':equipo',$equipo);
        $sql->bindParam(':marca',$marca);
        $sql->bindParam(':modelo',$modelo);
        $sql->bindParam(':tipo',$tipo);
        $sql->bindParam(':serie',$serie);
        $sql->bindParam(':id_area',$id_area);
        $sql->bindParam(':usuario',$usuario);
        $sql->bindParam(':costo',$costo);
        $sql->bindParam(':activo',$activo);
        $sql->bindParam(':fecha_compra',$fecha_compra);
        $fecha= new DateTime();
        $mensaje="";
        #$sql->bindParam(':foto',$foto);
        $nombreArchivo=($foto!="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"imagen.jgp";
        $tmpImagen=$_FILES["foto"]["tmp_name"];
        if ($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }
        $sql->bindParam(':foto',$nombreArchivo);
        
        $sql->execute();
        if ($sql =! 0 ){
            $mensaje.="Su Registro se agrego correctamente";
        }
        else {
            $mensaje.="Hubo un error al registrar";
        }
        
        break;
    
    default:
        # code...
        break;
}

?>

<div class="container" width='100%'>
    <br><br><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar nuevo registro</button>
<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura los datos del equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="equipo" id="equipo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Equipo</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="marca" id="marca" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Marca</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="modelo" id="modelo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">modelo</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="serie" id="serie" class="form-control" placeholder=""required /> 
          <label for="floatingInput"># Serie:</label>      
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text"  name ="tipo" id="tipo">Tipo</label>
            </div>
            <select class="custom-select"  name ="tipo" id="tipo">
                <option selected name ="tipo" id="tipo">Selecciona...</option>
                <option value="1">Escritorio</option>
                <option value="2">Lap top</option>
                <option value="3">Impresion</option>
                <option value="4">Accesorio</option>
                <option value="5">Pantalla</option>
                <option value="6">CPU</option>
            </select>
            </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text"  name ="id_area" id="id_area">Area</label>
            </div>
            <select class="custom-select"  name ="id_area" id="id_area">
                <option selected name ="id_area" id="id_area">Selecciona...</option>
                <option value="1">Administracion</option>
                <option value="2">Pilas</option>
                <option value="3">Pozos</option>
                <option value="4">Sistemas</option>
                <option value="5">Pu</option>
                <option value="6">Giralda</option>
                <option value="7">Huentitan</option>
                <option value="8">sin asignar</option>
                <option value="9">Oficina 2</option>
            </select>
            </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text"  name ="usuario" id="usuario">Usuario:</label>
            </div>
            <select class="custom-select"  name ="usuario" id="usuario">
                <option selected name ="usuario" id="usuario">Selecciona...</option>
                <option value="1">Dr. Gabriel</option>
                <option value="2">Ing. Gabriel</option>
                <option value="3">Lic. Gerardo</option>
                <option value="4">Sra. Anita</option>
                <option value="40">Sin asignar</option>
             
            </select>
            </div>
          <div class="form-floating mb-3">
          <input type="text" name="costo" id="costo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Costo</label>      
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text"  name ="activo" id="activo">Estatus</label>
            </div>
            <select class="custom-select"  name ="activo" id="activo">
                <option selected name ="activo" id="activo">Selecciona...</option>
                <option value="1">Activo</option>
                <option value="2">stand by</option>
                <option value="3">Nuevo</option>
                <option value="0">baja</option>
               
            </select>
            </div>
          <div class="form-floating mb-3">
          <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" required placeholder="" /> 
          <label for="floatingInput">fecha compra</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="file" name="foto" id="foto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Foto:</label>      
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
        <thead>
            <tr>
                <th>equipo</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th># serie</th>
                <th>Area</th>
                <th>Fecha de compra</th>
                <th>Usuario</th>
                <th>Costo</th>
                <th>Foto</th>
                <th>Estatus</th>
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['equipo'];?></td>
                <td><?PHP echo $result ['marca'];?></td>
                <td><?PHP echo $result ['tipo'];?></td>
                <td><?PHP echo $result ['modelo'];?></td>
                <td><?PHP echo $result ['serie'];?></td>
                <td><?PHP echo $result ['Nombre_area'];?></td>
                <td><?PHP echo $result ['fecha_compra'];?></td>
                <td><?PHP echo $result ['Nombre'];?></td>
                <td><?PHP echo $result ['costo'];?></td>
                <td><img src="../../img/<?PHP echo $result ['foto'];?>" alt=""></td>
                <td><?PHP if($result ['activo']==1)echo '<button type="button" class="btn btn-success">Activo</button>';else if($result ['activo']==0)echo'<button type="button" class="btn btn-danger">baja</button>';else if($result ['activo']==3)echo'<button type="button" class="btn btn-primary">Nuevo</button>'; else echo '<button type="button" class="btn btn-warning">stand by</button>';?></td>
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>
    
    <?php 
    
    if (isset($mensaje)){?>
        <div class="alert alert-success" role="alert">
          <?php echo $mensaje; ?>
        </div>
        <?php  } ?>
        <?php if (isset($message)){?>
        <div class="alert alert-danger" role="alert">
          <?php echo $message; ?>
        </div>
        <?php  } ?>

    
</div>
 



<?php include ("../template/footer.php");?>