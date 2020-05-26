<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if(isset($_SESSION['paciente'])){
		$paciente = $_SESSION['paciente'];
		$fecha = strtotime("dd-mm-YYYY", $paciente["fechaNacimiento"]);
		unset($_SESSION['paciente']);
	} else if(!isset($_SESSION['formularioPaciente'])) {
		$formularioPaciente['nombre'] = "";
		$formularioPaciente['apellidos'] = "";
		$formularioPaciente['dni'] = "";
		$formularioPaciente['fechaNacimiento'] = "";
		$formularioPaciente['correo'] = "";
		$formularioPaciente['poblacion'] = "";
		$formularioPaciente['direccion'] = "";
		$formularioPaciente['fechaAlta'] = "";
		$formularioPaciente['seguro'] = "";
		$formularioPaciente['nombreTutor'] = "";
		$formularioPaciente['telefonoTutor'] = "";
	
		$_SESSION['formularioPaciente'] = $formularioPaciente;
	} else
		$formularioPaciente = $_SESSION['formularioPaciente'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
  <script type="text/javascript">
  	function validateForm(){
  		var existErrors = false;
  		var formulario = document.forms["altaPaciente"];
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
  		var xs = document.getElementById("spanFechaNacimiento");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La fecha nacimiento es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["correo"];
  		var xs = document.getElementById("spanCorreo");
  		var co = /^(\w|[\.-])+(@\b((gmail.)|(hotmail.))?((com)|(es)))$/i;
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El correo es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}else if((!co.test(xc.value))){
  			xs.innerHTML = "El formato del correo no es correcto, debe ser hotmail o gmail, y el dominio .com o .es";
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
  		var xc = formulario["direccion"];
  		var xs = document.getElementById("spanDireccion");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La direccion es obligatoria";
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
  		var xc = formulario["seguro"];
  		var xs = document.getElementById("spanSeguro");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El seguro es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["telefonoTutor"];
  		var xs = document.getElementById("spanTelefono");
  		var re = /^[0-9]{9}$/;
  		xc.className="";
  		xs.innerHTML="";
  		if (xc.value != "") {
  			if((!re.test(xc.value))){
  				xs.innerHTML = "El teléfono no es correcto";
  				xc.className="error";
  				existErrors = true;
  			}
  		}
  		return (!existErrors);
	}
  </script>
  <title>Formulario de paciente</title>
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
	
	<?php if(!isset($paciente)){ ?>
	<h1>Añadir nuevo paciente</h1>		
	<form id="altaPaciente" method="post" onsubmit="return validateForm()" action="validacionPaciente.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div><label for="dni">DNI<em>*</em></label>
			<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formularioPaciente['dni'];?>" required/><span id="spanDNI"></span>
			</div>

			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formularioPaciente['nombre'];?>" required/><span id="spanNombre"></span>
			</div>

			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formularioPaciente['apellidos'];?>" required/><span id="spanApellidos"></span>
			</div>
			
			<div><label for="fechaNacimiento">Fecha de nacimiento:</label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formularioPaciente['fechaNacimiento'];?>" required/><span id="spanFechaNacimiento"></span>
			</div>

			<div><label for="correo">Correo:<em>*</em></label>
			<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $formularioPaciente['correo'];?>" required/><span id="spanCorreo"></span>
			</div>
			
			<div><label for="poblacion">Poblacion:</label>
			<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $formularioPaciente['poblacion'];?>" required/><span id="spanPoblacion"></span>
			</div>
			
			<div><label for="direccion">Direccion:</label>
			<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formularioPaciente['direccion'];?>" required/><span id="spanDireccion"></span>
			</div>
			
			<div><label for="fechaAlta">Fecha Alta:</label>
			<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $formularioPaciente['fechaAlta'];?>" required/><span id="spanFechaAlta"></span>
			</div>
			
			<div><label for="seguro">Seguro:</label>
			<input id="seguro" name="seguro" type="text" size="80" value="<?php echo $formularioPaciente['seguro'];?>" required/><span id="spanSeguro"></span>
			</div>
			
			<div><label for="nombreTutor">Nombre Tutor:</label>
			<input id="nombreTutor" name="nombreTutor" type="text" size="80" value="<?php echo $formularioPaciente['nombreTutor'];?>"/>
			</div>
			
			<div><label for="telefonoTutor">Telefono Tutor:</label>
			<input id="telefonoTutor" name="telefonoTutor" type="tel" size="80" value="<?php echo $formularioPaciente['telefonoTutor'];?>"/><span id="spanTelefono"></span>
			</div>
		</fieldset>
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<form id="volverPaciente" method="post" action="validacionPaciente.php">
			<button id="cancelarAñadir" name="cancelarAñadir" type="submit"><img src="images/returnButton.png" width="20" height="20"></button>
	</form>
	<?php }else{ ?>
	<h1>Actualizar paciente <?php echo $paciente['OID_PACIENTE'];?></h1>	
	<form id="altaPaciente" method="post" onsubmit="return validateForm()" action="validacionPaciente.php">
		<input id="OID_PACIENTE" name="OID_PACIENTE" type="hidden" value="<?php echo $paciente['OID_PACIENTE']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
		<div><label for="dni">DNI<em>*</em></label>
		<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $paciente['dni'];?>" required/><span id="spanDNI"></span>
		</div>

		<div><label for="nombre">Nombre:<em>*</em></label>
		<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $paciente['nombre'];?>" required/>
		</div>
	
		<div><label for="apellidos">Apellidos:</label>
		<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $paciente['apellidos'];?>" required/>
		</div>
				
		<div><label for="fechaNacimiento">Fecha de nacimiento:</label>
		<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $paciente['fechaNacimiento'];?>" required/>
		</div>

		<div><label for="correo">Correo:<em>*</em></label>
		<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $paciente['correo'];?>" required/><span id="spanCorreo"></span>
		</div>
				
		<div><label for="poblacion">Poblacion:</label>
		<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $paciente['poblacion'];?>" required/>
		</div>
			
		<div><label for="direccion">Direccion:</label>
		<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $paciente['direccion'];?>" required/>
		</div>
			
		<div><label for="fechaAlta">Fecha Alta:</label>
		<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $paciente['fechaAlta'];?>" required/>
		</div>
			
		<div><label for="seguro">Seguro:</label>
		<input id="seguro" name="seguro" type="text" size="80" value="<?php echo $paciente['seguro'];?>" required/>
		</div>
			
		<div><label for="nombreTutor">Nombre Tutor:</label>
		<?php if(isset($paciente['nombreTutor'])) { ?>	
		<input id="nombreTutor" name="nombreTutor" type="text" size="80" value="<?php echo $paciente['nombreTutor'];?>"/>
		<?php } else { ?>
		<input id="nombreTutor" name="nombreTutor" type="text" size="80" value=""/>
		<?php }?>
		</div>
			
		<div><label for="telefonoTutor">Telefono Tutor:</label>
		<?php if(isset($paciente['telefonoTutor'])) { ?>	
		<input id="telefonoTutor" name="telefonoTutor" type="text" size="80" value="<?php echo $paciente['telefonoTutor'];?>"/>
		<?php } else { ?>
		<input id="telefonoTutor" name="telefonoTutor" type="number" size="80" value=""/>
		<?php }?>
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

