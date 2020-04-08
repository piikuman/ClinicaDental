<?php
	session_start();

	if (!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['coste'] = "";
	
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
  <title>Gestión de Tratamientos: Creación de tratamientos</title>
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
	<h1>Gestión de Tratamientos</h1>
	
	<form id="altaTratamiento" method="get" action="validacionTratamientos.php" novalidate>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			
			<div<<label for="nombre">Nombre: <em>*</em></label>
			<input type="text" id="nombre" name="nombre" size="15" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="coste">Coste: <em>*</em></label>
			<input id="coste" name="coste" type="text" size="17" value="<?php echo $formulario['coste'];?>" required/> €<br>
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

