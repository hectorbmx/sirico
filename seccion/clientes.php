<?php include ("../template/header.php");?>
<?php include ("../config/bd.php"); ?>
<?php $sql= $conexion->prepare("SELECT * FROM riveraco1.clientes ");           
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
<br>
<br>
<br>
     
<div class="container" width='100%'>
    <div class="jumbotron" >
        <h1 class="display-4">Clientes</h1>
        <p class="lead">Clientes en general</p>
        <hr class="my-4">
        <p><table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Cliene/Razon Social</th>
                <th>RFC</th>
                <th>Domicilio</th>
                <th>Colonia</th>
                <th>CP</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>E-mail tipo</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['Razon_social'];?></td>
          
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div></p>
    </div>

 



<?php include ("../template/footer.php");?>