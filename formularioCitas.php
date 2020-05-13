<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if(isset($_SESSION['cita'])){
		$cita = $_SESSION['cita'];
		unset($_SESSION['cita']);
	} else if(!isset($_SESSION['formularioCita'])) {
		$formularioCita['fechaCita'] = "";
		$formularioCita['horaCita'] = "";
		$formularioCita['consulta'] = "";
		$formularioCita['paciente'] = "";
		$formularioCita['doctora'] = "";
		$formularioCita['tratamiento'] = "";
	
		$_SESSION['formularioCita'] = $formularioCita;
	} else
		$formularioCita = $_SESSION['formularioCita'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Formulario de Citas</title>
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
	<?php if(!isset($cita)){ ?>
	<h1>Añadir nueva cita</h1>	
	<form id="altaCita" method="post" action="validacionCitas.php" novalidate>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos cita</legend>
			
			<div<<label for="paciente">DNI paciente:<em>*</em></label>
			<input type="text" id="paciente" name="paciente" value="<?php echo $formularioCita['paciente'];?>" required/><br>
			</div>
			
			<div<<label for="doctora">Codigo doctora:<em>*</em></label>
			<input type="text" id="doctora" name="doctora" value="<?php echo $formularioCita['doctora'];?>" required/><br>
			</div>
			
			<div<<label for="tratamiento">Tratamiento:<em>*</em></label>
			<input type="text" id="tratamiento" name="tratamiento" value="<?php echo $formularioCita['tratamiento'];?>" required/><br>
			</div>
			
			<div<<label for="fechaCita">Fecha:<em>*</em></label>
			<input type="date" id="fechaCita" name="fechaCita" value="<?php echo $formularioCita['fechaCita'];?>" required/><br>
			</div>

			<div><label for="horaCita">Hora:<em>*</em></label>
			<input id="horaCita" name="horaCita" type="text" size="17" value="<?php echo $formularioCita['horaCita'];?>" required/><br>
			</div>
			
			<div><label for="consulta">Consulta:<em>*</em></label>
			<input id="consulta" name="consulta" type="text" size="14" value="<?php echo $formularioCita['consulta'];?>" required/>
			</div>
		</fieldset>
		
		<div><button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		<button id="cancelarAñadir" name="cancelarAñadir" type="submit" size="4"><img src="images/returnButton.png" width="20" height="20"></button>
		</div>

	</form>
	<?php }else{ ?>
	<h1>Actualizar cita <?php echo $cita['OID_CITA'];?></h1>	
	<form id="actualizarCita" method="post" action="validacionCitas.php">
		<input id="OID_CITA" name="OID_CITA" type="hidden" value="<?php echo $cita['OID_CITA']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos cita</legend>
			
			<div<<label for="paciente">DNI paciente:<em>*</em></label>
			<input type="text" id="paciente" name="paciente" value="<?php echo $cita['paciente'];?>" required/><br>
			</div>
			
			<div<<label for="doctora">Codigo doctora:<em>*</em></label>
			<input type="text" id="doctora" name="doctora" value="<?php echo $cita['doctora'];?>" required/><br>
			</div>
			
			<div<<label for="tratamiento">Tratamiento:<em>*</em></label>
			<input type="text" id="tratamiento" name="tratamiento" value="<?php echo $cita['tratamiento'];?>" required/><br>
			</div>
			
			<div><label for="fechaCita">Fecha:<em>*</em></label>
			<input type="date" id="fechaCita" name="fechaCita" value="<?php echo $cita['fechaCita'];?>"/>
			</div>

			<div><label for="horaCita">Hora:<em>*</em></label>
			<input id="horaCita" name="horaCita" type="text" size="17" value="<?php echo $cita['horaCita'];?>"/><br>
			</div>
			
			<div><label for="consulta">Consulta:<em>*</em></label>
			<input id="consulta" name="consulta" type="text" size="14" value="<?php echo $cita['consulta'];?>"/>
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