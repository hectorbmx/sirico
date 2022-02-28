<?php include ("../template/header.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_anterior ");           
            
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
                <th>A. Paterno</th>
                <th>A. Materno</th>
                <th>Fecha Nac.</th>
                <th>Fecha Ingreso</th>
                <th>Puesto</th>
                <th>Area</th>
                <th>Sueldo tipo</th>
                <th>Sueldo</th>
                <th>IMSS</th>
                <th>RFC</th>
                <th>CURP</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['Numero_empleado'];?></td>
                <td><?PHP echo $result ['Nombre'];?></td>
                <td><?PHP echo $result ['Paterno'];?></td>
                <td><?PHP echo $result ['Materno'];?></td>
                <td><?PHP echo $result ['Fecha_nacimiento'];?></td>
                <td><?PHP echo $result ['Fecha_ingreso'];?></td>
                <td><?PHP echo $result ['Puesto'];?></td>
                <td><?PHP echo $result ['Area'];?></td>
                <td><?PHP echo $result ['Sueldo_tipo'];?></td>
                <td><?PHP echo $result ['Sueldo'];?></td>
                <td><?PHP echo $result ['IMSS'];?></td>
                <td><?PHP echo $result ['RFC'];?></td>
                <td><?PHP echo $result ['CURP'];?></td>
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 



<?php include ("../template/footer.php");?>