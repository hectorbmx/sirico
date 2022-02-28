<?php include ("../template/cabecera.php");?>

<?php include ("../config/bd.php"); ?>

<?php $sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_web ");           
            
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
?>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
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
$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellidos=(isset($_POST['txtApellidos']))?$_POST['txtApellidos']:"";
$txtEmail=(isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$txtFechaNac=(isset($_POST['txtFechaNac']))?$_POST['txtFechaNac']:"";

$txtFecIni=(isset($_POST['txtFecIni']))?$_POST['txtFecIni']:"";
#$txtFecBaj=(isset($_POST['txtFecBaj']))?$_POST['txtFecBaj']:"Escribe una fecha";
$txtArea=(isset($_POST['txtArea']))?$_POST['txtArea']:"";
$txtPuesto=(isset($_POST['txtPuesto']))?$_POST['txtPuesto']:"";
$txtTel=(isset($_POST['txtTel']))?$_POST['txtTel']:"";
$txtCel=(isset($_POST['txtCel']))?$_POST['txtCel']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtCol=(isset($_POST['txtCol']))?$_POST['txtCol']:"";
$txtCiudad=(isset($_POST['txtCiudad']))?$_POST['txtCiudad']:"";
$txtCP=(isset($_POST['txtCP']))?$_POST['txtCP']:"";
$txtRFC=(isset($_POST['txtRFC']))?$_POST['txtRFC']:"";
$txtCURP=(isset($_POST['txtCURP']))?$_POST['txtCURP']:"";
$txtIMSS=(isset($_POST['txtIMSS']))?$_POST['txtIMSS']:"";
$txtSangre=(isset($_POST['txtSangre']))?$_POST['txtSangre']:"";
$txtCuenta_banco=(isset($_POST['txtCuenta_banco']))?$_POST['txtCuenta_banco']:"";
$txtSueldo=(isset($_POST['txtSueldo']))?$_POST['txtSueldo']:"";
$txtSueldoTipo=(isset($_POST['txtSueldoTipo']))?$_POST['txtSueldoTipo']:"";
$txtHorasxsemana=(isset($_POST['txtHorasxsemana']))?$_POST['txtHorasxsemana']:"";
$txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
$txtHonorarios=(isset($_POST['txtHonorarios']))?$_POST['txtHonorarios']:"";
$txtNotas=(isset($_POST['txtNotas']))?$_POST['txtNotas']:"";
$txtFoto=(isset($_FILES['txtFoto']['name']))?$_FILES['txtFoto']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "agregar":   
                $sql= $conexion->prepare("INSERT INTO riveraco1.empleados_web 
                (nombre,Apellidos,Email,Fecha_nacimiento,Fecha_ingreso,Area,Puesto,Telefono,Celular,Direccion,Colonia,Ciudad,CP,RFC,CURP,IMSS,Sangre,Cuenta_banco,Sueldo  ,Sueldo_tipo,Horasxsemana,Estatus,Honorarios,Notas,foto)
                  VALUES
            (:nombre,:Apellidos,:Email,:Fecha_nacimiento,:Fecha_ingreso,:Area,:Puesto,:Telefono,:Celular,:Direccion,:Colonia,:Ciudad,:CP,:RFC,:CURP,:IMSS,:Sangre,:Cuenta_banco,:Sueldo,:Sueldo_tipo,:Horasxsemana,:Estatus,:Honorarios,:Notas,:foto);");
          if (empty($txtFechaNac)) { 
            echo "Debe introducir un Nombre. <a href='javascript:history.back();'>Reintentar</a>";}
          $sql->bindParam(':nombre',$txtNombre);
          $sql->bindParam(':Apellidos',$txtApellidos);
          $sql->bindParam(':Email',$txtEmail);
          $sql->bindParam(':Fecha_nacimiento',$txtFechaNac);
          $sql->bindParam(':Fecha_ingreso',$txtFecIni);
          #$sql->bindParam(':Fecha_baja',$txtFecBaj);
          $sql->bindParam(':Area',$txtArea);
          $sql->bindParam(':Puesto',$txtPuesto);
          $sql->bindParam(':Telefono',$txtTel);
          $sql->bindParam(':Celular',$txtCel);
          $sql->bindParam(':Direccion',$txtDireccion);
          $sql->bindParam(':Colonia',$txtCol);
          $sql->bindParam(':Ciudad',$txtCiudad);
          $sql->bindParam(':CP',$txtCP);
          $sql->bindParam(':RFC',$txtRFC);
          $sql->bindParam(':CURP',$txtCURP);
          $sql->bindParam(':IMSS',$txtIMSS);
          $sql->bindParam(':Sangre',$txtSangre);
          $sql->bindParam(':Cuenta_banco',$txtCuenta_banco);
          $sql->bindParam(':Sueldo',$txtSueldo);
          $sql->bindParam(':Sueldo_tipo',$txtSueldoTipo);
          $sql->bindParam(':Horasxsemana',$txtHorasxsemana);
          $sql->bindParam(':Estatus',$txtEstatus);
          $sql->bindParam(':Honorarios',$txtHonorarios);
          $sql->bindParam(':Notas',$txtNotas);
          $fecha= new DateTime();
          
          $nombreArchivo=($txtFoto!="")?$fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jgp";

          $tmpImagen=$_FILES["txtFoto"]["tmp_name"];
          
          if ($tmpImagen!=""){

          move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

          }
          $sql->bindParam(':foto',$nombreArchivo);
          
          $sql->execute();
          if (!empty($sql)) { 
            $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}
          
         
        break;
        case "Seleccionar":
          $sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_web WHERE  id_Empleado=:id_Empleado");           
          $sql->bindParam(':id_Empleado',$txtId);
          $sql->execute();
          $rest=$sql->fetch(PDO::FETCH_LAZY);


          $txtId= $rest['id_Empleado'];
          $txtNombre  =$rest['Nombre'];
          $txtApellidos=$rest['Apellidos'];
          $txtEmail   =$rest['Email'];
          $txtFechaNac=$rest['Fecha_nacimiento'];
          $txtFecIni  =$rest['Fecha_ingreso'];
          $txtFecBaj  =$rest['Fecha_baja'];
          $txtArea    =$rest['Area'];
          $txtPuesto  =$rest['Puesto'];
          $txtTel     =$rest['Telefono'];
          $txtCel     =$rest['Celular'];
          $txtDireccion=$rest['Direccion'];
          $txtCol     =$rest['Colonia'];
          $txtCiudad  =$rest['Ciudad'];
          $txtCP     =$rest['CP'];
          $txtRFC     =$rest['RFC'];
          $txtCURP    =$rest['CURP'];
          $txtIMSS    =$rest['IMSS'];
          $txtSangre  =$rest['Sangre'];
          $txtCuenta_banco=$rest['Cuenta_banco'];
          $txtSueldo  =$rest['Sueldo'];
          $txtSueldoTipo=$rest['Sueldo_tipo'];
          $txtHorasxsemana=$rest['Horasxsemana'];
          $txtEstatus =$rest['Estatus'];
          $txtHonorarios=$rest['Honorarios'];
          $txtNotas   =$rest['Notas'];
          $txtFoto    =$rest['foto'];
     
          //echo "Presionado Seleccionar";
      break;
        case "Modificar":
          $sql= $conexion->prepare("UPDATE riveraco1.empleados_web 
          SET Nombre=:nombre,Apellidos=:Apellidos,Email=:Email,Fecha_nacimiento=:Fecha_nacimiento,Fecha_ingreso=:Fecha_ingreso,Fecha_baja=:Fecha_baja,Area=:Area,Puesto=:Puesto,
          Telefono=:Telefono,Celular=:Celular,Direccion=:Direccion,Colonia=:Colonia,Ciudad=:Ciudad,CP=:CP,RFC=:RFC,CURP=:CURP,IMSS=:IMSS,Sangre=:Sangre,Cuenta_banco=:Cuenta_banco,
          Sueldo=:Sueldo,Sueldo_tipo=:Sueldo_tipo,Horasxsemana=:Horasxsemana,Estatus=:Estatus,Honorarios=:Honorarios,Notas=:Notas

          WHERE id_Empleado=:id_Empleado ");
          $sql->bindParam(':nombre',$txtNombre);
          $sql->bindParam(':Apellidos',$txtApellidos);
          $sql->bindParam(':Email',$txtEmail);
          $sql->bindParam(':Fecha_nacimiento',$txtFechaNac);
          $sql->bindParam(':Fecha_ingreso',$txtFecIni);
          $sql->bindParam(':Fecha_baja',$txtFecBaj);
          $sql->bindParam(':Area',$txtArea);
          $sql->bindParam(':Puesto',$txtPuesto);
          $sql->bindParam(':Telefono',$txtTel);
          $sql->bindParam(':Celular',$txtCel);
          $sql->bindParam(':Direccion',$txtDireccion);
          $sql->bindParam(':Colonia',$txtCol);
          $sql->bindParam(':Ciudad',$txtCiudad);
          $sql->bindParam(':CP',$txtCP);
          $sql->bindParam(':RFC',$txtRFC);
          $sql->bindParam(':CURP',$txtCURP);
          $sql->bindParam(':IMSS',$txtIMSS);
          $sql->bindParam(':Sangre',$txtSangre);
          $sql->bindParam(':Cuenta_banco',$txtCuenta_banco);
          $sql->bindParam(':Sueldo',$txtSueldo);
          $sql->bindParam(':Sueldo_tipo',$txtSueldoTipo);
          $sql->bindParam(':Horasxsemana',$txtHorasxsemana);
          $sql->bindParam(':Estatus',$txtEstatus);
          $sql->bindParam(':Honorarios',$txtHonorarios);
          $sql->bindParam(':Notas',$txtNotas);
          $sql->bindParam(':id_Empleado',$txtId);
          $sql->execute();

          
          
          if ($txtFoto!=""){
              $fecha= new DateTime();
              $nombreArchivo=($txtFoto!="")?$fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jgp";               
              $tmpImagen=$_FILES["txtFoto"]["tmp_name"];
              move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
              $sql= $conexion->prepare("SELECT foto FROM riveraco1.empleados_web WHERE id_Empleado =:id_Empleado");           
              $sql->bindParam(':id_Empleado',$txtId);
              $sql->execute();
              $rest=$sql->fetch(PDO::FETCH_LAZY);
  
              if( isset($rest["foto"]) &&($rest["foto"]!="imagen.jpg") ){
  
                  if(file_exists("../../img/".$rest["foto"])){
  
                      unlink("../../img/".$rest["foto"]);
  
  
                  }
  
              }
          
              $sql= $conexion->prepare("UPDATE riveraco1.empleados_web SET foto=:foto WHERE id_Empleado=:id_Empleado");           
              $sql->bindParam(':foto',$nombreArchivo);
              $sql->bindParam(':id_Empleado',$txtId);
              $sql->execute();
      }
      if (!empty($sql)) { 
         $mensaje="Registro modificado con exito!. <a href='empleados.php'>Regresar</a>";}
      
          //echo "Presionado Modificr";
          break;
        case "Cancelar":
          header("location:empleados.php");
        
        break;

       
}

?>
<body>
<div class="container">
<form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  <br>
  <?php if (isset($mensaje)){?>
<div class="card-header" align="center">
Captura informacion del empleado
<div class="alert alert-success" role="alert">
  <?php echo $mensaje; ?>
  </div>
              
          </div>
<?php } ?>

  <div class="col-md-1" >
    <label for="validationCustom01" value="" name="txtId" id="txtId"class="form-label" required>#Empleado:</label>
    <input type="text" class="form-control" id="txtId" value ="<?php echo $txtId; ?>" name="txtId" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>          
  <div class="col-md-4">
    <label value="txtNombre"class="form-label">Nombre:</label>
    <input type="text"  value="<?php echo $txtNombre; ?>" class="form-control" id="txtNombre" name="txtNombre"required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-4">
    <label  class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="txtApellidos" name ="txtApellidos" value="<?php echo $txtApellidos; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-3">
    <label class="form-label">Email:</label>
    <div class="input-group has-validation">
      
      <input type="text" class="form-control" id="txtEmail" name ="txtEmail" value="<?php echo $txtEmail;?>" >
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <label for="validationCustom03" class="form-label">Fecha nacimiento:</label>
    <input type="date" class="form-control" id="datepicker" id="txtFechaNac" name ="txtFechaNac" value="<?php echo $txtFechaNac; ?>"required>
    
  </div>
  <div class="col-md-2">
    <label for="validationCustom03" class="form-label">Fecha ingreso:</label>
    <input type="date" class="form-control" id="datepicker2" name ="txtFecIni" value="<?php echo $txtFecIni; ?>"required>
    <div class="invalid-feedback">
      Please provide a valid date.
    </div>
  </div>
  <!--<div class="col-md-2">
    <label for="validationCustom03" class="form-label">Fecha baja:</label>
    <input type="date" class="form-control" id="datepicker3" name="txtFecBaj" value="<?php echo $txtFecBaj; ?>" >
    <div class="invalid-feedback">
      Please provide a valid date.
    </div>
  </div>-->
  <div class="col-md-2">
    <label  class="form-label">Area</label>
    <select class="form-select" id="txtArea" value="<?php echo $txtArea ?>"  name="txtArea"> 
      <option selected disabled value="" id="txtArea" name="txtArea">...</option>
      <option >Administracion</option>
      <option >Pilas</option>
      <option >Pozos</option>
      <option >Sistemas</option>
      <option >Pu</option>
      <option >Giralda</option>
      <option >Huentitan</option>
      <option >Temporal</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
  <div class="col-md-2">
    <label class="form-label"name="txtPuesto">Puesto:</label>
    <input type="text" class="form-control" id="txtPuesto" value="<?php echo $txtPuesto; ?>"  name="txtPuesto">
  </div>
  
  <div class="col-md-2">
    <label  class="form-label" >Telefono Casa:</label>
    <input type="text" class="form-control" id="txtTel"value="<?php echo $txtTel; ?>"   name="txtTel">
  </div>
  
  <div class="col-md-2">
    <label for="txtCel" class="form-label" >Telefono Celular:</label>
    <input type="text" class="form-control" id="txtCel" value="<?php echo $txtCel; ?>" name="txtCel" >
  </div>
  
  <div class="col-md-2">
    <label for="txtDireccion" class="form-label">Direccion:</label>
    <input type="text" class="form-control" id="txtDireccion" value="<?php echo $txtDireccion; ?>"  name="txtDireccion">
  </div>
  
  <div class="col-md-2">
    <label for="txtCol" class="form-label">Colonia:</label>
    <input type="text" class="form-control" id="txtCol"value="<?php echo $txtCol; ?>" name="txtCol">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  
  <div class="col-md-2">
    <label for="txtCiudad" class="form-label">Ciudad   :</label>
    <input type="text" class="form-control" id="txtCiudad"value="<?php echo $txtCiudad; ?>"  name="txtCiudad">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-1">
    <label for="txtCP" class="form-label">CP:</label>
    <input type="text" class="form-control" id="txtCP" value="<?php echo $txtCP; ?>"  name="txtCP">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-1">
    <label for="txtRFC" class="form-label">RFC:</label>
    <input type="text" class="form-control" id="txtRFC" value="<?php echo $txtRFC; ?>"  name="txtRFC">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-1">
    <label for="txtCURP" class="form-label">CURP:</label>
    <input type="text" class="form-control" id="txtCURP"value="<?php echo $txtCURP; ?>"  name="txtCURP">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-1">
    <label for="txtIMSS" class="form-label">IMSS :</label>
    <input type="text" class="form-control" id="txtIMSS"  name="txtIMSS" value="<?php echo $txtIMSS; ?>">
    
  </div>
  <div class="col-md-1">
    <label for="txtSangre" class="form-label">SANGRE:</label>
    <input type="text" class="form-control" id="txtSangre"  name="txtSangre" value="<?php echo $txtSangre; ?>">
    
  </div>
  <div class="col-md-1">
    <label for="txtCuenta_banco" class="form-label">#CUENTA:</label>
    <input type="text" class="form-control" id="txtCuenta_banco"  name="txtCuenta_banco" value="<?php echo $txtCuenta_banco; ?>">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-1">
    <label for="txtSueldo" class="form-label">SUELDO:</label>
    <input type="text" class="form-control" id="txtSueldo"  name="txtSueldo" value="<?php echo $txtSueldo; ?>">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-2">
    <label for="txtSueldoTipo" class="form-label">Frecuencia de Pago:</label>
    <div class="form-check">
    <label class="form-check-label" for="flexCheckDefault">
    semanal
  </label>
  <input class="form-check-input" type="checkbox" name ="txtSueldoTipo" value="1" id="flexCheckDefault">
  <br>
  <input class="form-check-input" type="checkbox" name ="txtSueldoTipo" value="2" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Quincenal
  </label><br>
  <input class="form-check-input" type="checkbox" value="3" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Mensual
  </label>
</div>
   
  </div>

  
  <div class="col-md-1">
    <label for="txtHorasxsemana" class="form-label">HRS X SEM:</label>
    <input type="text" class="form-control" id="txtHorasxsemana"  name="txtHorasxsemana" value="<?php echo $txtHorasxsemana; ?>">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-2">
    <label for="txtEstatus" class="form-label" name ="txtEstatus">Estatus:</label>
          <div class="form-check">
          <label class="form-check-label" for="flexCheckDefault">
          Activo
        </label>
        <input class="form-check-input" type="checkbox" name ="txtEstatus" value="1" id="flexCheckDefault">
        <br>
        <input class="form-check-input" type="checkbox" name ="txtEstatus" value="2" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Suspendido
        </label><br>
        <input class="form-check-input" type="checkbox" name ="txtEstatus" value="3" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Baja definitiva
        </label>
      </div>
    
  </div>
  <div class="col-md-1">
    <label for="txtHonorarios" class="form-label">Honorarios:</label>
    <div class="form-check">
  <input class="form-check-input" type="checkbox" name ="txtHonorarios" value="1" id="flexCheckDefault">
  
</div>
  </div>

  <div class="col-md-6">
    <label for="txtNotas" class="form-label">NOTAS:</label>
    <input type="text" class="form-control" id="txtNotas"  name="txtNotas" value="<?php echo $txtNotas; ?>">
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <label for="txtFoto">Foto:</label>
                <input type="file" value=""class="form-control" id="txtFoto" name="txtFoto" aria-describedby="" placeholder="Id">  
  <div class="col-12">
                <button type="submit" name ="accion"<?php echo ($accion=="Seleccionar")?"disabled":""?> value ="agregar"class="btn btn-success">Guardar</button>
                <button type="submit" name ="accion"<?php echo ($accion!="Seleccionar")?"disabled":""?> value ="Modificar"class="btn btn-warning">Modificar</button>
                <a class="btn btn-primary" href="empleados.php" role="button">Cancelar</button></a>
  </div>
  
</div>
</form>    
</div>
<br><br>

<div class="container" width='100%'>
  
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th># Empleado</th>
                <th>Nombre</th>
                <th>A. Paterno</th>
                <th>Email</th>
                <th>Fecha Ingreso</th>
                <th>Puesto</th>
                <th>Area</th>
                <th>Sueldo tipo</th>
                <th>Sueldo</th>
                <th>NSS</th>
                <th>RFC</th>
                <th>CURP</th>
                <th>Estatus</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_Empleado'];?></td>
                <td><?PHP echo $result ['Nombre'];?></td>
                <td><?PHP echo $result ['Apellidos'];?></td>
                <td><?PHP echo $result ['Email'];?></td>
                <td><?PHP echo $result ['Fecha_ingreso'];?></td>
                <td><?PHP echo $result ['Puesto'];?></td>
                <td><?PHP echo $result ['Area'];?></td>
                <td><?PHP echo $result ['Sueldo_tipo'];?></td>
                <td><?PHP echo $result ['Sueldo'];?></td>
                <td><?PHP echo $result ['IMSS'];?></td>
                
                <td><?PHP echo $result ['RFC'];?></td>
                <td><?PHP echo $result ['CURP'];?></td>
                <td><?PHP if($result ['Estatus']==1) echo'Activo';else echo'Baja'; ?></td>
                <td><img class="img-thumbnail rounded" src="../../img/<?PHP echo $result ['foto'];?>" alt=""></td>
                <td><form  method="post">
                  <input type="hidden" name="txtId" id="txtId" value="<?PHP echo $result ['id_Empleado'] ?>" />
                  <input type="submit" name="accion" value="Seleccionar" class="btn btn-warning">
                  
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  
            </form></td>
            </tr>
            <?php } ?>        
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>