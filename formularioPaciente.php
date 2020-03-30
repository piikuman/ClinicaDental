<?php
	session_start();

	if (!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['dni'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['correo'] = "";
		$formulario['poblacion'] = "";
		$formulario['direccion'] = "";
		$formulario['fechaAlta'] = "";
		$formulario['seguro'] = "";
		$formulario['nombreTutor'] = "";
		$formulario['telefonoTutor'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	else
		$formulario = $_SESSION['formulario'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Gestión de Pacientes: Alta de Pacientes</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
	<form id="altaUsuario" method="get" action="validacionPaciente.php" novalidate>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div></div><label for="dni">DNI<em>*</em></label>
			<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['dni'];?>" required>
			</div>

			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
			</div>
			
			<div<<label for="fechaNacimiento">Fecha de nacimiento:</label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
			</div>

			<div><label for="correo">Correo:<em>*</em></label>
			<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $formulario['correo'];?>" required/><br>
			</div>
			
			<div><label for="poblacion">Poblacion:</label>
			<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $formulario['poblacion'];?>"/>
			</div>
			
			<div><label for="direccion">Direccion:</label>
			<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formulario['direccion'];?>"/>
			</div>
			
			<div><label for="fechaAlta">Fecha Alta:</label>
			<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $formulario['fechaAlta'];?>"/>
			</div>
			
			<div><label for="seguro">Seguro:</label>
			<input id="seguro" name="seguro" type="text" size="80" value="<?php echo $formulario['seguro'];?>"/>
			</div>
			
			<div><label for="nombreTutor">Nombre Tutor:</label>
			<input id="nombreTutor" name="nombreTutor" type="text" size="80" value="<?php echo $formulario['nombreTutor'];?>"/>
			</div>
			
			<div><label for="telefonoTutor">Telefono Tutor:</label>
			<input id="telefonoTutor" name="telefonoTutor" type="text" size="80" value="<?php echo $formulario['telefonoTutor'];?>"/>
			</div>
		</fieldset>
		
		<div><button type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
			<button type="submit"><img src="images/cancelButton.png" width="20" height="20"></button>
		</div>

	</form>
	
	<?php
		include_once("pie.php");
	?>
	
	</body>
</html>

