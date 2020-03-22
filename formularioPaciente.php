<?php

	session_start();
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])){
		$formulario["nif"] = "";
		$formulario["nombre"] = "";
		$formulario["apellidos"] = "";
		$formulario["correo"] = "";
		$formulario["fechaNacimiento"] = "";
		$formulario["poblacion"] = array();
		$formulario["direccion"] = "";
		$formulario["fechaAlta"] = "";
		$formulario["seguro"] = "Publico";
		$formulario["nombreTutor"] = "";
		$formulario["telefonoTutor"] = "";
		
		
		$_SESSION["formulario"] = $formulario;
	}	
	else {
		// Si ya existían valores, los cogemos para inicializar el formulario
		$formulario = $_SESSION["formulario"];
	}
	
	// Si hay errores de validación, hay que mostrarlos y marcar los campos
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Formulario Paciente</title>
</head>

<body>
	
	<?php 
	include_once("cabecera.php");
	?>
	
	<?php
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
	<h2>Añadir Paciente</h2>
	<form id="altaPaciente" method="post" action="validacionPaciente.php" novalidate>
			<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
			<fieldset><legend><h2>Datos personales</h2></legend>
				<div></div><label for="nif">NIF<em>*</em></label>
				<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required>
				</div>

				<div><label for="nombre">Nombre:<em>*</em></label>
				<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
				</div>

				<div><label for="apellidos">Apellidos:<em>*</em></label>
				<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
				</div>

				<div<<label for="fechaNacimiento">Fecha de nacimiento:<em>*</em></label>
				<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
				</div>

				<div><label for="correo">Email:<em>*</em></label>
				<input id="correo" name="correo"  type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['correo'];?>" required/><br>
				</div>
				
				<div><label for="poblacion">Población:<em>*</em></label>
				<select name="poblacion" id="poblacion" required>
				  	<optgroup label="Andalucia">
				  	<option value="CD" <?php      
						if (in_array("CD",$formulario['poblacion'])){
							echo "selected";
						}?> >Cádiz</option>
					<option value="SV"<?php      
						if (in_array("SV",$formulario['poblacion'])){
							echo "selected";
						}?> >Sevilla</option>
					<option value="MA"<?php      
						if (in_array("MA",$formulario['poblacion'])){
							echo "selected";
						}?> >Málaga</option>
					<option value="HU"<?php      
						if (in_array("HU",$formulario['poblacion'])){
							echo "selected";
						}?> >Huelva</option>
					<option value="CO"<?php      
						if (in_array("CO",$formulario['poblacion'])){
							echo "selected";
						}?> >Córdoba</option>
					<option value="JA"<?php      
						if (in_array("JA",$formulario['poblacion'])){
							echo "selected";
						}?> >Jaén</option>
					<option value="AL"<?php      
						if (in_array("AL",$formulario['poblacion'])){
							echo "selected";
						}?> >Almería</option>
					<option value="GR"<?php      
						if (in_array("GR",$formulario['poblacion'])){
							echo "selected";
						}?> >Granada</option>
					</optgroup>
					<option value="OT"<?php      
						if (in_array("OT",$formulario['poblacion'])){
							echo "selected";
						}?> >Otra</option>
				</select>
				</div>
				
				<div><label for="direccion">Direccion:<em>*</em></label>
				<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formulario['direccion'];?>" required/>
				</div>
				</fieldset>
				
				<fieldset><legend><h2>Datos clínicos</h2></legend>
				<div><label for="fechaAlta">Fecha Alta:<em>*</em></label>
				<input type="date" id="fechaAlta" name="fechaAlta" value="<?php echo $formulario['fechaAlta'];?>" required/>
				</div>
				
				<div><label>Seguro:<em>*</em></label>
				<br>
				<label>
					<input name="seguro" type="radio" value="Privado" <?php if($formulario['seguro']=='Privado') echo ' checked ';?>/>
					Privado</label>
				<label>
					<input name="seguro" type="radio" value="Publico" <?php if($formulario['seguro']=='Publico') echo ' checked ';?>/>
					Público</label>
				</div>
				</fieldset>
				
				<fieldset><legend><h2>Datos tutor</h2></legend>
				
				<div>Los siguientes datos solo son necesarios si el paciente es menor de edad</div>
				
				<div><label for="nombreTutor">Nombre Tutor:</label>
				<input id="nombreTutor" name="nombreTutor" type="text" value="<?php echo $formulario['nombreTutor'];?>"/>
				</div>
				
				<div><label for="telefonoTutor">Teléfono Tutor:</label>
				<input id="telefonoTutor" name="telefonoTutor" type="tel" value="<?php echo $formulario['telefonoTutor'];?>"/>
				</div>
				</fieldset>
				
				<fieldset><legend><h2>Datos de usuario</h2></legend>
				<div><label for="nick">Nickname:<em>*</em></label>
				<input id="nick" name="nick" type="text" size="40"/>
				</div>

				<div><label for="pass">Password:<em>*</em></label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required/>
				</div>
				
				<div><label for="confirmpass">Confirmar Password:<em>*</em></label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required />
				</div>
				</fieldset>	
			
				<br>
				<button type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
				<button type="button"><img src="images/cancelButton.png" width="20" height="20"></button>
				<br>
				
		</form>
	
	<?php 
		include_once("pie.php");
	?>
	
	</body>

</html>
