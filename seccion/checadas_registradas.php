<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?><br>
<?php $sql=# $conexion->prepare("SELECT riveraco1.checadas.id_empleado,riveraco1.empleados_web.Nombre,riveraco1.checadas.entrada,riveraco1.checadas.salida
            #                    FROM riveraco1.checadas 
             #                   INNER JOIN riveraco1.empleados_web ON riveraco1.checadas.id_empleado = riveraco1.empleados_web.id_empleado ");
            $sql= $conexion->prepare("SELECT c.id_empleado,e.Nombre,e.Apellidos,fecha,hora,tipo FROM checadas c
            INNER JOIN empleados_web e ON e.id_Empleado = c.id_empleado ");                                               
            $sql->execute();
            $checadas=$sql->fetchall(PDO::FETCH_ASSOC);
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
     
 <br>
 <br>
 <br>

<div class="container" width='100%'>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th># empleado</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Tipo</th>
          
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($checadas as $result) {?>
            <tr>
                <td><?PHP echo $result ['Nombre'];?> <?PHP echo $result ['Apellidos'];?></td>
                <td><?PHP echo $result ['fecha'];?></td>
                <td><?PHP echo $result ['hora'];?></td>
                <td><?PHP if($result['tipo']==1)echo '<button type="button" class="btn btn-success">Entrada</button>';
                     else if($result['tipo']==2)echo'<button type="button" class="btn btn-danger">Salida</button>';
                     else if($result['tipo']==3)echo'<button type="button" class="btn btn-warning">Comida</button>';
                     else if($result['tipo']==4)echo'<button type="button" class="btn btn-info">R. Comida</button>'?></td>
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>