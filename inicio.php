<?php  include ("template/cabecera.php"); ?>


<?php 



?>
<div class="container">
    <div class="row align-items-center">
    <div class="mt-2 mb-4 text-white bg-dark rounded-3">
   <div class="container-fluid py-5">
       <h1 class="display-5 fw-bold">SIRICO 2.0</h1>
       <h2><span class="user" >Bienvenido: <?php echo $_SESSION['nombreUsuario']; ?></span><br>
       
       
       
       
       
       <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../img/7.png" class="d-block w-100" alt="Presupuestos programables">
    </div>
    <div class="carousel-item">
      <img src="../img/3.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../img/6.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
   </div>
   
</div>
    
<?php  include ("template/footer.php"); ?>