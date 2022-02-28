<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php include ("search.php"); ?>

 
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> 
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> -->
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
<script>$("#ModalNuevo").find("input,textarea,select").val("");</script>
<script>
$('.modal').on('hidden.bs.modal', function(){ 
		$(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
		$("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
	});
</script>

<?php 
$cliente =(isset($_POST['country']))?$_POST['country']:"";
$departamento =(isset($_POST['departamento']))?$_POST['departamento']:"";
$usuario =$_SESSION['id'];
$obra =(isset($_POST['obra']))?$_POST['obra']:"";
$lugar =(isset($_POST['lugar']))?$_POST['lugar']:"";
$atencion =(isset($_POST['atencion']))?$_POST['atencion']:"";
$fecha = date('Y/m/d', time());
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$buscar = (isset($_POST['query']))  
//$razonsocial =(isset($_POST['razonsocial']))?$_POST['razonsocial']:"";
// $RFC =(isset($_POST['RFC']))?$_POST['RFC']:"";
// $Calle =(isset($_POST['Calle']))?$_POST['Calle']:"";
// $Colonia =(isset($_POST['Colonia']))?$_POST['Colonia']:"";
// $Ciudad =(isset($_POST['Ciudad']))?$_POST['Ciudad']:"";
// $CP =(isset($_POST['CP']))?$_POST['CP']:"";
// $Estado =(isset($_POST['Estado']))?$_POST['Estado']:"";
// $email =(isset($_POST['email']))?$_POST['email']:"";
// $Telefono =(isset($_POST['Telefono']))?$_POST['Telefono']:"";
?>


<?php
switch($accion){
    case "agregar":

                    $sql=$conexion->prepare ("INSERT INTO riveraco1.presupuestos_ (id_cliente,id_area,id_usuario,nombre_obra,lugar_obra,atencion,fecha_captura)
                    VALUES (:id_cliente,:id_area,:id_usuario,:nombre_obra,:lugar_obra,:atencion,:fecha_captura)");
                    $sql->bindParam(':id_cliente',$cliente);
                    $sql->bindParam(':id_area',$departamento);
                    $sql->bindParam(':id_usuario',$usuario);
                    $sql->bindParam(':nombre_obra',$obra);
                    $sql->bindParam(':lugar_obra',$lugar);
                    $sql->bindParam(':atencion',$atencion);
                    $sql->bindParam(':fecha_captura',$fecha);
                    $sql->execute(); 
                    break;
 // case "agregarcliente":
 //                 $sql=$conexion->prepare("INSERT INTO clientes (Razon_social,RFC,Calle,Colonia,Codigo_Postal,Ciudad,Estado,Correo_electronico,Telefono,Fecha_alta)
 //                                                        VALUES (:Razon_social,:RFC,:Calle,:Colonia,:Codigo_Postal,:Ciudad,:Estado,:Correo_electronico,:Telefono,:Fecha_alta)");
 //            $sql->bindParam('Razon_social',$razonsocial);
 //            $sql->bindParam('RFC',$RFC);
 //            $sql->bindParam('Calle',$Calle);
 //            $sql->bindParam('Colonia',$Colonia);
 //            $sql->bindParam('Ciudad',$Ciudad);
 //            $sql->bindParam('Codigo_Postal',$CP);
 //            $sql->bindParam('Estado',$Estado);
 //            $sql->bindParam('Correo_electronico',$email);
 //            $sql->bindParam('Telefono',$Telefono);
 //            $sql->bindParam('Fecha_alta',$fecha);
 //            $sql->execute();
 //            break;
}                                    
?>

<?php $sql=$conexion->prepare("SELECT p.id_presupuesto,clientes.razon_social,areas.Nombre_area,usuarios.Nombre,p.nombre_obra,p.lugar_obra,p.atencion,p.fecha_captura FROM 
                                presupuestos_ p
                                INNER JOIN areas on areas.id_area = p.id_area
                                INNER JOIN clientes ON clientes.id_cliente = p.id_cliente
                                INNER JOIN usuarios ON usuarios.Id_usuario =p.id_usuario" );                                             
            $sql->execute();
            $presupuestos=$sql->fetchall(PDO::FETCH_ASSOC);
?>

<div class="container" width='100%'>
    <div class="jumbotron">
        <h1 class="display-4">Presupuestos</h1>
        <p class="lead">Relacion de presupuestos</p>
        <hr class="my-4">
        <p><table id="example" class="display nowrap" style="width:100%">
        <thead>
        <div class="col-12"><!-- Menu agregar nuevos presupuestos-->
       
        <!-- Modal para registros nuevos -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">
  Nuevo Presupuesto
</button>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevoCliente">
  Nuevo cliente
</button>
<script>
    
        $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query:query},  
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

<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura los datos para el presupuesto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="country" id="country" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Cliente</label>
                  <div id="countryList"></div>  
            </div>
            
            <div class="input-group mb-3" name ="departamento">
            <label class="input-group-text" for="inputGroupSelect01" name ="departamento">Areas</label>
            <select class="form-select" id="inputGroupSelect01"name ="departamento">
                <option selected>Selecciona...</option>
                <option value="1">Pilas</option>
                <option value="2">Pozos BORE</option>
                <option value="3">Pozos Profundos</option>
            </select>
            </div>
                        
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="obra" name ="obra"placeholder="" required>
            <label for="floatingInput">Nombre de la Obra</label>
            </div>
            
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="lugar" name ="lugar"placeholder="">
            <label for="floatingInput">lugar donde se realiza la Obra</label>
            </div>
          
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="atencion" name ="atencion"placeholder="" required>
            <label for="floatingInput">Atencion:</label>
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

        </div>
        <!--modal cliente Nuevo-->
        <div class="modal fade" id="ModalNuevoCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura los datos del cliente</h5>
        
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="razonsocial" name ="razonsocial"placeholder="" required>
            <label for="floatingInput">Razon Social:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="rfc" name ="RFC"placeholder="" required>
            <label for="floatingInput">RFC:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Calle" name ="Calle"placeholder="" required>
            <label for="floatingInput">Calle y numero:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Colonia" name ="Colonia"placeholder="" required>
            <label for="floatingInput">Colonia:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Ciudad" name ="Ciudad"placeholder="" required>
            <label for="floatingInput">Ciudad:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="CP" name ="CP"placeholder="" required>
            <label for="floatingInput">Codigo Postal:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Estado" name ="Estado"placeholder="" required>
            <label for="floatingInput">Estado:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name ="email"placeholder="" required>
            <label for="floatingInput">Email:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="telefono" name ="telefono"placeholder="" required>
            <label for="floatingInput">Numero de tel:</label>
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" name ="accion" value ="agregarcliente" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

        </div>



        <br>
        <br>
            <tr>
                <th># presupuesto</th>
                <th>Cliente</th>
                <th>Area</th>
                <th>Obra</th>
                <th>Lugar obra</th>
                
                <th>Atencion</th>
                <th>Acciones</th>
          
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presupuestos as $result) {?>
                                        <tr>
                <td><?PHP echo $result ['id_presupuesto'];?></td>
                <td><?PHP echo $result ['razon_social'];?></td>
                <td><?PHP echo $result ['Nombre_area'];?></td>
                <td><?PHP echo $result ['nombre_obra'];?></td>
                <td><?PHP echo $result ['lugar_obra'];?></td>
                
                <td><?PHP echo $result ['atencion'];?></td>
                <td><form  method="post" action="presupuestos_detalles.php">
                  <input type="hidden" name="txtId" id="txtId" value="<?PHP echo $result ['id_presupuesto'] ?>" />                 
                  <a button type="button" name="accion" value="" href ="presupuestos_detalles.php"class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal_<?PHP echo $result ['id_presupuesto'] ?>">Detalles</button>
                  
                </form>
                </td>
                
            </tr>
            
        </tbody>
         <!-- Modal detalles-->
<div class="modal fade" id="myModal_<?PHP echo $result ['id_presupuesto'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles del presupuesto # <?PHP echo $result ['id_presupuesto'];?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
  
  <div class="card-body">
    <h5 class="card-title"></h5>   
  </div>
  <ul class="list-group list-group-flush">
  <li class="list-group-item">Cliente: <?PHP echo $result ['razon_social'];?> </li>
  <li class="list-group-item">Area de trabajo: <?PHP echo $result ['Nombre_area'];?> </li>
  <li class="list-group-item">Nombre de Obra: <?PHP echo $result ['nombre_obra'];?> </li>
  <li class="list-group-item">Lugar de la Obra: <?PHP echo $result ['lugar_obra'];?> </li>
  <li class="list-group-item">Cliente: <?PHP echo $result ['razon_social'];?> </li>
  <li class="list-group-item">Area de trabajo: <?PHP echo $result ['Nombre_area'];?> </li>
  </ul>
      </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>

       <!-- Modal para agregar detalles -->
       

       
      <?php } ?>
        
      </div>
      
      
    </div>
  </div>
</div>


          </form>
      
    
    </table></p>
    </div>


    
</div>
 




<?php  include ("../template/footer.php"); ?>