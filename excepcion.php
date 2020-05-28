<?php 
	session_start();
	
	$excepcion = $_SESSION["excepcion"];
	unset($_SESSION["excepcion"]);
	
	if (isset ($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);	
	} else 
		$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Gestión de biblioteca: ¡Se ha producido un problema!</title>
</head>
<body class="exception">
	<div class="exception">
		<div class="imException">
			<img src="images/imExcepcion.png" width="800" alt="400" />
		</div>
		<div class="menException">
		<h2>Ups!</h2>
		<?php if ($destino<>"") { ?>
		<p>Ocurrió un problema durante el procesado de los datos. Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página principal.</p>
		<?php } else { ?>
		<a class="menException" href="inicio.php">Ocurrió un problema.</a></br>
		<?php } ?>
		<?php if(isset($excepcion)){
			echo "Información relativa al problema: $excepcion;";
		}?>
		</div>
	</div>	
</body>
</html>