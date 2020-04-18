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
		<h1>Datos de  <?php echo $nuevaDoctora["nombre"]; ?></h1>
			<div id="div_volver">	
			   Pulsa <a href="formularioDoctora.php">aquí</a> para volver al formulario de altas de doctoras.
			</div>
			
			<h2>El paciente <?php echo $nuevaDoctora["nombre"]; ?> ha sido dado de alta con éxito con los siguientes datos:</h2>
			<ul>
				<li><?php echo "NIF: " . $nuevaDoctora["dni"]; ?></li>
				<li><?php echo "Nombre: " . $nuevaDoctora["nombre"]; ?></li>
				<li><?php echo "Apellidos: " . $nuevaDoctora["apellidos"]; ?></li>
				<li><?php echo "Telefono: " . $nuevaDoctora["telefono"]; ?></li>
				<li><?php echo "Fecha de Nacimiento: " . getFechaFormateada($nuevaDoctora["fechaNacimiento"]); ?></li>
				<li><?php echo "Fecha de Alta: " . getFechaFormateada($nuevaDoctora["fechaAlta"]); ?></li>
				<li><?php echo "Direccion: " . $nuevaDoctora["direccion"]; ?></li>
				<li><?php echo "Poblacion: " . getPoblacion($nuevaDoctora["poblacion"]);?></li>
				<li><?php echo "Sueldo: " . getSueldo($nuevaDoctora["sueldo"]);?></li>
				<li><?php echo "CodigoDoctora: " . getCodigoDoctora($nuevaDoctora["codigoDoctora"]);?></li>
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
