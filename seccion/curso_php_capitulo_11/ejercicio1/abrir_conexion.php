<?php 
//CONFIGURAR ESTE ESPACIO


	// Parametros a configurar para la conexion de la base de datos 
	//Si esta instalado este programa en un SERVIDOR WEB cambie TODOS los parametros
	//Si esta instalando este programa en un computador, normalmente con cambiar el nombre de la base de datos funciona

	//INFORMACIÓN BASE DE DATOS
	$host 		 = "localhost";    	// Nombre del servidor donde esta alojada nuestra base de datos
	$basededatos = "prueba_ajax";   // Nombre de la base de datos (¡Las mayusculas IMPORTAN!)
	$usuariodb 	 = "root";    		// Nombre del usuario administrador de la base de datos
	$clavedb 	 = "";    			// Clave para acceder a la base de datos.

	//LISTA DE TABLAS
	$tabla_db1 = "ejercicio1"; 	   			

	//MOSTRAR O NO ERRORES DE PHP
	error_reporting(-1); //1 SI Muestra / -1 NO muestra





	//POR FAVOR, NO EDITE MÁS CONTENIDO DE ESTA PAGINA. -------------------------------------------------------------------------------





	$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);


	if ($conexion->connect_errno) {
	    echo
	    '<div class="container">
	    <br>
	    <br><center>
	    	
	    	<h2><b>ERROR DE CONEXION</b></h2>
	    </center>
	    No ha sido posible conectarse con la base de datos, <b>¡Fresco! NO es un error grave</b> pero puede ser causado por cualquiera de los siguientes motivos:<br><br>

	    <ul>
	    	<li><b>Datos incorrectos en el archivo "Abrir_Conexion.php"</b> <font color="GREEN">(Más Común)</font></li>
	    	<li>NO ha creado la base de datos en MySQL</li>
	    	<li>NO ha activado MySQL en Xampp o AppServer</li>
	    </ul> 

	   
	    <b>Recuerde revisar los tutoriales de instalación en <a target="_blank" href="https://www.DostinHurtado.com">DostinHurtado.com</a> :)</b>
	    <br> <br>
	    <center>
	    	<b><p class="text-uppercase">Si tiene alguna duda siéntase en libertad de contactarme al correo <a target="_blank" href="http://www.dostinhurtado.com/main/contacto">contacto@dostinhurtado.com</a></p></b>
	    </center>
	    </div>';
	    exit();
	}

?>
