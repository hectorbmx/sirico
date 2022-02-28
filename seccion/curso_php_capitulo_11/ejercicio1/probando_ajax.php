<!DOCTYPE html>
<html>
<head>
	<title>Probando</title>
	<script src="jquery-3.4.1.min.js"></script>
</head>
<body>


<input type="button" value="SALUDAME" onclick="saludame();">
<div id="mostrar_mensaje"></div>


<script>
	function saludame()
    { 
      var parametros = 
      {
        "nombre" : "dostin",
        "apellido" : "hurtado",
        "telefono" : "123456789"
      };

      $.ajax({
        data: parametros,
        url: 'codigo_php.php',
        type: 'POST',
        
        beforesend: function()
        {
          $('#mostrar_mensaje').html("Mensaje antes de Enviar");
        },

        success: function(mensaje)
        {
          $('#mostrar_mensaje').html(mensaje);
        }
      });
    }


</script>
</body>
</html>