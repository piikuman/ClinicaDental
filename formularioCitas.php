<?php
	session_start();

	if (!isset($_SESSION['formulario'])) {
		$formulario['fechaCita'] = "";
		$formulario['horaCita'] = "";
		$formulario['consulta'] = "";
	
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
  <title>Gestión de Citas: Creación de citas</title>
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
	
	<form id="altaCita" method="get" action="validacionCitas.php" novalidate>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			
			<div<<label for="fechaCita">Fecha:<em>*</em></label>
			<input type="date" id="fechaCita" name="fechaCita" value="<?php echo $formulario['fechaCita'];?>" required/>
			</div>

			<div><label for="horaCita">Hora:<em>*</em></label>
			<input id="horaCita" name="horaCita" type="text" size="17" value="<?php echo $formulario['horaCita'];?>" required/><br>
			</div>
			
			<div><label for="consulta">Consulta:<em>*</em></label>
			<input id="consulta" name="consulta" type="text" size="14" value="<?php echo $formulario['consulta'];?>" required/>
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

