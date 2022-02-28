<?php 
include ("config/bd.php");
session_start();
$nombre=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$pass=(isset($_POST['contrasenia']))?$_POST['contrasenia']:"";
            $sql= $conexion->prepare("SELECT * FROM usuarios where Nombre=:Nombre and Password=:Password");           
            $sql->bindParam(':Nombre',$nombre);
            $sql->bindParam(':Password',$pass);
            $sql->execute();
            $result=$sql->fetch(PDO::FETCH_LAZY);
            $name =$result['Nombre'];
            $pw =$result ['Password'];
            $tipo =$result ['tipo_usuario'];
            $user = $result ['Id_usuario'];   
            // echo $tipo;
            // echo $name;
            // echo $pw;
            


if ($_POST){
    if(($_POST['txtUsuario']==$name)&&($_POST['contrasenia']==$pw)){
        
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']=$name;
        $_SESSION['id']=$user;
        $_SESSION['tipo_usuario']=$tipo;
       // echo $user;
        header('location:inicio.php');
    }else{
      $mensaje="Error: el usuario o pass son incorrectos";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">

  <div class="col-md-4">
  </div>
    <div class="col-md-4">
    <br><br><br>  <br><br><br><br><br><br>  <br><br><br>
    <img src="images/logo.jpg" class="rounded mx-auto d-block" alt="">
    <div class="card">
        <div class="card-header">
            Login SIRICO
        </div>
        <div class="card-body">
        <?php if (isset($mensaje)){?>
        <div class="alert alert-danger" role="alert">
          <?php echo $mensaje; ?>
        </div>
        <?php  } ?>
        
            <h5 class="card-title"></h5>
            <p class="card-text">
            <form method ="post" action="">
            <div class = "form-group">
            <label >Usuario:</label>
            <input type="text" class="form-control"  name="txtUsuario" aria-describedby="usuario" placeholder="Escribe tu usuario">
            <small id="emailHelp" class="form-text text-muted">Asegurate de escribirlo correctamente</small>
            </div>
            <div class="form-group">
            <label >Contraseña</label>
            <input type="password" class="form-control" name="contrasenia"  placeholder="Escribe tu contraseña">
            </div>
           <br>
            <button type="submit" class="btn btn-primary">Entrar al sistema</button>
            </form>
            
            
            
            </p>
        </div>
       
            
        </div>
    </div>
    
    </div>
    
  </div>
</div>
</body>
</html>