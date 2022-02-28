<?php  include ("../template/cabecera.php"); ?>
<?php   ?>
<?php 
$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtFoto=(isset($_FILES['txtFoto']['name']))?$_FILES['txtFoto']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//echo $txtFoto;
//echo$txtId;
//echo$txtNombre;
//echo$accion ;

include ("../config/bd.php");

switch($accion){
    case "agregar":     
        $sql= $conexion->prepare("INSERT INTO   riveraco1.empleados_ (nombre,foto) VALUES (:nombre,:foto)");
        $sql->bindParam(':nombre',$txtNombre);

        $fecha= new DateTime();
        $nombreArchivo=($txtFoto!="")?$fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jgp";

        $tmpImagen=$_FILES["txtFoto"]["tmp_name"];
        
        if ($tmpImagen!=""){

            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

        }
        $sql->bindParam(':foto',$nombreArchivo);
        $sql->execute();
        header("location:productos.php");
        break;

        case "Modificar":
            $sql= $conexion->prepare("UPDATE riveraco1.empleados_ SET nombre=:nombre WHERE id=:id  ");           
            $sql->bindParam(':nombre',$txtNombre);
            $sql->bindParam(':id',$txtId);

            
            
            if ($txtFoto!=""){
                $fecha= new DateTime();
                $nombreArchivo=($txtFoto!="")?$fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jgp";               
                $tmpImagen=$_FILES["txtFoto"]["tmp_name"];
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
                $sql= $conexion->prepare("SELECT foto FROM riveraco1.empleados_ WHERE id =:id");           
                $sql->bindParam(':id',$txtId);
                $sql->execute();
                $rest=$sql->fetch(PDO::FETCH_LAZY);
    
                if( isset($rest["foto"]) &&($rest["foto"]!="imagen.jpg") ){
    
                    if(file_exists("../../img/".$rest["foto"])){
    
                        unlink("../../img/".$rest["foto"]);
    
    
                    }
    
                }
            
                $sql= $conexion->prepare("UPDATE riveraco1.empleados_ SET foto=:foto WHERE id=:id  ");           
                $sql->bindParam(':foto',$nombreArchivo);
                $sql->bindParam(':id',$txtId);
                $sql->execute();
        }
            
        header("location:productos.php");
            //echo "Presionado Modificr";
            break;
        case "Cancelar":
            header("location:productos.php");
        break;
        case "Seleccionar":
            $sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_ WHERE id =:id");           
            $sql->bindParam(':id',$txtId);
            $sql->execute();
            $rest=$sql->fetch(PDO::FETCH_LAZY);

            $txtNombre=$rest['nombre'];
            $txtFoto=$rest['foto'];
            
            //echo "Presionado Seleccionar";
        break;

        case "Borrar":
            $sql= $conexion->prepare("SELECT foto FROM riveraco1.empleados_ WHERE id =:id");           
            $sql->bindParam(':id',$txtId);
            $sql->execute();
            $rest=$sql->fetch(PDO::FETCH_LAZY);

            if( isset($rest["foto"]) &&($rest["foto"]!="imagen.jpg") ){

                if(file_exists("../../img/".$rest["foto"])){

                    unlink("../../img/".$rest["foto"]);


                }

            }
            
            $sql= $conexion->prepare("DELETE FROM riveraco1.empleados_ WHERE id =:id");           
            $sql->bindParam(':id',$txtId);
            $sql->execute();
            header("location:productos.php");
        //echo "Presionado Borrar";
            
        break;
                    
}
$sql=$conexion->prepare("SELECT * FROM riveraco1.empleados_ ");
$sql->execute();
$result=$sql->fetchAll(PDO::FETCH_ASSOC);
?>

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
<br>

<div class="container">
  <div class="row">
    <div class="col-md-5">
      <form method="POST" enctype="multipart/form-data">
      <div class="card">
          <div class="card-header">
              Captura informacion
          </div>
          <div class="card-body">
          <div class = "form-group">
          
                <label for="txtId">ID:</label>
                <input type="txtId" required readonly value="<?php echo $txtId; ?>" class="form-control" id="txtId" name="txtId"aria-describedby="emailHelp" placeholder="Id">
                
                </div>
                <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="txtNombre"required  value="<?php echo $txtNombre; ?>" class="form-control" id="txtNombre" name="txtNombre" placeholder="ingresa el nombre">
                
                <label for="txtFoto">foto:<?php echo $txtFoto; ?></label>
                <input type="file" value=""class="form-control" id="txtFoto" name="txtFoto"aria-describedby="emailHelp" placeholder="Id">
                </div>
                <div class="form-check">
                
                
                </div>
                <button type="submit" name ="accion" <?php echo ($accion=="Seleccionar")?"disabled":""?> value ="agregar"class="btn btn-success">Guardar</button>
                <button type="submit" name ="accion" <?php echo ($accion!="Seleccionar")?"disabled":""?> value ="Modificar"class="btn btn-warning">Modificar</button>
                <button type="submit" name ="accion"<?php echo ($accion!="Seleccionar")?"disabled":""?> value ="Cancelar"class="btn btn-primary">Cancelar</button>
                </form>
      
          
          </div>
      </div>
      
      
    </div>
    <div class="col-md-7">
      <table class="table table-striped">
          <thead>
              <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">foto</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Acciones</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($result as $result){?>
              <tr>
                  <th><?PHP ECHO $result ['id'] ?></th>
                  <td><?PHP ECHO $result ['nombre'] ?></td>
                  <td>
                  <img src="../../img/<?PHP ECHO $result ['foto'] ?>" width="50" alt="">
                  </td>
                  <td></td>
                  <td>
                  
                  
                  <form  method="post">
                  
                  <input type="hidden" name="txtId" id="txtId" value="<?PHP ECHO $result ['id'] ?>" />
                  <input type="submit" name="accion" value="Seleccionar" class="btn btn-warning">
                  
                  
                  
                  </form>
                  
                  
                  </td>


              </tr>
              <?php }?>
          </tbody>
      </table>
    </div>
    
  </div>
</div>
    
    <?php  include ("../template/footer.php"); ?>