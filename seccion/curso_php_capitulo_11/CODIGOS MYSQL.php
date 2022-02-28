<?php

//------------------------------------------------

  //CONSULTAR
  $resultados = mysqli_query($conexion,"SELECT * FROM $tabla_db1 WHERE id = '$otra_variable'");
  while($consulta = mysqli_fetch_array($resultados))
  {
    $variable=$consulta['campo_mysql'];
  }

//------------------------------------------------

  //ACTUALIZAR 
  $_UPDATE_SQL="UPDATE $tabla_db1 Set 
  campo_mysql='$variable', 
  campo_mysql2='$variable2'

  WHERE id='$otra_variable'"; 

  mysqli_query($conexion,$_UPDATE_SQL); 
  

//------------------------------------------------

  //INSERTAR
  mysqli_query($conexion, "INSERT INTO $tabla_db1 
  (campo1_mysql,campo2_mysql) 
    values 
  ('$variable1','$variable2')");


//------------------------------------------------

  //ELIMINAR
  $_DELETE_SQL =  "DELETE FROM $tabla_db1 WHERE campo_mysql = '$variable'";
  mysqli_query($conexion,$_DELETE_SQL); 


//------------------------------------------------

//CONDICIONES MÁS COMUNES
  //WHERE campo_mysql LIKE '%$variable%'
  //WHERE campo_mysql = 'asd'
  //WHERE campo_mysql = '$variable'
  //WHERE campo_mysql = '$variable' AND campo_mysql = "$variable"
  //WHERE campo_mysql = '$variable' OR campo_mysql = "$variable"
  //WHERE campo_mysql BETWEEN $variable1 AND $variable2
?>