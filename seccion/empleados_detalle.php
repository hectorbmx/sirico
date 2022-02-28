<?php include ("../template/cabecera.php");?>

<?php include ("../config/bd.php"); ?>

<br> <br><br> <br>
<script>
    
        $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query_empleados = $(this).val();  
           if(query_empleados != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query_empleados:query_empleados},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#country').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 });  

    
</script>
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
$nombre=(isset($_POST['country']))?$_POST['country']:"";
if ($nombre){
    $sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_pagos where id_Empleado=$nombre");           
    $sql->execute();
    $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
}

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles empleados</title>
</head>
<body>
    
    <div class="container" >
        <ul class="nav nav-tabs"> 
            <li><a href="#pagos"></a>Pagos</li>
            <li><a href="#permisos"></a>Permisos</li>
            <li><a href="#notas"></a>Notas</li>
            <li><a href="#vacaciones"></a>Vacaciones</li>
        </ul>


</div>
    
