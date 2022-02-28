<?php include ("../template/cabecera.php");?>

<?php include ("../config/bd.php"); ?>

<?php 
$sql= $conexion->prepare("SELECT empleados_pagos.id_pago,empleados_web.Nombre,empleados_pagos.sueldo_imss,empleados_pagos.sueldo_real,
                                 empleados_web.Apellidos,empleados_web.puesto,empleados_pagos.fecha_pago,tipos_sueldo.Nombre as pago,
                                 empleados_pagos.descuentos,empleados_pagos.descuentos_con,empleados_pagos.total,empleados_pagos.complemento,empleados_pagos.horasextras,
                                 empleados_pagos.metroslineales,empleados_pagos.num_semana
                                 from empleados_pagos
                                 inner join empleados_web on empleados_web.id_Empleado = empleados_pagos.id_Empleado
                                 inner join tipos_sueldo on tipos_sueldo.id_forma_pago = empleados_pagos.Frecuencia_pago");                       
                                 $sql->execute();
                                 $empleados=$sql->fetchall(PDO::FETCH_ASSOC);

// $sql= $conexion->prepare("SELECT empleados_pagos.id_Empleado,empleados_web.nombre FROM empleados_pagos
//                           INNER JOIN empleados_web on empleados_web.id_empleado = empleados_pagos.id_empleado ");
// $sql->execute();
// $empleados_web=$sql->fetchall(PDO::FETCH_ASSOC);
?> 
<!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script> -->
<!-- prueba de exportar -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script> -->
<!-- terminan los nuevos Js -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
Comienzan los CSS nuevos para exporar -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

<?php
$hoy =(date("Y-m-d"));
$txtMes=(isset($_POST['txtMes']))?$_POST['txtMes']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtSueldoTipo=(isset($_POST['txtSueldoTipo']))?$_POST['txtSueldoTipo']:"";
$txtDescuentos=(isset($_POST['txtDescuentos']))?$_POST['txtDescuentos']:"";
$txtConcepto=(isset($_POST['txtConcepto']))?$_POST['txtConcepto']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$notasId=(isset($_POST['notasId']))?$_POST['notasId']:"";
$nota=(isset($_POST['nota']))?$_POST['nota']:"";
$pagotipo=(isset($_POST['pagotipo']))?$_POST['pagotipo']:"";
$weekNum = date("W") - date("W",strtotime(date("Y-m-01"))) + 1;


?>
<br> <br><br>
<div class="container"  width='100%'>
<form method="post" action="">
    <h2>Reporte mensual de pagos a empleados</h2><br><br>
    
    <?php echo "estas en la semana $weekNum de ".date("F");?>

    <br><br>

    <label>Selecciona el rango de fechas que deseas ver:</label>
<select name ="txtMes" id="">
    <option name ="txtMes"selected>Selecciona un mes</option>
    <option value="1">Enero</option>
    <option value="2">Febrero</option>
    <option value="3">Marzo</option>
    <option value="4">Abril</option>
    <option value="5">Mayo</option>
    <option value="6">Junio</option>
    <option value="7">Julio</option>
    <option value="8">Agosto</option>
    <option value="9">Septiembre</option>
    <option value="10">Octubre</option>
    <option value="11">Noviembre</option>
    <option value="12">Diciembre</option>

</select>
<input name="accion" id="" class="btn btn-primary" type="submit" value="buscar">    <br>
<?php if (isset($mensaje)){?>
        <?php echo $mensaje; ?>
        <?php } ?>
</form>
<br> <br><br> <br>

<table id="example" class="display nowrap" style="width:100%" >
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha pago</th>
                <th>Semana</th>
                <th>Sueldo tipo</th>
                <th>Sueldo IMSS</th>
                <th>Sueldo REAL</th>
                <th>Complemento</th>
                <th>Metros lineales</th>
                <th>Horas extras</th>
                <th>Total pagado</th>
            </tr>
        </thead>
        <tbody>
            
                
            <tr> 
                     
            
             
        <?php foreach ($empleados as $result) {?>
            <tr> 
                <td><?PHP echo $result ['Nombre'];?> <?PHP echo $result ['Apellidos'];?></td>
                  
                <td><?PHP echo $result ['fecha_pago'];?></td>
                <td><?PHP echo $result ['num_semana'];?></td>
                <td><?PHP echo $result ['pago'];?></td>
                <td>$<?PHP echo $result ['sueldo_imss'];?></td>
                <td>$<?PHP echo $result ['sueldo_real'];?></td>
                <td>$<?PHP echo $result ['complemento'];?></td>
                <td>$<?PHP echo $result ['metroslineales'];?></td>
                <td>$<?PHP echo $result ['horasextras'];?></td>
                <td>$<?PHP echo $result ['total'];?></td>
                     <?php } ?><!-- cierra el foreach para el llenado de la tabla -->     
            </tr>               
        </tbody>   
        <tr>
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Cantidad pagada del mes </td>
            <td>  $</td>
        </tr>         
    </table>
    </div><!-- Cierra el contenedor principal-->