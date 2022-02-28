<?php  include ("../template/cabecera.php"); ?>
<?php
include ("../config/bd.php");

 $sql= $conexion->prepare("SELECT productos.id_producto,nombre,descripcion,proveedor,area,inventario_almacen.existencia
                                 from productos
                                 left join inventario_almacen on inventario_almacen.id_producto = productos.id_producto");           
            
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
<br>

<table id="example" class="display nowrap" style="width:100%">
<?php if (isset($mensaje)){?>
        <div class="alert alert-success" role="alert">
          <?php echo $mensaje; ?>
        </div>
        <?php  } ?>
        <thead>
            <tr>
                <th>#producto</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>proveedor</th>
                <th>area</th>
                <th>existencia</th>
                
                
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_producto'];?></td>   
                <td><?PHP echo $result ['nombre'];?></td>
                <td><?PHP echo $result ['descripcion'];?></td>
                <td><?PHP echo $result ['proveedor'];?></td>
                <td><?PHP echo $result ['area'];?></td>
                <td><?PHP echo $result ['existencia'];?></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>



<?php include ("../template/footer.php");?>