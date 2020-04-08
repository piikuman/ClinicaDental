<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Biblioteca: Alta de Usuario realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<h1>Datos de la cita <?php echo $nuevaCita["fechaCita"]; ?></h1>
			<div id="div_volver">	
			   Pulsa <a href="formularioCitas.php">aquí</a> para volver al formulario de citas.
			</div>
			
			<h2>La cita de hora <?php echo $nuevaCita["horaCita"]; ?> ha sido apuntada con éxito con los siguientes datos:</h2>
			<ul>
				<li><?php echo "Fecha cita " . getFechaFormateada($nuevaCita["fechaCita"]); ?></li>
				<li><?php echo "Hora cita: " . $nuevaCita["HoraCita"]; ?></li>
				<li><?php echo "Consulta: " . $nuevaCita["consulta"]; ?></li>
			</ul>
			
</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

