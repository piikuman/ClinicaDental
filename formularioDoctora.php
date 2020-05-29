<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if(isset($_SESSION['doctora'])){
		$doctora = $_SESSION['doctora'];
		$fechaNacimiento = date('Y-m-d', strtotime($doctora["fechaNacimiento"]));
		$fechaAlta = date('Y-m-d', strtotime($doctora["fechaAlta"]));
		unset($_SESSION['doctora']);
		
	}else if (!isset($_SESSION['formularioDoctora'])) {
		$formularioDoctora['nombre'] = "";
		$formularioDoctora['apellidos'] = "";
		$formularioDoctora['dni'] = "";
		$formularioDoctora['direccion'] = "";
		$formularioDoctora['poblacion'] = "";
		$formularioDoctora['fechaNacimiento'] = "";
		$formularioDoctora['fechaAlta'] = "";
		$formularioDoctora['sueldo'] = "";
		$formularioDoctora['telefono'] = "";
		$formularioDoctora['codigoDoctora']= "";
		$formularioDoctora['especialidad']= "";
		
		$_SESSION['formularioDoctora'] = $formularioDoctora;
	}
	else
		$formularioDoctora = $_SESSION['formularioDoctora'];
			
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
  		var formulario = document.forms["altaDoctora"];
  		var xc = formulario["dni"];
  		var xs = document.getElementById("spanDNI");
  		var re = /^[0-9]{8}[A-Za-z]{1}$/;
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El DNI es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}else if((!re.test(xc.value))){
  			xs.innerHTML = "El DNI deben ser 8 dígitos y una letra";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["nombre"];
  		var xs = document.getElementById("spanNombre");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El nombre es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["apellidos"];
  		var xs = document.getElementById("spanApellidos");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "Los apellidos son obligatorios";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["fechaNacimiento"];
  		var xs = document.getElementById("spanFechaNac");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La fecha de nacimiento es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["poblacion"];
  		var xs = document.getElementById("spanPoblacion");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La poblacion es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["direccion"];
  		var xs = document.getElementById("spanDireccion");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La direccion es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["fechaAlta"];
  		var xs = document.getElementById("spanFechaAlta");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La fecha de alta es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["telefono"];
  		var xs = document.getElementById("spanTelefono");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El telefono es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["sueldo"];
  		var xs = document.getElementById("spanSueldo");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El sueldo es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["especialidad"];
  		var xs = document.getElementById("spanEspecialidad");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La especialidad es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
	}
  </script>
  <title>Formulario de doctoras</title> 
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
	<?php if(!isset($doctora)){ ?>
	<h1>Añadir nueva doctora</h1>		
	<form id="altaDoctora" method="post" onsubmit="return validateForm()" action="validacionDoctora.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div class="col-10 col-tab-10">
			
			<div><label for="dni">DNI<em>*</em></label>
			<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formularioDoctora['dni'];?>" required/><span id="spanDNI"></span>
			</div>

			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formularioDoctora['nombre'];?>" required/><span id="spanNombre"></span>
			</div>

			<div><label for="apellidos">Apellidos:<em>*</em></label>
			<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formularioDoctora['apellidos'];?>" required/><span id="spanApellidos"></span>
			</div>
			
			<div><label for="fechaNacimiento">Fecha de nacimiento:<em>*</em></label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formularioDoctora['fechaNacimiento'];?>" required/><span id="spanFechaNac"></span>
			</div>
			
			<div><label for="poblacion">Poblacion:<em>*</em></label>
			<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $formularioDoctora['poblacion'];?>" required/><span id="spanPoblacion"></span>
			</div>
			
			<div><label for="direccion">Direccion:<em>*</em></label>
			<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formularioDoctora['direccion'];?>" required/><span id="spanDireccion"></span>
			</div>
			
			<div><label for="fechaAlta">Fecha Alta:<em>*</em></label>
			<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $formularioDoctora['fechaAlta'];?>" required/><span id="spanFechaAlta"></span>
			</div>
			
			<div><label for="telefono">Telefono:<em>*</em></label>
			<input id="telefono" name="telefono" type="text" size="80" value="<?php echo $formularioDoctora['telefono'];?>" required/><span id="spanTelefono"></span>
			</div>
			
			<div><label for="sueldo">Sueldo:<em>*</em></label>
			<input id="sueldo" name="sueldo" type="text" size="80" value="<?php echo $formularioDoctora['sueldo'];?>" required/><span id="spanSueldo"></span>
			</div>
			
			<div><label for="codigoDoctora">Codigo doctora:<em>*</em></label>
			<input id="codigoDoctora" name="codigoDoctora" type="text" size="80" value="<?php echo $formularioDoctora['codigoDoctora'];?>" required/>
			</div>
			
			<div><label for="especialidad">Especialidad:<em>*</em></label>
			<input id="especialidad" name="especialidad" type="text" size="80" value="<?php echo $formularioDoctora['especialidad'];?>" required/><span id="spanEspecialidad"></span>
			</div>
		</div>
		</fieldset>		
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<form id="cancelarDoctora" method="post" action="validacionDoctora.php">
		<button id="cancelarAñadir" name="cancelarAñadir" type="submit" size="4"><img src="images/returnButton.png" width="20" height="20"></button>
	</form>
	<?php }else{ ?>
	<h1>Actualizar doctora</h1>	
	<form id="altaDoctora" method="post" onsubmit="return validateForm()" action="validacionDoctora.php">
		<input id="OID_DOCTORA" name="OID_DOCTORA" type="hidden" value="<?php echo $doctora['OID_DOCTORA'];?>"/>
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div class="col-10 col-tab-10">
		<div><label for="dni">DNI<em>*</em></label>
			<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $doctora['dni'];?>" required><span id="spanDNI"></span>
			</div>

			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $doctora['nombre'];?>" required/><span id="spanNombre"></span>
			</div>

			<div><label for="apellidos">Apellidos:<em>*</em></label>
			<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $doctora['apellidos'];?>" required/><span id="spanApellidos"></span>
			</div>
			
			<div><label for="fechaNacimiento">Fecha de nacimiento:<em>*</em></label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fechaNacimiento;?>" required/><span id="spanFechaNac"></span>
			</div>
			
			<div><label for="poblacion">Poblacion:<em>*</em></label>
			<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $doctora['poblacion'];?>" required/><span id="spanPoblacion"></span>
			</div>
			
			<div><label for="direccion">Direccion:<em>*</em></label>
			<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $doctora['direccion'];?>" required/><span id="spanDireccion"></span>
			</div>
			
			<div><label for="fechaAlta">Fecha Alta:<em>*</em></label>
			<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $fechaAlta;?>" required/><span id="spanFechaAlta"></span>
			</div>
			
			<div><label for="telefono">Telefono:<em>*</em></label>
			<input id="telefono" name="telefono" type="text" size="80" value="<?php echo $doctora['telefono'];?>" required/><span id="spanTelefono"></span>
			</div>
			
			<div><label for="sueldo">Sueldo:<em>*</em></label>
			<input id="sueldo" name="sueldo" type="text" size="80" value="<?php echo $doctora['sueldo'];?>" required/><span id="spanSueldo"></span>
			</div>
			
			<div><label for="especialidad">Especialidad:<em>*</em></label>
			<input id="especialidad" name="especialidad" type="text" size="80" value="<?php echo $doctora['especialidad'];?>" required/><span id="spanEspecialidad"></span>
			</div>
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