
<?php include ("../template/cabecera.php");?>
<br>
<br>
<br>
<br>



<!doctype html>
<html lang="en">
  <head>
    <title>Preupuestos detalles</title>
    <!-- Required meta tags -->
 
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS v5.0.2 -->
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  -->
  </head>
  <body>
    
  <div class="container">
    <div class ="row">
        <div class ="col-5">
           
                <div class="card">
                    <div class="card-header">Presupuesto</div>
                    <div class="card-body">
                    <form action="" method="post">
                       <label> <h5 class="card-title">Ingresa el # de presupuesto</h5></label>
                        <p class="card-text">
                            <label>ID
                           <input class="form-control" type="text" name="txtID" id="txtID"></label>
                           <label> <h5 class="card-title">Concepto</h5>
                           <input class="form-control" type="text" name="txtConcepto" id="txtConcepto"></label>
                           <br>
                           <label> <h5 class="card-title">costo</h5>

                           <input class="form-control" type="number"name="txtCosto " id="txtCosto"></label>
                           <label> <h5 class="card-title">cantidad</h5>

                           <input class="form-control" type="number" name="txtCantidad " id="txtCantidad"></label>
                        </p>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button id ="btnAgregar"type="button" class="btn btn-success">Agregar</button>
                            <button id ="btnEditar" type="button" class="btn btn-warning">Modificar</button>
                            
                        </div>
                        </form>
                    </div>
                </div>

            
        </div>

    
        <div class ="col-7"><table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="registros">
                <tr>
                    <td>2</td>
                    <td>2</td>
                    <td>2</td>
                    <td>2</td>
                    <td>Editar | Borrar</td>
                </tr>
            </tbody>
            <!-- <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total:</th>
                    <th>3</th>
                </tr>               
            </tfoot> -->
        </table>
        
        </div>
    </div>
</div>
<div id="mensaje"></div>
      <script>
$(document).ready(function () {
    
    
    
});

 $('#btnAgregar').click(function (e) {
    insert();
    //alert("Hola puto");
 });
 function insert(){
     var datos = new FormData();
     datos.append('presupuesto',$('#txtID').val());
     datos.append('nombre',$('#txtConcepto').val());
     datos.append('costo',$('#txtCosto').val());
     datos.append('cantidad',$('#txtCantidad').val());
     console.log(datos.get('presupuesto'));
     console.log(datos.get('nombre'));
     console.log(datos.get('costo'));
     console.log(datos.get('cantidad'));

     $.ajax({
         type: "post",
         url: "consultas.php?accion=insertar",
         data: datos,
         processData:false,
         contentType:false,
         success: function (respuesta) {
          console.log(respuesta);
          consultar(); 
         }
     });
 }
 function consultar(){
        $("#registros").empty();
        
        $.getJSON("consultas.php",function(registros){

           var presupuestos=[];
           $.each(registros, function(llave, valor){
               if (llave>0){

                   var template ="<tr>";
                    
                        template+="<td>"+valor.id_presupuesto+"</td>";
                        template+="<td>"+valor.concepto+"</td>";
                        template+="<td>"+valor.cantidad+"</td>";
                        template+="<td>"+valor.costo+"</td>";
                        template+='<td>'
                        template+='<input class ="btn btn-danger"  type="button" onclick="borrar('+valor.id+')" value="X" /></td>';
                        template+="</tr>";
                        presupuestos.push(template);

               }
           });
            $("#registros").append(presupuestos.join(""));

            console.log(registros);
        }
        );
 }
 consultar();

 function borrar(id){

     $.get("consultas.php?borrar="+id,function () {
         consultar();


         });
 }
 function seleccionar (id){
     $.getJSON("consultas.php?consultar="+id,function (registros){
         console.log(registros);

     });
 }
        
        

      </script>
    <!-- Bootstrap JavaScript Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"  />
  </body>
</html>

