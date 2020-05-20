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
  <script type="text/javascript">
  	function validateForm(){
  		var existErrors = false;
  		var formulario = document.forms["altaCita"];
  		var xc = formulario["paciente"];
  		var xs = document.getElementById("spanPaciente");
  		xc.className="";
  		xs.innerHTML="";
  		var re = /^[0-9]{8}[A-Za-z]{1}$/;
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El DNI del paciente es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}else if((!re.test(xc.value))){
  			xs.innerHTML = "El DNI deben ser 8 dígitos y una letra";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["doctora"];
  		var xs = document.getElementById("spanDoctora");
  		var f = new Date();
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El codigo de la doctora es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["tratamiento"];
  		var xs = document.getElementById("spanTratamiento");
  		var f = new Date();
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El nombre del tratamiento es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["fechaCita"];
  		var xs = document.getElementById("spanFechaCita");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La fecha de la cita es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["horaCita"];
  		var xs = document.getElementById("spanHoraCita");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La hora de la cita es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["consulta"];
  		var xs = document.getElementById("spanConsulta");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La consulta de la cita es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
	}
  </script>
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
	<form id="altaCita" method="post" onsubmit="return validateForm()" action="validacionCitas.php" novalidate>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos cita</legend>
			
			<div<<label for="paciente">DNI paciente:<em>*</em></label>
			<input type="text" id="paciente" name="paciente" value="<?php echo $formularioCita['paciente'];?>"/><span id="spanPaciente"></span><br>
			</div>
			
			<div<<label for="doctora">Codigo doctora:<em>*</em></label>
			<input type="text" id="doctora" name="doctora" value="<?php echo $formularioCita['doctora'];?>"/><span id="spanDoctora"></span><br>
			</div>
			
			<div<<label for="tratamiento">Tratamiento:<em>*</em></label>
			<input type="text" id="tratamiento" name="tratamiento" value="<?php echo $formularioCita['tratamiento'];?>"/><span id="spanTratamiento"></span><br>
			</div>
			
			<div<<label for="fechaCita">Fecha:<em>*</em></label>
			<input type="date" id="fechaCita" name="fechaCita" value="<?php echo $formularioCita['fechaCita'];?>"/><span id="spanFechaCita"></span><br>
			</div>

			<div><label for="horaCita">Hora:<em>*</em></label>
			<input id="horaCita" name="horaCita" type="text" size="17" value="<?php echo $formularioCita['horaCita'];?>"/><span id="spanHoraCita"></span><br>
			</div>
			
			<div><label for="consulta">Consulta:<em>*</em></label>
			<input id="consulta" name="consulta" type="text" size="14" value="<?php echo $formularioCita['consulta'];?>"/><span id="spanConsulta"></span>
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
			<input type="text" id="paciente" name="paciente" value="<?php echo $cita['paciente'];?>"/><br>
			</div>
			
			<div<<label for="doctora">Codigo doctora:<em>*</em></label>
			<input type="text" id="doctora" name="doctora" value="<?php echo $cita['doctora'];?>"/><br>
			</div>
			
			<div<<label for="tratamiento">Tratamiento:<em>*</em></label>
			<input type="text" id="tratamiento" name="tratamiento" value="<?php echo $cita['tratamiento'];?>"/><br>
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