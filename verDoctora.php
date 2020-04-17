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
		<h1>Datos de  <?php echo $nuevoUsuario["nombre"]; ?></h1>
			<div id="div_volver">	
			   Pulsa <a href="formularioDoctora.php">aquí</a> para volver al formulario de altas de doctoras.
			</div>
			
			<h2>El paciente <?php echo $nuevoUsuario["nombre"]; ?> ha sido dado de alta con éxito con los siguientes datos:</h2>
			<ul>
				<li><?php echo "NIF: " . $nuevoUsuario["dni"]; ?></li>
				<li><?php echo "Nombre: " . $nuevoUsuario["nombre"]; ?></li>
				<li><?php echo "Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
				<li><?php echo "Telefono: " . $nuevoUsuario["telefono"]; ?></li>
				<li><?php echo "Fecha de Nacimiento: " . getFechaFormateada($nuevoUsuario["fechaNacimiento"]); ?></li>
				<li><?php echo "Fecha de Alta: " . getFechaFormateada($nuevoUsuario["fechaAlta"]); ?></li>
				<li><?php echo "Direccion: " . $nuevoUsuario["direccion"]; ?></li>
				<li><?php echo "Poblacion: " . getPoblacion($nuevoUsuario["poblacion"]);?></li>
				// aquí solo he añadido los campos personales, no sé si he de añadir el codigoDoctora y el sueldo(?) 
				<li><?php
				if($nuevoUsuario["nombreTutor"]!=""){	
					echo "Nombre tutor: " . $nuevoUsuario["nombreTutor"];
				}
				;?></li>
				<li><?php
				if($nuevoUsuario["telefonoTutor"]!=""){	
					echo "Telefono tutor: " . $nuevoUsuario["telefonoTutor"];
				}
				?></li>
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
