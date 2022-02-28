<?php  include ("../template/cabecera.php"); ?>

<?php include ("../config/bd.php"); ?>

<?php 
 
$sql= $conexion->prepare("SELECT * from usuarios ");          
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="row align-items-center">
   
   <div class="container-fluid py-5">
       <h1 class="display-5 fw-bold">SIRICO 2.0</h1>
       <h2><span class="user" >Bienvenido: <?php echo $_SESSION['nombreUsuario']; ?></span><br></h2>
       Nivel de acceso:<?php echo $_SESSION['tipo_usuario']; ?><br>
       Numero de usuario: <?php echo $_SESSION['id']; ?>
       <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body " >
      
    <h5 class="card-title">Detalles del usuario</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  
</div>
      
    
<?php  include ("../template/footer.php"); ?>