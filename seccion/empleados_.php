<?php include ("../template/header.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_web ");           
            $sql->bindParam(':id_Empleado',$txtId);
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
     


<div class="container" width='100%'>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th># Empleado</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Area</th>
                <th>F.contratacion</th>
                <th>Horario</th>
                <th>Sueldo</th>
                <th>F.nacimiento</th>
                <th>Foto</th>
                <th>Forma de pago</th>
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_Empleado'];?></td>
                <td><?PHP echo $result ['Nombre'];?></td>
                <td><?PHP echo $result ['Apellidos'];?></td>
                <td><?PHP echo $result ['Area'];?></td>
                <td><?PHP echo $result ['Fecha_ingreso'];?></td>
                <td><?PHP echo $result ['Horario'];?></td>
                <td>$<?PHP echo $result ['Sueldo'];?></td>
                <td><?PHP echo $result ['Fecha_nacimiento'];?></td>
                <td><img src="../../img/<?PHP echo $result ['foto'];?>" alt="" width="250"></td>
                <td><?PHP echo $result ['Sueldo'];?></td>
                
            </tr>
            <?php } ?>      
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">
  Agregar empleado
</button><br>
        </tbody>
     
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>