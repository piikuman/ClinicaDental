<?php
	session_start();

	if(isset($_SESSION['paciente'])){
		$paciente = $_SESSION['paciente'];
		unset($_SESSION['paciente']);
	} else if(!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['dni'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['correo'] = "";
		$formulario['poblacion'] = "";
		$formulario['direccion'] = "";
		$formulario['fechaAlta'] = "";
		$formulario['seguro'] = "";
		$formulario['nombreTutor'] = "";
		$formulario['telefonoTutor'] = "";
	
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
	<form id="altaPaciente" method="post" action="validacionPaciente.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div><label for="dni">DNI<em>*</em></label>
			<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['dni'];?>" required>
			</div>

			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
			</div>
			
			<div><label for="fechaNacimiento">Fecha de nacimiento:</label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
			</div>

			<div><label for="correo">Correo:<em>*</em></label>
			<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $formulario['correo'];?>" required/><br>
			</div>
			
			<div><label for="poblacion">Poblacion:</label>
			<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $formulario['poblacion'];?>"/>
			</div>
			
			<div><label for="direccion">Direccion:</label>
			<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formulario['direccion'];?>"/>
			</div>
			
			<div><label for="fechaAlta">Fecha Alta:</label>
			<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $formulario['fechaAlta'];?>"/>
			</div>
			
			<div><label for="seguro">Seguro:</label>
			<input id="seguro" name="seguro" type="text" size="80" value="<?php echo $formulario['seguro'];?>"/>
			</div>
			
			<div><label for="nombreTutor">Nombre Tutor:</label>
			<input id="nombreTutor" name="nombreTutor" type="text" size="80" value="<?php echo $formulario['nombreTutor'];?>"/>
			</div>
			
			<div><label for="telefonoTutor">Telefono Tutor:</label>
			<input id="telefonoTutor" name="telefonoTutor" type="text" size="80" value="<?php echo $formulario['telefonoTutor'];?>"/>
			</div>
		</fieldset>
		
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<?php }else{ ?>
	<h1>Actualizar paciente <?php echo $paciente['OID_PACIENTE'];?></h1>	
	<form id="actualizarPaciente" method="post" action="validacionPaciente.php">
		<input id="OID_PACIENTE" name="OID_PACIENTE" type="hidden" value="<?php echo $paciente['OID_PACIENTE']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
		<div><label for="dni">DNI<em>*</em></label>
		<input id="dni" name="dni" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $paciente['dni'];?>" required>
		</div>

		<div><label for="nombre">Nombre:<em>*</em></label>
		<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $paciente['nombre'];?>" required/>
		</div>
	
		<div><label for="apellidos">Apellidos:</label>
		<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $paciente['apellidos'];?>"/>
		</div>
				
		<div><label for="fechaNacimiento">Fecha de nacimiento:</label>
		<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $paciente['fechaNacimiento'];?>"/>
		</div>

		<div><label for="correo">Correo:<em>*</em></label>
		<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $paciente['correo'];?>" required/><br>
		</div>
				
		<div><label for="poblacion">Poblacion:</label>
		<input id="poblacion" name="poblacion" type="text" size="80" value="<?php echo $paciente['poblacion'];?>"/>
		</div>
			
		<div><label for="direccion">Direccion:</label>
		<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $paciente['direccion'];?>"/>
		</div>
			
		<div><label for="fechaAlta">Fecha Alta:</label>
		<input id="fechaAlta" name="fechaAlta" type="date" size="80" value="<?php echo $paciente['fechaAlta'];?>"/>
		</div>
			
		<div><label for="seguro">Seguro:</label>
		<input id="seguro" name="seguro" type="text" size="80" value="<?php echo $paciente['seguro'];?>"/>
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
		<input id="telefonoTutor" name="telefonoTutor" type="text" size="80" value=""/>
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

