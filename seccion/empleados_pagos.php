<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT id_Empleado,Nombre,Apellidos,Sueldo,Sueldo_tipo,Nombre_forma_pago as tipo_pago 
                                 FROM riveraco1.empleados_web 
                                 INNER JOIN riveraco1.formas_de_pago on riveraco1.empleados_web.sueldo_tipo = riveraco1.formas_de_pago.id_forma_pago");           
            
            
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
?>
 
  
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>



<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
    
<?php
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$id_Empleado =(isset($_POST['id_Empleado']))?$_POST['id_Empleado']:"";
$fecha =date("Y-m-d");
$Frecuencia_pago =(isset($_POST['Sueldo_tipo']))?$_POST['Sueldo_tipo']:"";
$hoy =strtotime(date("Y-m-d"));
//$num_semana = date("w", strtotime($hoy));;
$num_semana = (isset($_POST['Semana']))?$_POST['Semana']:"";
$mes = date ("M");
$descuentos = (isset($_POST['descuentos']))?$_POST['descuentos']:"";
$descuentos_con = (isset($_POST['descuentos_con']))?$_POST['descuentos_con']:"";
$total = (isset($_POST['total']))?$_POST['total']:"";



?>
<?php switch($accion){
    case "agregar":   
       
        $sql= $conexion->prepare("INSERT INTO riveraco1.empleados_pagos 
                                 (id_Empleado,fecha_pago,Frecuencia_pago,num_semana,mes,descuentos,descuentos_con,total)
                                    VALUES
                                  (:id_Empleado,:fecha_pago,:Frecuencia_pago,:num_semana,:mes,:descuentos,:descuentos_con,:total)");
        
        $sql->bindParam(':id_Empleado',$id_Empleado);
        $sql->bindParam(':fecha_pago',$fecha);
        $sql->bindParam(':Frecuencia_pago',$Frecuencia_pago);
        $sql->bindParam(':mes',$mes);
        $sql->bindParam(':num_semana',$num_semana);
        $sql->bindParam(':descuentos',$descuentos);
        $sql->bindParam(':descuentos_con',$descuentos_con);
        $sql->bindParam(':total',$total);
        $sql->execute();
        #("location:empleados_pagos.php");
        break;
    }
 
    ?>
    

<div class="container">
<br><br>
<br><br>

<table class="table">
  <thead class="">
    <tr>
      <th scope="col"># Empleado</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Sueldo</th>
      <th scope="col">Fecha de pago</th>
      <th scope="col">Tipo de pago</th>
      <th scope="col"># Semana</th>
      <th scope="col"> Mes</th>
      <th scope="col">Descuentos</th>
      <th scope="col">Concepto descuento</th>
      <th scope="col">Cantidad a pagar</th>
      <th scope="col"></th>
      <th scope="col">Pagado</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($empleados as $result) {?>
    <tr>
    <form method="POST" enctype="multipart/form-data">
      <th scope="row"><?PHP echo $result ['id_Empleado'];?>
      <input type="hidden" name="id_Empleado" id="id_Empleado" value="<?PHP ECHO $result ['id_Empleado'] ?>" /></th>
      <td ><?PHP echo $result ['Nombre'];?></td>
      <TD> <?PHP echo $result ['Apellidos'];?></td>
      <td>$<?PHP echo $result ['Sueldo'];?></td>
      <td ><?php echo $fecha ?> </td>
      <td >
      <input type="hidden" name="Sueldo_tipo" id ="Sueldo_tipo"value="<?PHP echo $result ['Sueldo_tipo'];?>"> <?PHP echo $result ['tipo_pago'];?></td>
      <td >
           <select class="form-select" aria-label="Default select example" name="Semana" id="Semana">
                <option selected disabled>...</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </td>
      <td ><?php echo $mes ?></td>        
      <td name="descuentos" id="descuentos"><input type="text" class="form-control" name ="descuentos"id="descuentos"></td>
      <td name="descuentos_con"id="descuentos_con"><input type="text" class="form-control" name ="descuentos_con"id="descuentos_con"></td>
      <td name="total"id="total"><input type="text" class="form-control"value="<?PHP echo $result ['Sueldo'];?>" name ="total"id="total"></td>
      <td><button type="submit" name ="accion" value ="agregar" class="btn btn-success">Guardar</button></td>
      <td><div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    
  </label>
</div></td>
    </tr>
  </form>
  </tbody>
  <?php } ?>    
</table>





<?php include ("../template/footer.php");?>