<?php
	session_start();
	
		if (!isset($_SESSION['login']))
			Header("Location: login.php");
		
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Inicio</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<p>Hola mundo!</p>
</body>
</html>	