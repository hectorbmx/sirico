<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>




<html lang="en">
<head>
<script
			  src="https://code.jquery.com/jquery-3.6.0.slim.js"
			  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
			  crossorigin="anonymous"></script>
              
    <body>
        <div>
            <br>
        <div class="mb-3">
            
  <label for="exampleFormControlInput1" class="form-label"><h2>Ingresa el proveedor</h2></label>
  
  <div class="row"> 
      <div class ="col-2"> 
          <input type="text" class="form-control" placeholder="Numero del proveedor" aria-label="num_proveedor">
      </div>
        <div class ="col-2"> 
            <input type="button"class="btn btn-success" value="Buscar" onclick="Buscar();">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevoCliente">Nuevo </button>
        </div>
           
    </div>
</div>
<div class="row">
  <div class="col">
      <div id="mostrar_mensaje"></div>
      <form action="insertar.php" method ="POST">
    <input type="text" class="form-control" placeholder="Razon_social" aria-label="Razon_social">
  </div>
  <div class="col-2">
    <input type="text" class="form-control" placeholder="RFC" aria-label="RFC">
  </div>
  
</div>
<br>
<div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="Domicilio" aria-label="Domicilio">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="telefono" aria-label="telefono">
  </div>



  <h2>Ingresa los productos de la orden de compra</h2><br>
  <div class="row">
  <div class="col-2">
    <input type="text" class="form-control" placeholder="cantidad" aria-label="cantidad">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="concepto" aria-label="concepto">
  </div>
  <div class="col-2">
    <input type="text" class="form-control" placeholder="precio" aria-label="precio">
  </div>
  <div class="col-2">
    <input type="text" class="form-control" placeholder="importe" aria-label="importe">
    
  </div>
  <div class="col-2">
    
    <button type="submit" class="btn btn-success"value ="enviar">enviar</button>
  </div>
</div>

        </div>

        </form>
    </body>

<script>
    function Buscar()
    {
        var parametros =
        {
            "numero": "numero"
        };
        
    
    $.ajax({
        data:parametros,
        type: "POST",
        url: "buscar.php",

        beforesend: function () 
                {
            $('#mostrar_mensaje').html(mensaje antes de enviar);
                }
                success: function (mensaje)
                {
                    $('#mostrar_mensaje').html(mensaje);
                }
         });
    }
</script>


<?php include ("../template/footer.php");?>