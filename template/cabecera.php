<?php
session_start();
  if(!isset($_SESSION['usuario'])){
    header("location:../index.php");
  }else {

    if($_SESSION['usuario']=="ok"){

      $nombreUsuario=$_SESSION['nombreUsuario'];
      $tipo_usuario=$_SESSION['tipo_usuario'];
      $id=$_SESSION['id'];
      
    }
  }?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sirico</title>
  
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"  />
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script> -->

<!-- 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> -->
<link rel="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<!-- <<script src="https://code.jquery.com/jquery-1.12.4.js"></script>  -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>


  
  <!--<link  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>-->
</head>
<?php $url="http://".$_SERVER['HTTP_HOST']."/web"?>
<body><div class="container">
  

<!-- Navbar -->
<html lang="en">
<head>
  

  
  <!--<link  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>-->
</head>
<body>
<?php  $url="http://".$_SERVER['HTTP_HOST']."/web"?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inicio
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/config/cierra.php">Cerrar sesion</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/perfil.php">Mi perfil</a></li>
            
          </ul>
        </li>
        <?php if ($tipo_usuario ==1 or $tipo_usuario ==2)  { ?>
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Administracion</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/empleados.php">Registro empleados</a></li>
      
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/empleados_detalles.php">Pagos empleados</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/detalles_pagos.php">Consulta pagos empleados</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/inventario.php">Inventario</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/tareas.php">Tareas Coordinadas</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/checador.php">Checador</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/checadas_registradas.php">Reporte Checadas</a></li>
    </ul><?php } ?>
  </li><!-- aqui cierras el menu administracion-->
  <?php if ($tipo_usuario ==1 or $tipo_usuario ==5)  { ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pilas</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/presupuestos.php">Presupuestos</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/obras.php">Obras</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/Estimaciones.php">Estimaciones</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/Gastos.php">Gastos</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/Relacion_gastos.php">Relacion de gastos</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/alta_oc_pilas.php">Ordenes compra</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/Clientes.php">Clientes</a></li>
    </ul>
  </li><!-- aqui cierras el menu Pilas--><?php } ?>
  <?php if ($tipo_usuario ==1 or $tipo_usuario ==3)  { ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pozos</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Presupuestos</a></li>
      <li><a class="dropdown-item" href="#">Obras</a></li>
      <li><a class="dropdown-item" href="#">Estimaciones</a></li>
      <li><a class="dropdown-item" href="#">Gastos</a></li>
      <li><a class="dropdown-item" href="#">Relacion de gastos</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/alta_oc_pozos.php">Ordenes compra</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>seccion/Clientes.php">Clientes</a></li>
    </ul><!-- aqui cierras el menu Pozos-->
    
  </li><?php } ?>
  <?php if ($tipo_usuario ==4 or $tipo_usuario ==1)  { ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Giralda</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/productos_giralda.php">Productos</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/entradas_giralda.php">Entradas</a></li>
      <li><a class="dropdown-item" href="#">Salidas</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/proveedores.php">Proveedores</a></li>
      <li><a class="dropdown-item" href="#">Inventario</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/seccion/Clientes.php">Clientes</a></li>
      <li><a class="dropdown-item" href="<?php echo $url;?>/administrador/seccion/orden_compra.php">Orden de Compra</a></li>
    </ul>
  </li>
</ul><?php } ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
