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
		<h1>Datos de  <?php echo $nuevoTratamiento["nombre"]; ?></h1>
			<div id="div_volver">	
			   Pulsa <a href="formularioTratamientos.php">aquí</a> para volver al formulario de tratamientos.
			</div>
			
			<h2>El tratamiento <?php echo $nuevoTratamiento["nombre"]; ?> ha sido insertado con éxito con los siguientes datos:</h2>
			<ul>
				<li><?php echo "Nombre: " . $nuevoTratamiento["nombre"]; ?></li>
				<li><?php echo "Coste: " . $nuevoTratameinto["coste"]; ?></li>
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

