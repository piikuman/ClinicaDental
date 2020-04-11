<?php
	session_start();

	if(isset($_SESSION['tratamiento'])){
		$tratamiento = $_SESSION['tratamiento'];
		unset($_SESSION['tratamiento']);
	} else if(!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['coste'] = "";
	
		$_SESSION['formulario'] = $formulario;
	} else
		$formulario = $_SESSION['formulario'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Formulario de tratamientos</title>
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
	<?php if(!isset($tratamiento)){ ?>
	<h1>Añadir nuevo tratamiento</h1>	
	<form id="altaTratamiento" method="post" action="validacionTratamientos.php" novalidate>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos tratamiento</legend>
			
			<div<<label for="nombre">Nombre:<em>*</em></label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="coste">Coste:<em>*</em></label>
			<input id="coste" name="coste" type="text" size="17" value="<?php echo $formulario['coste'];?>" required/>€<br>
			</div>
			
		</fieldset>
		
		<div><button type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
			<button type="submit"><img src="images/cancelButton.png" width="20" height="20"></button>
		</div>

	</form>
	<?php }else{ ?>
	<h1>Actualizar tratamiento <?php echo $tratamiento['OID_TRATAMIENTO'];?></h1>	
	<form id="actualizarCita" method="post" action="validacionTratamientos.php">
		<input id="OID_TRATAMIENTO" name="OID_TRATAMIENTO" type="hidden" value="<?php echo $tratamiento['OID_TRATAMIENTO']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos tratamiento</legend>
			
			<div<<label for="nombre">Nombre:<em>*</em></label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $tratamiento['nombre'];?>" required/>
			</div>

			<div><label for="coste">Coste:<em>*</em></label>
			<input id="coste" name="coste" type="text" size="17" value="<?php echo $tratamiento['coste'];?>" required/>€<br>
			</div>
			
		</fieldset>
		
		<div>
			<button id="actualizar" name="actualizar" type="submit"><img src="images/botonEditar.png" width="20" height="20"></button>
		</div>	
	</form>
	<?php } ?>
	<?php
		include_once("pie.php");
	?>
	
	</body>
</html>