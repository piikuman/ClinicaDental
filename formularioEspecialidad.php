<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if(isset($_SESSION['especialidad'])){
		$especialidad = $_SESSION['especialidad'];
		unset($_SESSION['especialidad']);
	} else if(!isset($_SESSION['formularioEspecialidad'])) {
		$formularioEspecialidad['nombre'] = "";
		
	
		$_SESSION['formularioEspecialidad'] = $formularioEspecialidad;
	} else
		$formularioEspecialidad = $_SESSION['formularioEspecialidad'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <script type="text/javascript">
  	function validateForm(){
  		var existErrors = false;
  		var formulario = document.forms["altaEspecialidad"];
  		var xc = formulario["nombre"];
  		var xs = document.getElementById("spanNombre");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "  El nombre es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
	}
  </script>
  <title>Formulario de Especialidades</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	<div class="form">
	<?php if(!isset($especialidad)){ ?>
	<h1>Añadir nueva especialidad</h1>	
	<form id="altaEspecialidad" method="post" onsubmit="return validateForm()" action="validacionEspecialidad.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos Especialidad</legend>
			<div class="col-10 col-tab-10">
			<div><label for="nombre">Nombre:<em>*</em></label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $formularioEspecialidad['nombre'];?>" required/><span id="spanNombre"></span>
			</div>
		</div>			
		</fieldset>
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<form id="cancelarEspecialidad" method="post" action="validacionEspecialidad.php">
		<button id="cancelarAñadir" name="cancelarAñadir" type="submit"><img src="images/returnButton.png" width="20" height="20"></button>
	</form>
	<?php }else{ ?>
	<h1>Actualizar especialidad <?php echo $especialidad['OID_ESPECIALIDAD'];?></h1>	
	<form id="altaEspecialidad" method="post" onsubmit="return validateForm()" action="validacionEspecialidad.php">
		<input id="OID_ESPECIALIDAD" name="OID_ESPECIALIDAD" type="hidden" value="<?php echo $especialidad['OID_ESPECIALIDAD']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos especialidad</legend>
			<div class="col-10 col-tab-10">
		<div><label for="nombre">Nombre:<em>*</em></label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $especialidad['nombre'];?>" required/><span id="spanNombre"></span>
		</div>	
		</fieldset>
		
		<div>
			<button id="actualizar" name="actualizar" type="submit"><img src="images/botonEditar.png" width="20" height="20"></button>
		</div>	
	</form>
	<?php } ?>
	</div>
	</body>
</html>