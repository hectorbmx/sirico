<?php
	include("abrir_conexion.php");

  //CONSULTAR
  $resultados = mysqli_query($conexion,"SELECT * FROM $tabla_db1");
  while($consulta = mysqli_fetch_array($resultados))
  {
    echo $consulta['nombre']."<br>";
  }

?>