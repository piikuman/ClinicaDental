<?php
	session_start();

	if (!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['dni'] = "";
		$formulario['direccion'] = "";
		$formulario['poblacion'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['fechaAlta'] = "";
		$formulario['sueldo'] = "";
		$formulario['telefono'] = "";
		$formulario['codigoDoctora']= "";
		
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
  <title>Gestión de Doctora: Alta de Doctora</title> 
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
	
	<form id="altaDoctora" method="get" action="validacionDoctora.php" novalidate>
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
			
			<div><label for="poblacion">Poblacion:</label>
			<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $formulario['poblacion'];?>"/>
			</div>
			
			<div><label for="direccion">Direccion:</label>
			<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formulario['direccion'];?>"/>
			</div>
			
			<div><label for="fechaAlta">Fecha Alta:</label>
			<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $formulario['fechaAlta'];?>"/>
			</div>
			
			<div><label for="sueldo">Sueldo:</label>
			<input id="sueldo" name="sueldo" type="text" size="80" value="<?php echo $formulario['sueldo'];?>"/>
			</div>
			
			<div><label for="telefono">Telefono:</label>
			<input id="telefono" name="telefono" type="text" size="80" value="<?php echo $formulario['telefono'];?>"/>
			</div>
			
			<div><label for="codigoDoctora">codigoDoctora:</label>
			<input id="codigoDoctora" name="codigoDoctora" type="text" size="80" value="<?php echo $formulario['codigoDoctora'];?>"/>
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

