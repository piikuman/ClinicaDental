<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if(isset($_SESSION['tratamiento'])){
		$tratamiento = $_SESSION['tratamiento'];
		unset($_SESSION['tratamiento']);
	} else if(!isset($_SESSION['formularioTratamiento'])) {
		$formularioTratamiento['nombre'] = "";
		$formularioTratamiento['coste'] = "";
		$formularioTratamiento['especialidad'] = "";
	
		$_SESSION['formularioTratamiento'] = $formularioTratamiento;
	} else
		$formularioTratamiento = $_SESSION['formularioTratamiento'];
			
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
  		var formulario = document.forms["altaTratamiento"];
  		var xc = formulario["nombre"];
  		var xs = document.getElementById("spanNombre");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "  El nombre es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["coste"];
  		var xs = document.getElementById("spanCoste");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "  El coste es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["especialidad"];
  		var xs = document.getElementById("spanEspecialidad");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "  El especialidad es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
	}
  </script>
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
	<form id="altaTratamiento" method="post" onsubmit="return validateForm()" action="validacionTratamientos.php" >
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos tratamiento</legend>
			
			<div<<label for="nombre">Nombre:<em>*</em></label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $formularioTratamiento['nombre'];?>" required/><span id="spanNombre"></span>
			</div>

			<div><label for="coste">Coste:<em>*</em></label>
			<input id="coste" name="coste" type="text" size="17" value="<?php echo $formularioTratamiento['coste'];?>" required/>€<span id="spanCoste"></span><br>
			</div>
			
			<div><label for="especialidad">Especialidad:<em>*</em></label>
			<input id="especialidad" name="especialidad" type="text" size="17" value="<?php echo $formularioTratamiento['especialidad'];?>" required/><span id="spanEspecialidad"></span><br>
			</div>
		</fieldset>
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<form id="cancelarTratamiento" method="post" action="validacionTratamientos.php" >
		<button id="cancelarAñadir" name="cancelarAñadir" type="submit"><img src="images/returnButton.png" width="20" height="20"></button>
	</form>
	<?php }else{ ?>
	<h1>Actualizar tratamiento <?php echo $tratamiento['OID_TRATAMIENTO'];?></h1>	
	<form id="actualizarCita" method="post" onsubmit="return validateForm()" action="validacionTratamientos.php">
		<input id="OID_TRATAMIENTO" name="OID_TRATAMIENTO" type="hidden" value="<?php echo $tratamiento['OID_TRATAMIENTO']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos tratamiento</legend>
			
			<div<<label for="nombre">Nombre:<em>*</em></label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $tratamiento['nombre'];?>" required/><span id="spanNombre"></span>
			</div>

			<div><label for="coste">Coste:<em>*</em></label>
			<input id="coste" name="coste" type="text" size="17" value="<?php echo $tratamiento['coste'];?>" required/>€<span id="spanCoste"></span><br>
			</div>
			
			<div><label for="especialidad">Especialidad:<em>*</em></label>
			<input id="especialidad" name="especialidad" type="text" size="17" value="<?php echo $tratamiento['especialidad'];?>" required/><span id="spanEspecialidad"></span><br>
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